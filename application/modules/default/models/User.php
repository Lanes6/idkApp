<?php

class User implements \JsonSerializable {
    private $_id_user;
    private $_login;
    private $_password;
    private $_secret;

    //CONSTRUCTEUR
    public function __construct(array $data)
    {
        $this->hydrate($data);
    }

    //HYDRATATION
    public function hydrate(array $data)
    {
        foreach ($data as $key=>$value){
            $method='set'.ucfirst($key);
            if(method_exists($this,$method)){
                $this->$method($value);
            }
        }
    }

    /**
     * @return mixed
     */
    public function getId_User()
    {
        return $this->_id_user;
    }

    /**
     * @param mixed $id_user
     */
    public function setId_User($id_user)
    {
        $id_user=(int)$id_user;
        if($id_user > 0) {
            $this->_id_user = $id_user;
        }
    }

    /**
     * @return mixed
     */
    public function getLogin()
    {
        return $this->_login;
    }

    /**
     * @param mixed $login
     */
    public function setLogin($login)
    {
        if(is_string($login)){
            $this->_login = $login;
        }
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->_password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        if(is_string($password)) {
            $this->_password = $password;
        }
    }

    //PERMET DE FAIRE LE CONVERSION OBJET -> JSON
    public function jsonSerialize()
    {
        $vars = get_object_vars($this);
        return $vars;
    }

    /**
     * @return mixed
     */
    public function getSecret()
    {
        return $this->_secret;
    }

    /**
     * @param mixed $secret
     */
    public function setSecret($secret)
    {
        $this->_secret = $secret;
    }


}