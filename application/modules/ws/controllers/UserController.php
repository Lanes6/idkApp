<?php

class UserController{
    private $_userMapper;
    private $_view;

    public function __construct()
    {
        $this->_userMapper=new UserMapper();
    }

    public function indexAction(){
        $data["users"]=$this->_userMapper->getUsers();
        echo json_encode($data);
    }
}