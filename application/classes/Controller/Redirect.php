<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Redirect extends Controller {

    public function action_index()
    {
        $this->response->body(View::factory('redirect')->render());
    }

}