<?php defined('SYSPATH') or die('No direct script access.');

//klasa pomocnicza do wyswietlania informacji o podaniu
class AppRenderer
{

    /**
     * Generates Admin option links for specified App ID
     *
     * @param $app_id   Application ID
     * @return string   Rendered HTML
     */
    public static function generateOptions($app_id)
    {
        $options = array(
            '<a href="'.URL::site('admin/show/'.$app_id).'">Pokaż</a>',
            '<a href="#" class="edit-note" data-id="'.$app_id.'">Notatka</a>',
            '<a href="'.URL::site('student/pdf/'.$app_id).'">PDF</a>',
            '<a href="'.URL::site('admin/edit/'.$app_id).'">Edytuj dane</a>',
            '<a href="'.URL::site('admin/delete/.'.$app_id).'" class="text-danger">Usuń</a>',
        );

        return implode('<br>', $options);
    }

    /** @TODO: This function is deprecated. Replace it with some kind of new solutions...
     * Convert some parametrs of App model data to human-readable format
     *
     * @param $data
     * @return array
     */
    public static function prepare_basic($data)
    {

        $region = Utils::$regions[$data['addr_region']];
        $timestamp = strtotime($data['birth_date']);


        $langs  = self::decode_langs($data['sel_langs'], true);

        $specs = '';
        $sel_specs = explode(', ', $data['specs']);

        foreach($sel_specs as $i => $s)
        {
            $spec = Utils::$specialisations[$s];
            if($spec === false) continue;

            if($i == 0)$spec = '<u>'.$spec.'</u>';
            $specs .= $spec . '<br>';
        }

        $note = $data['note'];
        if(strlen($note) > 250)
        {
            $note = substr($note, 0, 255);
            $note = explode(' ', $note);
            $note = array_slice($note, 0, -2);
            $note = implode(' ', $note).'...';
        }

        $data['note_short'] = $note;

        $data['address'] = $data['addr_street'].'<br>'.$data['addr_zip'].' '.$data['addr_city'].'<br>'.$data['addr_province'].'<br>'.$region;
        $data['birth'] = $data['birth_place'].',<br>'.Utils::polishdate($timestamp);
        $data['languages'] = $langs;
        $data['specs'] = $specs;

        return $data;
    }

    /**
     * @TODO: This function is @deprecated
     *
     * @param $langs
     * @param bool $toString
     * @return array|string
     */
    public static function decode_langs($langs, $toString = false)
    {
        $sel_langs = explode(", ", $langs);

        if (!$toString) return $sel_langs;

        $langs = '';
        foreach ($sel_langs as $l) {

            if (!isset(Utils::$languages[$l])) continue;
            $langs .= Utils::$languages[$l] . '<br>';
        }

        return $langs;
    }
}