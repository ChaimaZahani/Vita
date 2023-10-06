<?php
require_once('App.php');
class ModelPosts{
private $title;
private $body;
private $thumbnail;
private $date_time;
private $category_id;
private $author_id;
private $is_featured;
public function __construct($title=null, $body=null ,$thumbnail=null,$date_time=null,$category_id=null,$author_id=null,$is_featured=null){
if (!is_null($title) && !is_null($body)&& !is_null($thumbnail)&& !is_null($date_time)&& !is_null($category_id)&& !is_null($author_id)&& !is_null($is_featured)) {
// Si aucun des paramètre n'est nul, c'est forcement qu'on les a fournis
$this->title = $title;
$this->body = $body;
$this->thumbnail = $thumbnail;
$this->date_time = $date_time;
$this->category_id = $category_id;
$this->author_id = $author_id;
$this->is_featured = $is_featured;
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
    $sql = "SELECT * FROM posts where id=?";
    $params = array($id);
    $resultat = $db->execute_query($sql,$params);
    if(!$resultat) {
    echo "Lecture impossible";
    }
    else{
    return $resultat->fetch(PDO::FETCH_ASSOC);
    }
    }
    public static function getbyfeatured(){
        $db = App::getDB();
        $featured_query ="SELECT * FROM posts WHERE is_featured=1";
        $featured_result = $db->execute_query($featured_query);
   
        if(!$featured_result) {
        $erreur=$conn->errorInfo();
        echo "Lecture impossible, id", $conn->errorCode(),$erreur[2];
        }
        else{
        return $featured =$featured_result->fetch(PDO::FETCH_ASSOC);
        }
        }
        public static function getposts(){
            $db = App::getDB();
            $query ="SELECT * FROM posts ORDER BY date_time DESC LIMIT 9";
            
            $posts = $db->execute_query($query);
       
            if(!$posts) {
            $erreur=$conn->errorInfo();
            echo "Lecture impossible, id", $conn->errorCode(),$erreur[2];
            }
            else{
            return $posts;
            }
            }
            public static function getby_category_id($id){
                $db = App::getDB();
                $query="SELECT * FROM posts WHERE category_id=$id ORDER BY date_time DESC";                
                $posts = $db->execute_query($query);
           
                if(!$posts) {
                $erreur=$conn->errorInfo();
                echo "Lecture impossible, id", $conn->errorCode(),$erreur[2];
                }
                else{
                return $posts;
                }
                }
            public static function getpost(){
                $db = App::getDB();
                $query ="SELECT * FROM posts ORDER BY date_time DESC LIMIT 9";
                $posts = $db->execute_query($query);
           
                if(!$posts) {
                $erreur=$conn->errorInfo();
                echo "Lecture impossible, id", $conn->errorCode(),$erreur[2];
                }
                else{
                return $post=$posts->fetch(PDO::FETCH_ASSOC);;
                }
                } 

    public static function getfeatured(){
            $db = App::getDB();
            $featured_query ="SELECT * FROM posts WHERE is_featured=1";
            $featured_result = $db->execute_query($featured_query);
       
            if(!$featured_result) {
            $erreur=$conn->errorInfo();
            echo "Lecture impossible, id", $conn->errorCode(),$erreur[2];
            }
            else{
            return $featured_result;
            }
            }
            public static function search($search){
                $db = App::getDB();
                $query ="SELECT * FROM posts WHERE title  LIKE '%$search%' ORDER BY date_time DESC";
                $result = $db->execute_query($query);
           
                if(!$result) {
                $erreur=$conn->errorInfo();
                echo "Lecture impossible, id", $conn->errorCode(),$erreur[2];
                }
                else{
                return $result;
                }
                }
    public static function getAll(){
        $db = App::getDB();
        $sql = "SELECT * FROM posts";
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
                    $sql = "INSERT INTO posts(title, body,thumbnail,date_time,category_id,author_id,is_featured) VALUES (?,?,?,?,?,?,?)";
                    $params = array($this->title = $title,
                    $this->body = $body,
                    $this->thumbnail = $thumbnail,
                    $this->date_time = $date_time,
                    $this->category_id = $category_id,
                    $this->author_id = $author_id,
                    $this->is_featured = $is_featured);
                    $resultat = $db->execute_query($sql, $params);
                }
                else{//update d’un produit existant
                    $sql = "UPDATE posts SET title=:title,
                    body=:body,
                    thumbnail=:thumbnail,
                    date_time=:date_time,
                    category_id=:category_id,
                    author_id=:author_id,
                    is_featured=:is_featured,
                    WHERE id=:id";
                    $params = array('title'=>$this->title,
                    'body'=>$this->body,
                    'thumbnail'=>$this->thumbnail,
                    'date_time'=>$this->date_time,
                    'category_id'=>$this->category_id,
                    'author_id'=>$this->author_id,
                    'is_featured'=>$this->is_featured,
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
        $sql = "DELETE FROM posts where id=?";
        $params = array($id);
        $resultat = $db->execute_query($sql,$params);
        }
        catch(PDOException $e ){
        return false;
        }
        return true;
        }
    public static function update_view($view,$id){
            $db = App::getDB();
            
            $sql ="UPDATE posts SET vues='$view' WHERE id=$id";
            $resultat = $db->execute_query($sql);
            if(!$resultat) {
                $erreur=$conn->errorInfo();
                echo "Lecture impossible, id", $conn->errorCode(),$erreur[2];
                }
                else{
                return $resultat;
                }
    }
}
