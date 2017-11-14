<?php defined('SYSPATH') OR die('No direct script access.');

abstract class Controller_Template extends Kohana_Controller_Template {

    public function before()
    {
        parent::before();

        View::set_global('alert', null);
        View::set_global('alert_class', null);

        View::set_global('site_title', 'Rekrutacja');

        $this->template->title = '';
        $this->template->menu = '';     //default no menu
    }

    /**
     * Assigns the template [View] as the request response.
     */
    public function after()
    {
        //render the template file
        parent::after();
    }
}
