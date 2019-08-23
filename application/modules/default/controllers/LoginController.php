<?php
require_once('application/modules/default/views/View.php');

class LoginController
{
    private $_view;

    public function __construct()
    {
    }

    public function indexAction(){
        $data=[];
        $this->_view=new View('login','index','idkApp-Login');
        $this->_view->generate($data);
    }
}