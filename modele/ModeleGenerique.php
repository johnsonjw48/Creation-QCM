<?php


abstract class ModeleGenerique{

    protected $pdo;

    public function __construct(){
        $this->pdo = $this->connect();
    }

    public function connect(){
        return new PDO('mysql:host=127.0.0.1;dbname=ilci_qcm', "root", "", [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
        ]);
    }

    public function getAll($table){
        $stmt = $this->connect()->prepare("SELECT * FROM " . $table);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getOne($table, $id){
        $stmt = $this->connect()->prepare("SELECT * FROM " . $table . " WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function delete($table, $column, $id){
        $stmt = $this->connect()->prepare("DELETE FROM " . $table . " WHERE ".$column." = ?");
        $stmt->execute([$id]);
        return $stmt;
    }

    public function validate($champs, $minLenght, $maxLength){
        $champs = trim($champs);
        $champs = stripcslashes($champs);
        $champs = htmlentities($champs);

        if( strlen($champs) >= $minLenght && strlen($champs) <= $maxLength )
            return $champs;
        else{
            $_SESSION['message'] = "Nombre de caractères incorrect !!";
            throw new Exception("Nombre de caractères incorrect !!");
        }
    }

    abstract function update($arg);
}