<?php
require_once('App.php');
class ModelUser{
private $firstname;
private $lastname;
private $username;
private $email;
private $password;
private $avatar;
private $is_admin;
public function __construct($firstname=null, $lastname=null ,$username=null,$email=null,$password=null,$avatar=null,$is_admin=null){
if (!is_null($firstname) && !is_null($lastname)&& !is_null($username)&& !is_null($email)&& !is_null($password)&& !is_null($avatar)&& !is_null($is_admin)) {
// Si aucun des paramètre n'est nul, c'est forcement qu'on les a fournis
$this->firstname = $firstname;
$this->lastname = $lastname;
$this->username = $username;
$this->email = $email;
$this->password = $password;
$this->avatar = $avatar;
$this->is_admin = $is_admin;
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
    $sql = "SELECT * FROM user where id=?";
    $params = array($id);
    $resultat = $db->execute_query($sql,$params);
    if(!$resultat) {
    echo "Lecture impossible";
    }
    else{
    return $resultat->fetch(PDO::FETCH_ASSOC);
    }
    }
    public static function getusername($username){
        $db = App::getDB();
        $fetch_user_query = "SELECT * FROM user WHERE username='$username' OR email='$username' ";
        $resultat = $db->execute_query($fetch_user_query);
        if(!$resultat) {
        echo "Lecture impossible";
        }
        else{
        return $resultat;
        }
        }
        public static function getbyusername($username){
            $db = App::getDB();
            $fetch_user_query = "SELECT * FROM user WHERE username='$username' OR email='$username' ";
            $resultat = $db->execute_query($fetch_user_query);
            if(!$resultat) {
            echo "Lecture impossible";
            }
            else{
            return $resultat->fetch(PDO::FETCH_ASSOC);
            }
            }
        public static function check_available($username,$email){
                $db = App::getDB();
                $user_check_query ="SELECT * FROM user WHERE username='$username' OR email='$email'";
                $resultat = $pdo->query($user_check_query);
                if(!$resultat) {
                echo "Lecture impossible";
                }
                else{
                return $resultat;
                }
                }
    public static function getAll(){
        $db = App::getDB();
        $sql = "SELECT * FROM user";
        $resultat = $db->execute_query($sql);
        if(!$resultat) {
        $erreur=$conn->errorInfo();
        echo "Lecture impossible, id", $conn->errorCode(),$erreur[2];
        }
        else{
        return $resultat->fetchAll(PDO::FETCH_ASSOC);
        }
        }
        public static function getAvatar($user_id){
            $db = App::getDB();
            $query ="SELECT avatar From user WHERE id=$user_id ";
            $resultat = $db->execute_query($query);
            if(!$resultat) {
            $erreur=$conn->errorInfo();
            echo "Lecture impossible, id", $conn->errorCode(),$erreur[2];
            }
            else{
            return $resultat->fetch(PDO::FETCH_ASSOC);
            }
            }
            public static function getname($user_id){
                $db = App::getDB();
                $query ="SELECT username From user WHERE id=$user_id ";
                $resultat = $db->execute_query($query);
                if(!$resultat) {
                $erreur=$conn->errorInfo();
                echo "Lecture impossible, id", $conn->errorCode(),$erreur[2];
                }
                else{
                return $resultat->fetch(PDO::FETCH_ASSOC);
                }
                }
        public function save($id=null){
            $db = App::getDB();
            try{
                if($id==null){ //insertion d’un nouveau produit
                    $sql = "INSERT INTO user(firstname,lastname,username,email,password,avatar,is_admin) VALUES (?,?,?,?,?,?,?)";
                    $params = array($this->firstname,
                    $this->lastname ,
                    $this->username,
                    $this->email,
                    $this->password,
                    $this->avatar,
                    $this->is_admin);
                    $resultat = $db->execute_query($sql, $params);
                }
                else{//update d’un produit existant
                    $sql = "UPDATE user SET firstname=:firstname,
                    lastname=:lastname,
                    username=:username,
                    email=:email,
                    password=:password,
                    avatar=:avatar,
                    is_admin=:is_admin,
                    WHERE id=:id";
                    $params = array('firstname'=>$this->firstname,
                    'lastname'=>$this->lastname,
                    'username'=>$this->username,
                    'email'=>$this->email,
                    'password'=>$this->password,
                    'avatar'=>$this->avatar,
                    'is_admin'=>$this->is_admin,
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
        $sql = "DELETE FROM user where id=?";
        $params = array($id);
        $resultat = $db->execute_query($sql,$params);
        }
        catch(PDOException $e ){
        return false;
        }
        return true;
        }
    }
