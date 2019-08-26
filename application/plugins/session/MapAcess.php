<?php

class MapAcess
{
    private $_mapAcess;

    public function __construct()
    {
        $this->_mapAcess = array(
            "default" => array(),
            "ws" => array()
        );
        $this->_mapAcess["default"] = array(
            "ErrorController" => array(),
            "HomeController" => array(),
            "LoginController" => array(),
            "UserController" => array()
        );
        $this->_mapAcess["ws"] = array(
            "LoginwsController" => array(),
            "UserwsController" => array()
        );
        $this->_mapAcess["default"]["ErrorController"] = array(
            "indexAction"=>0
        );
        $this->_mapAcess["default"]["HomeController"] = array(
            "indexAction"=>0
        );
        $this->_mapAcess["default"]["LoginController"] = array(
            "indexAction"=>0
        );
        $this->_mapAcess["default"]["UserController"] = array(
            "indexAction"=>1
        );
        $this->_mapAcess["ws"]["LoginwsController"] = array(
            "loginAction"=>0,
            "refreshjwtAction"=>0
        );
        $this->_mapAcess["ws"]["UserwsController"] = array(
            "selectallAction"=>1
        );
    }

    //return l'accès du triplet module-controller-action
    function getAcces($module, $controller, $action){
        return $this->_mapAcess[$module][$controller][$action];
    }
}