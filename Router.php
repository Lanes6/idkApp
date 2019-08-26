<?php

class Router
{
    private $_ctrl;
    private $_view;

    public function routeReq()
    {
        $module = 'default';
        $action = "indexAction";
        try {
            //CHARGEMENT AUTO DES CLASS
            spl_autoload_register(function ($class) {
                require_once('application/modules/default/models/' . $class . '.php');
            });
            require_once('application/plugins/session/MapAcess.php');
            require_once('application/plugins/session/JwtToken.php');

            $url = '';
            if (isset($_GET['url'])) {
                $url = explode('/', filter_var($_GET['url']), FILTER_SANITIZE_URL);
                if ((count($url) == 1 || count($url) == 2) && $url[0] != "ws") {
                    //idkApp/controller/action
                    $controller = ucfirst(strtolower($url[0])) . "Controller";
                    if (count($url) == 2) {
                        $action = strtolower($url[1]) . "Action";
                    }
                } elseif ((count($url) == 2 || count($url) == 3) && $url[0] == "ws") {
                    //idkApp/ws/controller/action
                    $module = strtolower($url[0]);
                    $controller = ucfirst(strtolower($url[1])) . "Controller";
                    $action = "indexAction";
                    if (count($url) == 3) {
                        $action = strtolower($url[2]) . "Action";
                    }
                } else {
                    throw new Exception('display|Url incorrect');
                }
                $controllerFile = 'application/modules/' . $module . '/controllers/' . $controller . '.php';
                if (file_exists($controllerFile)) {
                    require_once($controllerFile);
                    $this->_ctrl = new $controller();
                    if (!method_exists($this->_ctrl, $action)) {
                        throw new Exception('display|Url incorrect');
                    }
                    if (!$this->_checkAcces($module, $controller, $action)) {
                        throw new Exception('display|Accès refusé');
                    }
                    $this->_ctrl->$action();
                } else {
                    throw new Exception('display|Page introuvable');
                }
            } else {
                require_once('application/modules/default/controllers/HomeController.php');
                $this->_ctrl = new HomeController();
                $this->_ctrl->indexAction();
            }
        } catch (Exception $e) {
            if($module != "ws") {
                $msg = explode('|', $e->getMessage());
                if ($msg[0] == "display") {
                    $msg = $msg[1];
                } else {
                    $msg = "";
                }
                require_once('application/modules/default/controllers/ErrorController.php');
                $this->_ctrl = new ErrorController();
                $this->_ctrl->indexAction($msg);
            }
        }
    }

    private function _checkAcces($module, $controller, $action)
    {
        $mapAcess = new MapAcess();
        if ($mapAcess->getAcces($module, $controller, $action) != 0) {
            if ($module == "ws") {
                $headers=apache_request_headers();
                if(isset($headers["Authorization"])) {
                    $authorizationHeader = explode(" ", $headers["Authorization"]);
                    if (isset($authorizationHeader[1])) {
                        $jwtToken = new JwtToken();
                        $payload = $jwtToken->verifyToken($authorizationHeader[1]);
                        if ($payload != null){
                            return true;
                        }
                    }
                }
                http_response_code(403);
            } elseif ($module == "default") {
                if(isset($_SESSION)  &&  isset($_SESSION["id_user"]) && $_SESSION["id_user"] != '' && $_SESSION["id_user"] != NULL) {
                    return true;
                }
            }
            return false;
        } else {
            return true;
        }
    }
}