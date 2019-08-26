<?php
require_once('application/modules/default/views/View.php');

class ErrorController
{
private $_view;
    public function __construct()
    {
    }

    public function indexAction($errorMsg="Il semblerait que votre action est engendrée une erreur"){
        if($errorMsg==""){
            $errorMsg="Il semblerait que votre action est engendrée une erreur";
        }
        $data["msg"]=$errorMsg;
        $this->_view=new View('error','index','idkApp-Error');
        $this->_view->generate($data);
    }
}