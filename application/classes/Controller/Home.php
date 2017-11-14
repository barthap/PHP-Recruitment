<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Home extends Controller_Template {

    public function before()
    {
        parent::before();

        //strona glowna ma inny szablon niz reszta - view/home.php
        $this->template = View::factory('home');
        $this->template->title = "Rekrutacja";
    }

    //strona glowna
    public function action_index()
    {
        $view = '<a class="btn btn-primary" role="button" href="'.URL::site('student').'">Przejdź &raquo;</a>';
        if(!Model_Students::instance()->logged_in())
            $view = View::factory('student/login')->render();

        $this->template->set('student_panel', $view);
    }
    public function action_hash()
    {
        $id = $this->request->param('id');
        $this->auto_render = false;
        $this->response->body(Auth::instance()->hash($id));
    }


}