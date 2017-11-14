<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin extends Controller_Template {

    private $menu;

    public function before()
    {
        parent::before();

        //tworzymy menu Admina
        $this->menu = new Menu('admin/menu');
        $this->menu->addItem('home', 'admin', 'Admin Home');
        $this->menu->addItem('apps', 'admin/applications', 'Wszystkie wnioski');
        $this->menu->addItem('list', 'admin/list', 'Zarządzaj wnioskami');

        $this->template->title = "Panel administratora";

    }
    public function after()
    {
        $this->menu->view->logged_in = Auth::instance()->logged_in();

        $this->template->menu = $this->menu->render();


        parent::after();
    }

    /**
     * Strona glowna panelu Admina
     */
    public function action_index()
    {
        $this->menu->setActive('home');

        if (Auth::instance()->logged_in())
        {
            $this->template->content = View::factory('admin/home');
        }
        else
        {
            $this->template->content = View::factory('admin/login');
        }
    }

    //strona /admin/list - dynamiczna lista z sortowaniem
    public function action_list()
    {
        //ustawia aktywne menu
        $this->menu->setActive('list');
        $this->template->title = "Zarządzanie podaniami";

        //sprawdza czy admin zalogowany
        if (!Auth::instance()->logged_in())HTTP::redirect('admin', 302);

        //po prostu wyswietla widok views/admin/dynamic-list.php
        $this->template->content = View::factory('admin/dynamic-list');
    }
    /**
     * Lista wszystkich podan /admin/applications
     */
    public function action_applications()
    {
        $this->menu->setActive('apps');

        if (!Auth::instance()->logged_in())HTTP::redirect('admin', 302);

        //model Applications
        $model = new Model_Applications();
        $cont = '';
        $res = $model->get();   //pobiera tresc wszystkich podań jako tablice

        $view = View::factory('admin/app-list');
        $rows = array();

        //dla kazdego podania
        foreach ($res as $r)
        {
            //przygotowuje dane do wyswietlenia
            $dat = AppRenderer::prepare_basic($r);
            $dat['options'] = AppRenderer::generateOptions($r['id']);
            $rows[] = $dat;
        }

        $view->rows = $rows;

        //wyswietla widok
        $this->template->set('content', $view->render());
    }

    /**
     * pokauje podanie /admin/show/ID
     */
    public function action_show()
    {
        //pobiera ID z adresu URL
        $id = $this->request->param('id', null);

        if(!isset($id) or !Auth::instance()->logged_in())
            HTTP::redirect('admin', 302);

        $model = new Model_Applications();
        $app = $model->get($id);
        $niceData = AppRenderer::prepare_basic($app);
        $niceData['has_account'] = (intval($app['user_id']) > -1);
        $niceData['id'] = $app['id'];

        //tworzy widok i uzupełnia dane do wyswietlenia
        $view = View::factory('admin/app');
        $view->data = $niceData;

        $this->template->content = $view->render(); //wyswietla ten widok

    }

    public function action_edit()
    {
        $id = $this->request->param('id', null);

        if(!isset($id) or !Auth::instance()->logged_in())
            HTTP::redirect('admin', 302);

        $app = Application::get($id);

        Session::instance()->set('edit_id', $id);

        $view = View::factory('edit');
        $view->set('post', $app->toArray());
        $view->set('action', 'admin/save');
        $this->template->content = $view->render();
    }

    /**
     * Usuwa podanie o podanym ID
     * Jesli ID='all' - usuwa wszystkie podania
     */
    public function action_delete()
    {
        $id = $this->request->param('id', null);

        if(!isset($id) or !Auth::instance()->logged_in())
            HTTP::redirect('admin', 302);

        if($id === 'all')
        {
            Model_Applications::deleteAll();
            Model_Students::deleteAll();

            Utils::alert('Usunięto wszystkie podania z bazy danych!');
            HTTP::redirect('admin');
        }
        else
        {
            Model_Applications::delete($id);
            Model_Students::delete($id);
            HTTP::redirect('admin/applications');
        }

    }

    /**
     * Zapisuje dane po aktualizacji w admin/edit
     */
    public function action_save()
    {
        $post = Utils::escape_html($this->request->post());

        if (!isset($post['sent']) or $post['sent'] != "1") HTTP::redirect('admin');
        if(!Auth::instance()->logged_in())
            HTTP::redirect('admin', 302);

        $id = Session::instance()->get_once('edit_id', false);
        if($id === false)HTTP::redirect('admin');

        $application = new Application($post);
        $application->edited = 1;           //podanie bylo edytowane
        $result = $application->save($id);

        if($result !== 1)Utils::alert('Błąd podczas aktualizacji danych!', 'alert-danger');
        else Utils::alert('Zaktualizowano pomyślnie', 'alert-success');

        HTTP::redirect('admin');
    }

    /**
     * logowanie admin/login
     */
    public function action_login()
    {
        // dane POST zapytania HTTP
        $post = $this->request->post();

        //tworzy widok view/admin/login.php
        $view = View::factory('admin/login');

        if(isset($post['email'], $post['password']))    //czy podano email i haslo
        {
            //logowanie
            $success = Auth::instance()->login($post['email'], $post['password']);

            if ($success)
            {
                Utils::alert('Zalogowano pomyślnie!', 'alert-success');

                HTTP::redirect('admin');
            }
            else
            {
                $view->alert = "Błędne dane logowania!";
                $view->alert_class = 'alert-danger';
            }
        }

        $this->template->content = $view->render();


    }

    /**
     * wylogowanie sie
     * wylogowuje i wyswietla widok
     */
    public function action_logout()
    {
        Auth::instance()->logout();
        $view = View::factory('admin/login');
        $view->alert = 'Wylogowano pomyślnie. <a href="'.URL::site('home').'">Strona główna</a>';
        $view->alert_class = 'alert-info';
        $this->template->content = $view;
    }

}