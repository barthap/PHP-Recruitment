<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Rest extends Controller
{
    protected $_id;
    protected $_body;
    protected $_isAjax;

    public function before()
    {
        parent::before();

        $this->_id = $this->request->param('id', null);
        $this->_body = $this->request->body();
        $this->_isAjax = $this->request->is_ajax();
    }

}