<?php
require_once('application/modules/default/views/View.php');

class UserController{
    private $_userMapper;
    private $_view;

    public function __construct()
    {
        $this->_userMapper=new UserMapper();
    }

    public function indexAction(){
        $data["users"]=$this->_userMapper->getUsers();
        $this->_view=new View('user','index','idkApp-Users');
        $this->_view->generate($data);
    }


}