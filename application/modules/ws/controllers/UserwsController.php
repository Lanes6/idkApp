<?php

class UserwsController{
    private $_userMapper;
    private $_view;

    public function __construct()
    {
        $this->_userMapper=new UserMapper();
        http_response_code(500);
    }

    public function selectallAction(){
        $return=[];
        $return["users"]=$this->_userMapper->fetchAll();
        http_response_code(200);
        echo json_encode($return);
    }
}