<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Rest_Accept extends Controller_Rest
{
    public function action_get()
    {
        //Sprawdza czy admin zalogowany
        if(!Auth::instance()->logged_in())
        {
            $this->response->status(403);
            return;
        }

        $json = null;

        //jesli w zapytaniu byl podany ID
        if(isset($this->_id))
        {
            $app = Application::get(intval($this->_id));    //pobiera podanie z tym ID
            $json = array('accepted' => (bool) $app->accepted);
        }
        else
        {
            $count = Model_Applications::countAccepted();

            $error = ($count < 0);
            $json = array('error' => $error, 'count' => $count);
        }

        //wysyla odpowiedz JSON
        $this->response->headers('Content-type','application/json; charset='.Kohana::$charset);
        $this->response->body(json_encode($json));
    }
    public function action_put()
    {
      /*  if(!Auth::instance()->logged_in() or !$this->_isAjax or !isset($this->_id))
        {
            $this->response->status(403);
            return;
        }
*/
      //tworzy model aplikacji i pobiera z zapytania JSON
        $model = new Model_Applications();
        $json = json_decode($this->request->body());
        $status = $model->setAccepted($this->_id, $json->accepted);

        $this->response->headers('Content-type','application/json; charset='.Kohana::$charset);
        $this->response->body(json_encode(
            array('status' => ($status ? 'success' : 'error'),
                'success' => $status,
            )));
    }

    //nie obslugujemy POST i DELETE
    public function action_post()
    {
        $this->response->status(405);
    }
    public function action_delete()
    {
        $this->response->status(405);
    }
}