<?php
require_once('application/modules/default/views/View.php');

class UserController{
    private $_view;

    public function __construct()
    {

    }

    public function indexAction(){
        $data=array();
        $this->_view=new View('user','index','idkApp-Users');
        $this->_view->generate($data);
    }
}


/*//appel au ws
$opts = array(
    'http'=>array(
        'method'=>"GET",
        'header'=>"Accept-language: en\r\n" .
            "Cookie: foo=bar\r\n"
    )
);
$urlWs=URL."ws/user";
$context = stream_context_create($opts);
$dataJson = file_get_contents($urlWs, false, $context);
$data["users"]=json_decode($dataJson)->users;*/