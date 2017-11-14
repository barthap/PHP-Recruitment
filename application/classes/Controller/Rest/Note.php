<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Rest_Note extends Controller_Rest
{
    public function action_get()
    {
        //admin zalogowany?
        if(!Auth::instance()->logged_in() or !isset($this->_id))
        {
            $this->response->status(403);
            return;
        }

        //pobiera podanie o ID z zapytania
        $app = Application::get(intval($this->_id));

        //odpowiedz typu plain text - tresc notatki
        $this->response->headers('Content-type','text/plain; charset='.Kohana::$charset);
        $this->response->body($app->note);
    }

    //put nadpisuje tresc notatki do podania o ID podanym w zapytaniu
    public function action_put()
    {
        if(!Auth::instance()->logged_in() or !$this->_isAjax or !isset($this->_id))
        {
            $this->response->status(403);
            return;
        }

        $model = new Model_Applications();
        $newNote = $this->request->body();  //tresc jako cialo zapytania HTTP
        $status = $model->setNote($this->_id, $newNote);    //nadpisz notatkie

        //zwroc sukces albo error
        $this->response->headers('Content-type','application/json; charset='.Kohana::$charset);
        $this->response->body(json_encode(
            array('status' => ($status ? 'success' : 'error'),
                'success' => $status,
            )));
    }

    //nie uzywamy post i delete
    public function action_post()
    {
        $this->response->status(405);
    }
    public function action_delete()
    {
        $this->response->status(405);
    }
}