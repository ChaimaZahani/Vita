<?php
class Database { //classe singleton
    private $pdo;
    private static $instance = null;
    private function __construct($host,$dbname,$user,$pass){
    try{
    $dsn = "mysql:host=".$host."; dbname=".$dbname;
    $this->pdo = new PDO($dsn,$user,$pass);
    // set the PDO error mode to exception
    $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $except){
    echo"Echec de la connexion: ". $except->getMessage();
    die();
    }
    }
    public static function getInstance($host,$dbname,$user,$pass){
    if(is_null(self::$instance)){
    self::$instance = new Database($host,$dbname,$user,$pass);
    }
    return self::$instance;
    }
    public function execute_query($sql,$params = null){

        if ($params == null) {
            $results = $this->pdo->query($sql);//execution directe
        }
        else {
            $results = $this->pdo->prepare($sql);// requête préparer
            $results->execute($params);
        }
        if(!$results){
            $erreur=$this->$pdo->errorInfo();
            echo "lecture impossible, code", $this->pdo->errorCode(),$erreur[2];
            die();
        }
        else{
            //return $results->fetchAll(PDO::FETCH_OBG)
            return $results;
        }
        }
    }
?>