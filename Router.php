<?php

class Router
{
    private $_ctrl;
    private $_view;

    public function routeReq()
    {
        try {
            //CHARGEMENT AUTO DES CLASS
            spl_autoload_register(function ($class) {
                require_once('application/modules/default/models/'.$class.'.php');
            });
            $url = '';
            if (isset($_GET['url'])) {
                $url = explode('/', filter_var($_GET['url']),FILTER_SANITIZE_URL);
                if ((count($url) <= 2 || count($url) >= 3) && strtolower($url[0]=='ws')) {
                    //idkApp/ws/controller/action
                    $module = strtolower($url[0]);
                    $controller = ucfirst(strtolower($url[1])) . "Controller";
                    $action = "indexAction";
                    if (count($url) == 3) {
                        $action = strtolower($url[2]) . "Action";
                    }
                }elseif (count($url) <= 1 || count($url) >= 2){
                    //idkApp/controller/action
                    $module = 'default';
                    $controller = ucfirst(strtolower($url[0])) . "Controller";
                    $action = "indexAction";
                    if (count($url) == 2) {
                        $action = strtolower($url[1]) . "Action";
                    }

                }else{
                    throw new Exception('Url incorrect');
                }
                    $controllerFile = 'application/modules/' . $module . '/controllers/' . $controller . '.php';
                    if (file_exists($controllerFile)) {
                        require_once($controllerFile);
                        $this->_ctrl = new $controller();
                        $this->_ctrl->$action();
                    } else {
                        throw new Exception('Page introuvable');
                    }
            } else {
                require_once('application/modules/default/controllers/HomeController.php');
                $this->_ctrl = new HomeController();
                $this->_ctrl->indexAction();
            }
        } catch (Exception $e) {
            $msgError = $e->getMessage();
            require_once('application/modules/default/controllers/ErrorController.php');
            $this->_ctrl = new ErrorController();
            $this->_ctrl->indexAction($msgError);
        }
    }
}