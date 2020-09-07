<?php

abstract class Model{

    private static $_bdd;

    //connexion à la bdd

    private static function setBdd(){

        self::$_bdd = new PDO('mysql:host=localhost;dbname=php_mvc;charset=utf8', 'root', '');

        //on utilise les constantes de PDO pour gérer les erreurs
        self::$_bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERROR_WARNING);
    }

    //fonction de connexion par défaut à la bdd
    protected function getBdd(){

        if(self::$_bdd == null){
            self::setBdd();
            return self::$_bdd;
        }
    }

    //méthode de récupération de liste d'éléments dans la bdd
    protected function getAll($table, $objet){
        $this->getBdd();
        $var = [];
        $req = self::$_bdd->prepare(' SELECT * FROM '.$table.' ORDER BY id desc ');
        $req->execute();

        //on créé la variable qui contiendra les données sous forme d'objets
        while ($data = $req->fetch(PDO::FETCH_ASSOC)){
            $var[] = new $objet($data);
        }
        return $ver;
        $req->closeCursor();
    }
}

?>