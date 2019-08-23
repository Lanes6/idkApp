<?php

class LoginController{
    private $_userMapper;

    public function __construct()
    {
        $this->_userMapper=new UserMapper();
    }

    public function loginAction(){
        $return["sucess"]=false;
        if(isset($_POST["login"]) && isset($_POST["password"]) ){
            $login=$_POST["login"];
            $password=$_POST["password"];
            $userMapper = new UserMapper();
            $user=$userMapper->findByLogin($login);
            if($user != NULL && $user->getPassword()==$password){
                $_SESSION["id_user"]=$user->getId_User();
                $return["msg"]="Connecté!";
                $return["sucess"]=true;
            }else{
                $return["msg"]="Identifiants invalides";
            }
        }else{
            $return["msg"]="Un ou plusieurs paramètre sont absent";
        }
        echo(json_encode($return));
    }
}