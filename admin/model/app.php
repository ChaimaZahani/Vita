<?php
require_once('database.php');
class App{
const DB_NAME = 'blog';
const DB_USER = 'root';
const DB_PASS = '';
const DB_HOST = 'localhost';
public static function getDB(){
return Database::getInstance(self::DB_HOST, self::DB_NAME, self::DB_USER,self::DB_PASS);
}}
?>