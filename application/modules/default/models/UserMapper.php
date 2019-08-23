<?php
class UserMapper extends Model{

    public function __construct()
    {
        $this->setTable('users');
    }

    public function findByIdUser($id_user){
        $req=$this->getBdd()->prepare('SELECT * FROM '.$this->getTable().' WHERE id_user='.$id_user);
        $req->execute();
        while ($row = $req->fetch(PDO::FETCH_ASSOC)) {
            return new User($row);
        }
        return null;
    }

    public function findByLogin($login){
        $req=$this->getBdd()->prepare('SELECT * FROM '.$this->getTable().' WHERE login=\''.$login.'\'');
        $req->execute();
        while ($row = $req->fetch(PDO::FETCH_ASSOC)) {
            return new User($row);
        }
        return null;
    }


}



/*protected function getAll($table, $obj){
    $var = [];
    $req=self::$_bdd->prepare('SELECT * FROM '.$table);
    $req->execute();
    while($data=$req->fetch(PDO::FETCH_ASSOC)){
        $var[]=new $obj($data);
    }
    return $var;
    $req->closeCursor;
}*/
/*public function getUsers(){
        return $this->getAll('users','User');
    }*/