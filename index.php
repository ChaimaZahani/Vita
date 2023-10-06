<?php

require 'controller/routeur.php';
require "controller/welcomeController.php";
require "controller/homepageController.php";
require "controller/findController.php";
$routeur = new Routeur();
$routeur->routerRequete();
?>