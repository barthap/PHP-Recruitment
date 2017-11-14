<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Student extends Controller_Template
{

    private $menu;

    public function before()
    {
        parent::before();

        //tworzy menu panelu ucznia
        $this->menu = new Menu('student/menu');

        $this->menu->addItem('reg', 'student/register', 'Rejestracja', true);
        $this->menu->addItem('show', 'student/show', 'Moje dane', false);
        $this->menu->addItem('edit', 'student/edit', 'Edycja danych', false);

        $this->template->title = "Panel ucznia";

    }

    public function after()
    {
        //menu zaleznie od tego czy jest zalogowany
        $this->menu->view->logged_in = (Model_Students::instance()->logged_in() !== false);
        $this->template->menu = $this->menu->render();
        parent::after();
    }

    //strona glowna panelu ucznia - jesli niezalogowany to przekierowuje na strone glowna
    public function action_index()
    {
        if ($user = Model_Students::instance()->logged_in()) {
            $app = Model_Applications::getByUserId($user);
            $view = View::factory('student/home');
            $view->name = Model_Students::full_name($app);
            $view->id = $app['id'];
            $this->template->content = $view->render();
        } else {
            HTTP::redirect('home', 302);
        }
    }

    //rejestracja
    public function action_register()
    {
        //aktywne menu
        $this->menu->setActive('reg');

        //nie mozna sie zarejestrowac bedac zalogowanym
        if (Model_Students::instance()->logged_in() !== false) {
            $this->template->content = '<h4>Jesteś już zalogowany! Nie możesz zarejestrować się ponownie!</h4>';
            return;
        }

        $modelApp = new Model_Applications();


        //zabezpieczenie przed SQL injection
        $post = Utils::escape_html($this->request->post());

        //formularz musi wysłać jako POST wartość sent=1
        //jesli nie wyslal to trzeba go wyswietlic (view/student/register.php)
        if (!isset($post['sent']) or $post['sent'] != "1") {
            $this->template->content = View::factory('student/register');
            return;
        }

        //czy chce zalozyc konto czy tylko zlozyc podanie
        $create_account = (isset($post['account']) and $post['account'] == 'yes');

        //lista zasad poprawnosci dla kazdego pola formularza
        $validation = Validation::factory($post)
            ->rule('first_name', 'not_empty')
            //->rule('first_name', 'alpha')
            ->rule('last_name', 'not_empty')
            ->rule('last_name', 'alpha')
            ->rule('birth_place', 'not_empty')
            ->rule('birth_date', 'not_empty')
            ->rule('birth_date', 'date')
            ->rule('pesel', 'not_empty')
            ->rule('pesel', 'numeric')
            ->rule('pesel', 'exact_length', array(':value', 11))
            ->rule('pesel', 'Model_Applications::unique_pesel', array(':value'))
            ->rule('addr_city', 'not_empty')
            ->rule('addr_street', 'not_empty')
            ->rule('addr_zip', 'not_empty')
            ->rule('addr_province', 'not_empty')
            ->rule('tel', 'numeric')
            ->rule('region', 'not_empty')
            ->rule('secondary_name', 'not_empty')
            ->rule('secondary_langs', 'not_empty')
            ->rule('sent', 'in_array', array(':value', array('1')));

        if ($create_account) {
            $validation->rule('email', 'email')
                ->rule('email', 'not_empty')
                ->rule('password', 'not_empty')
                ->rule('password', 'min_length', array(':value', 6));
        }

        //jesli niepoprawnie wypelniony to wyswietl bledy i pokaz ponownie formularz
        if (!$validation->check()) {
            $errors = $validation->errors('register');
            $view = View::factory('student/register');
            $view->errors = $validation->errors('register');
            $view->post = $post;
            $this->template->content = $view->render();
            return;
        }

        //model dostaje dane - tworzy rekord w bazie danych
        $app_id = $modelApp->register($post);


        //zakładanie konta - przypisuje ID uzytkownika do ID podania
        if ($create_account) {
            $users = Model_Students::instance();

            $user_id = $users->createUser($post['email'], $post['password'], $app_id);

            $modelApp->bindUser($app_id, $user_id);
        }

        $view = View::factory('student/register-complete');
        $view->id = $app_id;
        $view->post = $post;
        $view->account = $create_account;

        $this->template->set('content', $view->render());

    }

    //logowanie
    public function action_login()
    {
        $post = $this->request->post();

        if (!isset($post['email']) || !isset($post['password'])) {
            HTTP::redirect('home', 302);
        }

        $user_model = Model_Students::instance();

        $user = $user_model->login($post['email'], $post['password']);
        if ($user === false) {
            Utils::alert('Błędne danie logowania!', 'alert-danger');
            HTTP::redirect('home', 302);
        }


        Utils::alert('Zalogowano pomyślnie.');
        HTTP::redirect('student', 302);
    }

    //wylogowanie
    public function action_logout()
    {
        Model_Students::instance()->logout();

        Utils::alert('Zostałeś(aś) Wylogowany/a');
        HTTP::redirect('home', 302);
    }

    //pokazanie danych /student/show
    public function action_show()
    {
        $user = Model_Students::instance()->logged_in();
        if ($user === false) {
            HTTP::redirect('home');
        }

        $this->template->title = "Moje dane";
        $this->menu->setActive('show');


        $app = Model_Applications::getByUserId($user);
        $niceData = AppRenderer::prepare_basic($app);


        $view = View::factory('student/view-app');
        $view->data = $niceData;

        $this->template->content = $view->render();
    }

    //pokazanie pdf w przegladarce
    public function action_pdf()
    {
        $this->auto_render = false;              //wylacza render szablonu, biblioteka PDF renderuje sie sama
        $id = $this->request->param('id');  //ID podania z URL

        //Create models and Render PDF view
        $app = new Model_Applications();
        $model = new Model_PDF();
        $model->Render($this->response, $app->get($id), false); //false - renderuje PDF w przegladarce
    }

    //pobranie pdf
    public function action_download()
    {
        $this->auto_render = false;
        $id = $this->request->param('id');

        $app = new Model_Applications();
        $model = new Model_PDF();
        $model->Render($this->response, $app->get($id), true);  //true - pobiera PDF jako plik
    }

    //edycja danych
    public function action_edit()
    {
        $this->menu->setActive('edit');

        if (!$user = Model_Students::instance()->logged_in()) HTTP::redirect('home');

        $app = Model_Applications::getByUserId($user, true);

        $view = View::factory('edit');
        $view->set('post', $app->toArray());
        $view->set('action', 'student/save');
        $this->template->content = $view->render();
    }

    //zapis danych po edycji
    public function action_save()
    {
        $post = Utils::escape_html($this->request->post());

        if (!isset($post['sent']) or $post['sent'] != "1") HTTP::redirect('home');
        if (!$user = Model_Students::instance()->logged_in()) HTTP::redirect('home');


        $id = Model_Applications::getByUserId($user)['id'];
        $application = new Application($post);
        $application->edited = 1;
        $result = $application->save($id);

        if($result !== 1)Utils::alert('Błąd podczas aktualizacji danych!', 'alert-danger');
        else Utils::alert('Zaktualizowano pomyślnie', 'alert-success');

        HTTP::redirect('student');
    }

}