<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Rest_Applications extends Controller_Rest
{
    public function action_get()
    {
        //czy admin zalogowany
        if(!Auth::instance()->logged_in())
        {
            $this->response->status(403);
            return;
        }

        //nieuzywane - zapytanie JSON
        //$request_params = json_decode($this->request->body(), true);

        $json = null;

        //pobiera tablice wszystkich obiektow Application z bazy danych
        $apps = Application::getAll();

        //dla kazdego elementu tworzy wiersz TableData (w formacie tabeli)
        foreach($apps as $app)
        {
            new TableData($app);
        }

        //lista wierszy tabeli kodowana do JSON
        $json = TableData::$rows;

        $this->response->headers('Content-type','application/json; charset='.Kohana::$charset);
        $this->response->body(json_encode($json));
    }

    //nie potrzebujemy tych metod, zwracamy Error 405
    public function action_put()
    {
        $this->response->status(405);
    }
    public function action_post()
    {
        $this->response->status(405);
    }
    public function action_delete()
    {
        $this->response->status(405);
    }
}