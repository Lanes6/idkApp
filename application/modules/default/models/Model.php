<?php

abstract class Model
{
    private static $_bdd;
    private static $_table;

    public function __construct()
    {
        $this->setBdd();
    }

    //INSTANCIE LA CONNEXION A LA BDD
    private static function setBdd()
    {
        self::$_bdd = new PDO('mysql:host=localhost;dbname=idkapp', 'root', '');
        self::$_bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    }

    //RECUPERE LA CONNEXION A LA BDD

    /**
     * @return mixed
     */
    public static function getTable()
    {
        return self::$_table;
    }

    /**
     * @param mixed $table
     */
    public static function setTable($table)
    {
        self::$_table = $table;
    }

    protected function getBdd()
    {
        if(self::$_bdd==null){
            self::setBdd();
        }
        return self::$_bdd;
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
}