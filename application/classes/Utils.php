<?php defined('SYSPATH') or die('No direct script access.');

//pomocnicze rzeczy
class Utils
{
    /**
     * @var array wojewodztwa
     */
    public static $regions = array(
        'dolnośląskie', 'kujawsko-pomorskie',
        'lubelskie',
        'lubuskie',
        'łódzkie',
        'małopolskie',
        'mazowieckie',
        'opolskie',
        'podkarpackie',
        'podlaskie',
        'pomorskie',
        'śląskie',
        'świętokrzyskie',
        'warmińsko-mazurskie',
        'wielkopolskie',
        'zachodniopomorskie',
    );

    //kierunki
    public static $specialisations = array(
        'Technik informatyk',
        'Technik elektronik',
        'Technik mechatronik',
        'Technik pojazdów samochodowych',
        'Technik mechanik (spec. CNC)',
        'Technik mechanik (spawalnictwo)',
        'Technik handlowiec',
        'Technik hotelarstwa',
        'Technik mechanizacji rolnictwa',
        'Technik żywienia i usług gastronomicznych',
        'Technik urządzeń i systemów energetyki odnawialnej',
        'Mechanik pojazdów samochodowych',
        'Operator obrabiarek skrawających',
        'Stolarz',
        'Elektryk',
        'Murarz - tynkarz',
        'Ślusarz',
        'Mechanik - operator pojazdów i maszyn rolniczych',
        'Sprzedawca',
        'Fryzjer',
        'Cukiernik',
        'Piekarz',
        'Kucharz',
        'Kelner',
    );

    public static $languages = array('en' => 'angielski',
        'de' => 'niemiecki',
        'ru' => 'rosyjski');

    /**
     * @var array Polish months' names
     */
    public static $months = array('Stycznia', 'Lutego', 'Marca', 'Kwietnia', 'Maja',
        'Czerwca', 'Lipca', 'Sierpnia', 'Września', 'Października', 'Listopada', 'Grudnia');

    /**
     * Sends alert message to session storage
     * It becomes available on redirected sites to read
     *
     * @param string $message Content of alert message
     * @param string $class Bootstrap CSS class of alert, e.g. alert-danger, alert-info, alert-success
     */
    public static function alert($message, $class = null)
    {
        Session::instance()->set('alert', $message);

        if ($class != null)
            Session::instance()->set('alert_class', $class);
    }

    /**
     * Renders alert message to HTML Bootstrap-styled alert
     *
     * @param string $alert Alert message to overwrite session data
     * @param string $alert_class Alert class to overwrite session alert class
     * @return string               Rendered alert HTML
     */
    public static function render_alert($alert = null, $alert_class = null)
    {
        $s = Session::instance();
        if (!isset($alert)) $alert = $s->get_once('alert');
        if (!isset($alert_class)) $alert_class = $s->get_once('alert_class', 'alert-info');

        if (isset($alert)) return '<p class="center-block alert ' . $alert_class . '">' . $alert . '</p>';
        else return '';
    }

    /**
     * Returns date in Polish language
     * Format: "j M Y"
     *
     * @param $timestamp    Unix timestamp
     * @return string       Date in polish month
     */
    public static function polishdate($timestamp)
    {
        $eng_month = date('n', $timestamp);
        $day = date('j', $timestamp);
        $month = Utils::$months[$eng_month - 1];
        $year = date('Y', $timestamp);

        return $day . ' ' . $month . ' ' . $year;
    }

    /**
     * Escapes HTML characters for each element of array
     *
     * @param array $array Array of strings to escape
     * @return array
     * @uses HTML::chars()
     */
    public static function escape_html($array)
    {
        $clean = array();
        foreach ($array as $key => $val) {
            $clean[$key] = HTML::chars($val);
        }

        return $clean;
    }

    /**
     * Returns school type based on selected spec index
     * @param integer $spec Specialisation index
     * @return string       Technikum or ZSZ
     */
    public static function school_type($spec)
    {
        return (($spec <= 10) ? 'Technikum' : 'Zasadnicza Szkoła Zawodowa');
    }

    /**
     * Renders HTML script tag with path to specified js file
     * JS base path is /files/js/
     *
     * @param $script   js filename
     * @return string   generated HTML
     */
    public static function js($script)
    {
        return '<script src="' . URL::base() . 'files/js/' . trim($script) . '"></script>';
    }

    /**
     * Renders HTML stylesheet tag with path to specified css file
     * CSS base path is /files/css/
     *
     * @param $file     css filename
     * @return string   generated HTML
     */
    public static function css($file)
    {
        return '<link rel="stylesheet" href="'. URL::base() .'files/css/'.$file.'">';
    }
}