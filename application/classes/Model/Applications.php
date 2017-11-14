<?php defined('SYSPATH') OR die('No direct script access.');

class Model_Applications extends Model_Database
{

    /**
     * Retrieves one (specified by ID) or all application data from database
     * Return is an assoc array
     *
     * @param integer $id   ID of application to get data from
     * @return mixed        One application of array of all apps in database
     */
    public function get($id = null)
    {
        $query = DB::select()->from('applications')->order_by('last_name', 'ASC');

        if ($id != null) {
            $query->where('id', '=', $id);
        }

        $result = $query->execute();
        $list = $result->as_array();

        if ($id != null) {
            return $list[0];
        } else {
            return $list;
        }
        
    }

    /**
     * Retrieves from database App data by User ID
     *
     * @warning: Function does not check if user exists!
     *
     * @param $user_id  User ID of data to specify
     * @return mixed    Appl data
     */
    public static function getByUserId($user_id, $as_object = false)
    {
        $query = DB::select()->from('applications')->where('user_id', '=', $user_id);

        if($as_object === true)return $query->as_object('Application')->execute()->current();

        $res = $query->execute()->as_array();
        return $res[0];
    }

    /**
     * Registers application to database
     *
     * @param $post     Post data from registration form
     * @return integer  ID of inserted App record
     *
     * @throws Kohana_Exception     DB Query fail
     */
    public function register($post)
    {

        //some data needs parsing
        $specialisations = $post['school-first'] . ', ' . $post['school-second'] . ', ' . $post['school-third'];

        $languages = array();
        if (isset($post['languages_en']) && $post['languages_en'] == "en") $languages[] = "en";
        if (isset($post['languages_de']) && $post['languages_de'] == "de") $languages[] = "de";
        if (isset($post['languages_ru']) && $post['languages_ru'] == "ru") $languages[] = "ru";


        //prepare db table row data
        $db_array = array();

        $db_array['first_name'] = $post['first_name'];
        $db_array['last_name'] = $post['last_name'];
        $db_array['birth_date'] = date("Y-m-d", strtotime($post['birth_date']));    //MySQL date format is Y-m-d
        $db_array['birth_place'] = $post['birth_place'];
        $db_array['addr_street'] = $post['addr_street'];
        $db_array['addr_city'] = $post['addr_city'];
        $db_array['addr_zip'] = $post['addr_zip'];
        $db_array['addr_province'] = $post['addr_province'];
        $db_array['addr_region'] = intval($post['region']);
        $db_array['pesel'] = $post['pesel'];
        $db_array['specs'] = $specialisations;
        $db_array['sel_langs'] = self::encode_langs($languages);
        $db_array['secondary_name'] = $post['secondary_name'];
        $db_array['secondary_langs'] = $post['secondary_langs'];
        $db_array['tel'] = $post['tel'];

        //database part
        $keys = array_keys($db_array);
        $values = array_values($db_array);

        $query = DB::insert('applications', $keys)->values($values);
        list($insert_id, $affected_rows) = $query->execute();

        if ($affected_rows != 1)
            throw new Kohana_Exception('Query ' . $query . ' probably failed! Check it! Affected rows = ' . $affected_rows . ' and last insert id = ' . $insert_id);

        return $insert_id;
    }

    /**
     * Binds User with specified ID to Application with specified ID
     *
     * @param $app_id   App ID
     * @param $user_id  User ID
     * @throws Kohana_Exception Query fail
     */
    public function bindUser($app_id, $user_id)
    {
        $query = DB::update('applications')->set(array('user_id' => $user_id))->where('id', '=', $app_id);
        $rows = $query->execute();
        if ($rows != 1) throw new Kohana_Exception('Query ' . $query . ' probably failed! Check it! Affected rows = ' . $rows);
    }

    public static function getBySpec($spec)
    {
        $query = DB::select()->from('applications')->where('sel_specs', 'LIKE', $spec.'%')->as_object('Application');
        return $query->execute();
    }

    public static function delete($id)
    {
        return DB::delete('applications')->where('id', '=', $id)->execute();
    }

    /**
     * Deletes ALL records from applications table
     * @return object result of query execute() method
     */
    public static function deleteAll()
    {
        return DB::delete('applications')->execute();
    }
    /**
     * Checks if exists application with specified ID in database
     *
     * @param $id
     * @return bool
     */
    public function exists($id)
    {
        $query = DB::select('id')->from('applications')->where('id', '=', $id);
        $result = $query->execute()->as_array();

        return (count($result) > 0);
    }

    /**
     * Validator helper function - checks if specified PESEL is unique
     *
     * @param $pesel
     * @return bool
     */
    public static function unique_pesel($pesel)
    {
        // Check if the pesel already exists in the database
        return ! DB::select(array(DB::expr('COUNT(pesel)'), 'total'))
            ->from('applications')
            ->where('pesel', '=', $pesel)
            ->execute()
            ->get('total');
    }

    /**
     * Sets note content to application with specified ID
     *
     * @param $id           App id
     * @param string $note  Note content
     */
    public function setNote($id, $note = '')
    {
        if(!$this->exists($id))return false;

        $query = DB::update('applications')->set(array('note' => $note))->where('id', '=', $id);
        $rows = $query->execute();

       // if ($rows != 1) return false;   //throw new Kohana_Exception('Query ' . $query . ' probably failed! Check it! Affected rows = ' . $rows);

        return true;
    }
    public function setAccepted($id, $accept)
    {
        if(!$this->exists($id))return false;

        $query = DB::update('applications')->set(array('accepted' => ($accept ? 1 : 0)))->where('id', '=', $id);
        $rows =  $query->execute();
        return true;
        // if ($rows != 1) return false;   //throw new Kohana_Exception('Query ' . $query . ' probably failed! Check it! Affected rows = ' . $rows);
    }

    /*
     * Liczy ilosc przyjetych uczniow w bazie danych (accepted=1)
     */
    public static function countAccepted()
    {
        return DB::select(array(DB::expr('COUNT(`accepted`)'), 'num_accepted'))->from('applications')->where('accepted' , '=', 1)->execute()->get('num_accepted', -1);
    }

    public static function encode_langs($lang_array)
    {
        return implode(', ', $lang_array);
    }



}