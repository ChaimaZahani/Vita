<?php
session_start();
   require("config/database.php");
   if (isset($_SESSION['user-id'])){
    $id= filter_var($_SESSION['user-id'],FILTER_SANITIZE_NUMBER_INT);
    $query ="SELECT avatar From user WHERE id=$id ";
    $result = $pdo->query($query);
    $avatar=$result->fetch(PDO::FETCH_ASSOC);

  }
  /*if (!isset($_SESSION['user-id'])){
    header('location:'.ROOT_URL.'signin.php');
    die();
  }*/
   ?>
   <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Blog  Application</title>
    <!--custom stylesheet-->
    <link rel="stylesheet" href="../css/style.css">
    <!-- Iconscout Cdn-->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <!--Gogle Font(MONTSERRAT) -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">
</head>
<body>
    <nav>
        <div class="container nav_container">
            <a href="../index.php" class="nav__logo">Vita</a>
            <ul class="nav__items">
            <li><a href="../index.php?controller=homepage&action=blog">Blog</a></li>
                <li><a href="../index.php?controller=homepage&action=about">About</a></li>
                <li><a href="../index.php?controller=homepage&action=services">Services</a></li>
                <li><a href="../index.php?controller=homepage&action=contact">Contact</a></li>
                <?php if(isset($_SESSION['user-id'])): ?>
                    <li><a href="../real_chat/index.php">Chat</a></li>
                <?php endif ?>
                <?php if(isset($_SESSION['user-id'])): ?>
                    <li class="nav__profile">
                    <div class="avatar"> 
                    <img src="<?='../images/'.$avatar['avatar'] ?>">
                    </div>
                    <ul>
                        <li><a href="index.php?controller=admin&action=dashboard">Dashboard</a></li>
                        <li><a href="../index.php?controller=welcome&action=logout">Logout</a></li>
                    </ul>
                   </li>
                 <?php else : ?>
                <li><a href="../index.php?controller=welcome&action=log_in">Sign in</a></li>
                <?php endif ?>
            </ul>
            <button id="open_nav-btn"><i class="uil uil-bars"></i></button>
            <button id="close_nav-btn"><i class="uil uil-multiply"></i></button>
        </div>
    </nav>
    <!--=======End of Nav=========-->