<?php
require_once('application/modules/default/views/View.php');

class HomeController
{
    private $_view;

    public function __construct()
    {
    }

    public function indexAction(){
        $data["msg"]='Home';
        $this->_view=new View('home','index','idkApp-Home');
        $this->_view->generate($data);
    }


}