<?php
require_once('App.php');
class ModelCategorie{
private $title;
private $description;
public function __construct($title=null, $description=null){
if (!is_null($title) && !is_null($description)) {

// Si aucun des paramètre n'est nul, c'est forcement qu'on les a fournis
$this->title = $title;
$this->description = $description;
}
}
public function __get($attr){
if (!isset($this->attr))
return "erreur";
else return ($this->attr);
}
public function __set($attr,$value) {
$this->attr = $value;
}

public static function getbyid($id){
    $db = App::getDB();
    $sql = "SELECT * FROM categories where id=?";
    $params = array($id);
    $resultat = $db->execute_query($sql,$params);
    if(!$resultat) {
    echo "Lecture impossible";
    }
    else{
    return $resultat->fetch(PDO::FETCH_ASSOC);
    }
    }

    public static function getAll(){
        $db = App::getDB();
        $sql = "SELECT * FROM categories";
        $resultat = $db->execute_query($sql);
        if(!$resultat) {
        $erreur=$conn->errorInfo();
        echo "Lecture impossible, id", $conn->errorCode(),$erreur[2];
        }
        else{
        return $resultat->fetchAll(PDO::FETCH_ASSOC);
        }
        }
        public static function getCategorie(){
            $db = App::getDB();
            $sql = "SELECT * FROM categories";
            $resultat = $db->execute_query($sql);
            if(!$resultat) {
            $erreur=$conn->errorInfo();
            echo "Lecture impossible, id", $conn->errorCode(),$erreur[2];
            }
            else{
            return $resultat;
            }
            }
        public function save($id=null){
            $db = App::getDB();
            try{
                if($id==null){ //insertion d’un nouveau produit
                    $sql = "INSERT INTO categories(title,description) VALUES (?,?)";
                    $params = array($this->title,$this->description);
                    $resultat = $db->execute_query($sql, $params);
                }
                else{//update d’un produit existant
                    $sql = "UPDATE categories SET title=:title,
                    description=:description,
                    WHERE id=:id";
                    $params = array('title'=>$this->title,
                    'description'=>$this->description,
                    'id'=>$id);
                    $resultat = $db->execute_query($sql,$params);
                }
            }catch(PDOException $e ){
                if ($e->getCode() == 2300){
                    $message=$e->getMessage();
                }
            return false;
            }
            return true;
        
        }
    public static function delete($id){
        $db = App::getDB();
        try{
        $sql = "DELETE FROM categories where id=?";
        $params = array($id);
        $resultat = $db->execute_query($sql,$params);
        }
        catch(PDOException $e ){
        return false;
        }
        return true;
        }
    }
