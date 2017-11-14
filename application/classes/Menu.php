<?php defined('SYSPATH') OR die('No direct script access.');


/*
 * Klasy pomocnicze do menu w panelu admina i ucznia
 */

//zarzadzanie menu
class Menu extends Model
{
    public $view;

    private $menu_items;

    public function __construct($view)
    {
        $this->view = View::factory($view);
    }

    //dodaje pozycje do menu
    public function addItem($id, $link, $title, $public = false, $active = false)
    {
        $this->menu_items[$id] = new MenuItem(URL::site($link), $title, $public, $active);
    }

    //ustawia pozycje o podanym ID jako aktywna
    public function setActive($id, $active = true)
    {
        $this->menu_items[$id]->active = $active;
    }

    //renderuje widok menu
    public function render()
    {
        $publ = '';
        $priv = '';

        foreach($this->menu_items as $item)
        {
            if($item->publ)
                $publ.=$item->render();
            else
                $priv.=$item->render();
        }

        $this->view->set('public_items', $publ);
        $this->view->set('private_items', $priv);

        return $this->view->render();
    }

}

//pojedyncza pozycja menu
class MenuItem
{
    public $link;   //url
    public $title;  //wyswietlany tytul
    public $publ;   //czy niezalogowany widzi
    public $active; //aktualnie aktywna podstrona

    public function __construct($link, $title, $public, $active = false)
    {
        $this->title = $title;
        $this->link = $link;
        $this->active = $active;
        $this->publ = $public;
    }

    public function render()
    {
        if($this->active)
            return '<li class="active"><a href="'.$this->link.'">'.$this->title.'<span class="sr-only">(current)</span></a></li>';
        else
            return '<li><a href="'.$this->link.'">'.$this->title.'<span class="sr-only">(current)</span></a></li>';
    }
}