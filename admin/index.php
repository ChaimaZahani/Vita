<?php

require 'controller/routeur.php';
require "controller/adminController.php";

$routeur = new Routeur();
$routeur->routerRequete();
?>