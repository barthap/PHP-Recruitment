<?php defined('SYSPATH') or die('No direct script access.');

//Klasa reprezentujaca wiersz w tabeli panelu admina, dajaca sie latwo skonwertowac
//do JSON odczytywanego przez tabele w JavaScript
class TableData
{
    //lista wszystkich wierszy tabeli
    public static $rows = array();
    public static $rowCount = 1;

    //dane - nazwy odpowiadaja kolumnom tabeli w JavaScript (files/js/table.js)
    public $id;
    public $first_name;
    public $last_name;
    public $first_spec;
    public $sec_spec;
    public $languages;
    public $note;
    public $options;

    /*
     * konstruktor, tworzy wiersz tabeli w formacie odpowiadajacym temu w tabeli
     */
    public function TableData($application)
    {
        $this->id = TableData::$rowCount;
        $this->first_name = $application->first_name;
        $this->last_name = $application->last_name;

        $sel_specs = explode(', ', $application->specs);

        $this->first_spec = Utils::$specialisations[$sel_specs[0]];
        $this->sec_spec = Utils::$specialisations[$sel_specs[1]];

        $this->languages = AppRenderer::decode_langs($application->sel_langs, true);

        $note = $application->note;
        if(strlen($note) > 250)
        {
            $note = substr($note, 0, 255);
            $note = explode(' ', $note);
            $note = array_slice($note, 0, -2);
            $note = implode(' ', $note).'...';
        }
        $this->note = $note;

        $this->options = AppRenderer::generateOptions($application->id);

        TableData::$rows[] = $this; //dodaje nowo utworzony wiersz do listy
        TableData::$rowCount++;
    }
}