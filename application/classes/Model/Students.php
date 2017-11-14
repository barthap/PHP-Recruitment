<?php defined('SYSPATH') OR die('No direct script access.');

class Model_Students
{
    protected static $_instance;

    protected $_session;

    public static function instance()
    {
        if (!isset(Model_Students::$_instance)) {
            Model_Students::$_instance = new Model_Students();
        }

        return Model_Students::$_instance;
    }

    protected function __construct()
    {
        $this->_session = Session::instance();
    }

    //tworzy uzytkownika w bazie danych
    public function createUser($email, $pass, $app_id)
    {
        $pass = Auth::instance()->hash($pass);

        $query = DB::insert('students', array('app_id', 'email', 'password'))->values(array($app_id, $email, $pass));
        list($insert_id, $affected_rows) = $query->execute();
        if ($affected_rows != 1) throw new Kohana_Exception('Query ' . $query . ' probably failed! Check it! Affected rows = ' . $affected_rows . ' and last insert id = ' . $insert_id);
        return $insert_id;
    }

    /**
     * Deletes ALL records from students table
     * @return object result of query execute() method
     */
    public static function deleteAll()
    {
        return DB::delete('students')->execute();
    }

    /**
     * Deletes record with specified app_id
     * @param $app_id
     * @return object
     */
    public static function delete($app_id)
    {
        return DB::delete('students')->where('app_id', '=', $app_id)->execute();
    }

    public function getByAppId($app_id)
    {
        $query = DB::select()->from('students')->where('app_id', '=', $app_id);

        $users = $query->execute()->as_array();

        if (count($users) != 1) return false;

        return $users[0];
    }

    public function get($id = null)
    {
        if ($id == null) $id = $this->_session->get('student_id', null);
        if ($id == null) return false;

        $query = DB::select()->from('students')->where('id', '=', $id);

        $users = $query->execute()->as_array();
        if (count($users) != 1) return false;

        return $users[0];
    }

    public function force_login($id)
    {
        $this->_session->set('student_id', $id);
    }

    public function login($email, $pass)
    {
        if (!isset($email, $pass)) return false;

        $pass = Auth::instance()->hash($pass);
        $query = DB::select()->from('students')->where('email', '=', $email)->and_where('password', '=', $pass);
        $users = $query->execute()->as_array();

        if (count($users) != 1) return false;

        $user = $users[0];

        $this->force_login($user['id']);

        return $user;
    }

    public function logout()
    {
        $this->_session->delete('student_id');
    }

    public function logged_in()
    {
        return $this->_session->get('student_id', false);
    }

    //@deprecated
    public static function full_name($app)
    {
        return $app['first_name'] .' '. $app['last_name'];
    }
}