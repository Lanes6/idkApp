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

        /*$JwtUser=password_hash("lanes2", CRYPT_BLOWFISH);
        echo($JwtUser);*/
        /*echo("<br>");*/
       /* if(password_verify("tdest",$JwtUser)){

        }else {

        }*/
        $JwtUser2=password_hash("test", CRYPT_BLOWFISH);
        //echo($JwtUser2);

        /*$iniFile = Retrinko\Ini\IniFile::load(PATH_CONFIG."database.ini");
        echo("hello\n");
        echo($iniFile->get('database', 'adapter'));
        echo("\nbye");
        //self::$_bdd = new PDO('mysql:host='.$iniFile->get('database', 'host').';dbname='.$iniFile->get('database', 'dbname'), $iniFile->get('database', 'username'), '');
        $payload = array(
            'userid' => "e",
            'iat' => "e",
            'exp' => "expirationTime"
        );
        $key = "d";
        $alg = 'HS256';
        $jwt = JWT::encode($payload, $key, $alg);
        echo($jwt);
        */


        $this->_view=new View('home','index','idkApp-Home');
        $this->_view->generate($data);
    }


}