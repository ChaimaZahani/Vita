<?php
require_once('App.php');
class ModelLikes{
private $id_article;
private $id_membre;

public function __construct($id_article=null, $id_membre=null){
if (!is_null($id_article) && !is_null($id_membre)) {

// Si aucun des paramètre n'est nul, c'est forcement qu'on les a fournis
$this->id_article = $id_article;
$this->id_membre = $id_membre;

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
    $sql = "SELECT * FROM likes where id=?";
    $params = array($id);
    $resultat = $db->execute_query($sql,$params);
    if(!$resultat) {
    echo "Lecture impossible";
    }
    else{
    return $resultat->fetch(PDO::FETCH_OBJ);
    }
    }
public static function getbymembre($id,$menbre){
        $db = App::getDB();
        $sql="SELECT * FROM likes WHERE id_article=? AND id_membre=?";
        $params = array($id,$menbre);
        $resultat = $db->execute_query($sql,$params);
        if(!$resultat) {
        echo "Lecture impossible";
        }
        else{
        return $resultat->fetch(PDO::FETCH_ASSOC);
    }
    }
    public static function getlikes($id){
        $db = App::getDB();
        $sql="SELECT count(*) FROM likes WHERE id_article=".$id;
        $like = $db->execute_query($sql);

        if(!$like) {
        echo "Lecture impossible";
        }
        else{
        return  $likes =$like->fetch(PDO::FETCH_ASSOC);

        }
        }
    public static function getAll(){
        $db = App::getDB();
        $sql = "SELECT * FROM likes";
        $resultat = $db->execute_query($sql);
        if(!$resultat) {
        $erreur=$conn->errorInfo();
        echo "Lecture impossible, id", $conn->errorCode(),$erreur[2];
        }
        else{
        return $resultat->fetchAll(PDO::FETCH_OBJ);
        }
        }
        public function save($id=null){
            $db = App::getDB();
            try{
                if($id==null){ //insertion d’un nouveau produit
                    $sql = "INSERT INTO likes(id_article, id_membre) VALUES (?,?)";
                    $params = array($this->id_article = $id_article,
                    $this->id_membre = $id_membre);
                    $resultat = $db->execute_query($sql, $params);
                }
                else{//update d’un produit existant
                    $sql = "UPDATE likes SET id_article=:id_article,
                    id_membre=:id_membre,
                    WHERE id=:id";
                    $params = array('id_article'=>$this->id_article,
                    'id_membre'=>$this->id_membre,
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
        $sql = "DELETE FROM likes where id=?";
        $params = array($id);
        $resultat = $db->execute_query($sql,$params);
        }
        catch(PDOException $e ){
        return false;
        }
        return true;
        }
        public static function deletebymember($id,$membre){
            $db = App::getDB();
            try{
                $sql="DELETE FROM likes WHERE id_article=? AND id_membre=?";
                $params = array($id,$membre);
            $resultat = $db->execute_query($sql,$params);
            }
            catch(PDOException $e ){
            return false;
            }
            return true;
            }
public function insert(){
            $db = App::getDB();
            try{
                 //insertion d’un nouveau produit
                    $sql = "INSERT INTO likes(id_article, id_membre) VALUES (?,?)";
                    $params = array($this->id_article,
                    $this->id_membre);
                    $resultat = $db->execute_query($sql, $params);
                }
                
            catch(PDOException $e ){
                if ($e->getCode() == 2300){
                    $message=$e->getMessage();
                }
            return false;
            }
            return $resultat->fetch(PDO::FETCH_ASSOC);
        
        }
            
    }
