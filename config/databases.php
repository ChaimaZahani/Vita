<?php
require('config/constants.php');
try{
    $pdo= new PDO("mysql:host=$host;dbname=$base" ,$user,$pass);
    // set the PDO error mode to exception
    $pdo ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $except){
    echo"Echec de la connexion: ". $except->getMessage();
    die();
    }
?>