<?php defined('SYSPATH') or die('No direct script access.');

//wczytuje biblioteke FPDF i FPDI
define('FPDF_FONTPATH', APPPATH.'vendor/fpdf/font/');
require Kohana::find_file('vendor/fpdf','fpdf', 'php');
require Kohana::find_file('vendor/fpdi','fpdi', 'php');

class Model_PDF extends Model
{
    /**
     * @var obiekt biblioteki FPDF / FPDI
     */
    private $pdf;

    /**
     * konstruktor
     */
    public function __construct()
    {
        $this->pdf = new FPDI();
    }

    /**
     *
     * Konwertuje UTF-8 do ISO-8859-2 - potrzebne do poprawnego wyswietlania polskich znakow
     */
    private static function char($str)
    {
        return iconv('utf-8', 'iso-8859-2', $str);
    }

    /**
     * Pomocnicza funkcja, wyswietla tekst na wspolrzednych X, Y
     *
     */
    private function w($x, $y, $str)
    {
        $this->pdf->setXY($x, $y);
        $this->pdf->Write(0, self::char($str));
    }

    /**
     * Pomocnicza funkcja, wyswietla kierunki szkoły w okreslonych miejscach
     */
    private function _render_specs($coords, $data)
    {
        $specs = explode(', ', $data);

        foreach ($specs as $i => $s)
        {
            $spec = Utils::$specialisations[$s];    //pelna nazwa kierunku, classes/Utils.php
            $type = Utils::school_type($s);         //ZSZ / Technikum

            $x = $coords[$i][0];
            $y = $coords[$i][1];

            $this->w($x, $y, $type);

            $this->w($x - 5, $y + 10, $spec);
        }
    }

    /**
     * Ta funkcja wstawia wszystkie dane z podania do PDF
     */
    private function _render_appdata($data)
    {
        $x = 95;
        $y = 56;

        //nazwisko
        $this->w($x, $y, $data['last_name']);

        //imie
        $y += 10;
        $this->w($x, $y, $data['first_name']);

        //data urodzenia i adres
        $timestamp = strtotime($data['birth_date']);
        $date = Utils::polishdate($timestamp);
        $text = $date .', '. $data['birth_place'];
        $y += 10;
        $this->w($x, $y, $text);

        //nuumer telefonu jesli podano
        $y += 10;
        if(empty($data['tel']))
        {
            $this->pdf->SetTextColor(150,150,150);
            $this->w($x, $y, 'Nie podano');
            $this->pdf->SetTextColor(0,0,0);
        }
        else
        //$tel = (empty($data['tel']) ? '---' : $data['tel']);
            $this->w($x, $y, $data['tel']);

        //Address fields are a bit smaller
        $this->pdf->SetFontSize(11);

        //adres
        $y += 9;
        $this->w($x, $y, $data['addr_street']);     //ulica
        $y += 8;
        $this->w($x, $y, $data['addr_city']);       //miasto
        $y += 8;
        $this->w($x, $y, $data['addr_zip']);        //kod pocztowy
        $y += 8;
        $this->w($x, $y, $data['addr_province']);   //powiat
        $y += 8;
        $this->w($x, $y, Utils::$regions[$data['addr_region']]);    //wojewodztwo


        //PESEL
        $this->pdf->SetFontSize(14);

        $digits = str_split($data['pesel']);
        $x = 107;
        foreach ($digits as $d) {
            $this->w($x, 152, $d);
            $x += 6.4;
        }


        //wspolrzedne, gdzie wyswietlic wybrane kierunki
        $coords = array(
            array(40, 179),     //1. kierunek - glowny
            array(35, 207.5),   //2. kierunek - rezerwowe
            array(35, 236),     //3
        );
        $this->_render_specs($coords, $data['specs']);


        //informacje o gimnazjum
        $this->pdf->SetFontSize(10);
        $this->w(95, 257, $data['secondary_name']);
        $this->w(115, 267, $data['secondary_langs']);

        //wybrane jezyki
        $langs = explode(', ', $data['sel_langs']);
        foreach($langs as $k => $v)
            $langs[$k] = Utils::$languages[$v];

        $langs = Model_Applications::encode_langs($langs);
        $this->w(57, 276.9, $langs);
    }

    /**
     *
     * Główna funkcja - Renderuje PDF jako odpowiedź HTTP response, wstawiając wszystkie dane
     * z podania. Ostatni parametr $download pozwala wybrać czy PDF będzie renderowany
     * bezpośrednio w przeglądarce czy pobrany do pliku
     */
    public function Render(& $response, $appData, $download = false)
    {
        //dodaj 1 strone
        $this->pdf->AddPage();
        // szablon application/media/template.pdf
        $this->pdf->setSourceFile(Kohana::find_file('media', 'template', 'pdf'));
        // wczytaj 1 strone z szablonu
        $tplIdx = $this->pdf->importPage(1);
        // uzyj tej strony jako szablonu
        $this->pdf->useTemplate($tplIdx, 0, 0);

        // ustawia czcionke na Arial z polskimi znakami
        $this->pdf->AddFont('ArialPL','','arialpl.php');
        $this->pdf->SetFont('ArialPL');
        $this->pdf->SetTextColor(0,0,0);

        //dodaj do PDF wszystkie dane z podania
        $this->_render_appdata($appData);

        //wstaw 2 pusta strone z szablonu - rodzice wypelniaja ja recznie
        $this->pdf->AddPage();
        $tplIdx = $this->pdf->importPage(2);
        $this->pdf->useTemplate($tplIdx, 0, 0);

        $name = 'podanie_'.$appData['first_name'].'_'.$appData['last_name'];

        //renderuj PDF jako HTTP response
        $this->pdf->Output($name.'.pdf', ($download ? 'D' : 'I'), true, $response);
    }
}