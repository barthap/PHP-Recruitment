<?php defined('SYSPATH') or die('No direct script access.');

//Klasa reprezentujaca wiersz w tabeli applications
class Application
{
    private $_db_array;

    /**
     * Gets Application object with ID = $id
     * @param $id
     * @param bool $user_id
     * @return object Application
     */
    public static function get($id, $user_id = false)
    {
        $object = DB::select()->from('applications')->where(($user_id ? 'user_id' : 'id'), '=', $id)->as_object('Application')->execute()->current();
        return $object;
    }

    /**
     * Return array of all Application objects
     *
     * @return array
     */
    public static function getAll()
    {
        $object = DB::select()->from('applications')->order_by('last_name', 'ASC')->as_object('Application');
        return $object->execute();
    }

    public function __construct($db_array = null)
    {
        $this->_db_array = $db_array;

        if($db_array === null)return;

        foreach ($db_array as $k => $v)
        {
            $this->$k = $v;
        }
    }

    public function fullName()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function toArray()
    {
        return (array) $this;
    }

    //aktualizuje dane
    public function save($id = null)
    {
        $keys = array('first_name', 'last_name', 'birth_date', 'birth_place', 'addr_street', 'addr_city', 'addr_zip', 'addr_province', 'pesel', 'secondary_name', 'secondary_langs', 'tel', 'edited');
        $values = array();
        foreach($keys as $key)
            $values[$key] = $this->$key;

        if($id === null)$id = $this->id;
        if($id === null)return false;

        $query = DB::update('applications')->set($values)->where('id', '=', $id);
        return $query->execute();
    }
}