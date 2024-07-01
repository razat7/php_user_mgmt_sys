<?php 

// session_start();
// echo $_SESSION['user'];
require_once 'assets/php/session.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= ucfirst(basename($_SERVER['PHP_SELF'], '.php') )?> |Library</title>
    <!-- bootstrap csss -->
    <link rel="stylesheet" href="assets/bootstrap-4.4.1-dist/css/bootstrap.min.css">
    <!-- Fontawesome CSS CDN -->
    <link rel="stylesheet" href="assets/fontawesome/css/all.min.css">
    <!-- Custom css -->
    <link rel="stylesheet" href="assets/css/style.css" />
    <!-- Data Tables -->
    <link href="assets/DataTables/datatables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0">
    <style type ="text/css">
        @import url('https://fonts.googleapis.com/css2?family=Maven+Pro:wght@400..900&display=swap');
        *{
            font-family: 'Maven Pro', 'san-serif', 'Kalimati';
        }
    </style>
</head>
    <body>
        <nav class="navbar navbar-expand-md bg-dark navbar-dark">
            <!-- Brand -->
            <a class="navbar-brand" href="assets/php/logout.php" style ="font-family: kalimati;"> <i class="fas fa-user"> </i> IT DESK </a>

            <!-- Toggler/collapsibe Button -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Navbar links -->
            <div class="collapse navbar-collapse m-2" id="collapsibleNavbar">
                <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link nav-link <?= (basename($_SERVER['PHP_SELF']) == "home.php")? "active":""; ?>" href="home.php"><i class="fas fa-home"> </i> &nbsp; Home </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link <?= (basename($_SERVER['PHP_SELF']) == "profile.php")? "active":""; ?>" href="profile.php"><i class="fas fa-user-circle"> </i> &nbsp; Profile </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link <?= (basename($_SERVER['PHP_SELF']) == "feedback.php")? "active":""; ?>" href="feedback.php"> <i class="fas fa-book"> </i> &nbsp; Feedback </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link <?= (basename($_SERVER['PHP_SELF']) == "notification.php")? "active":""; ?>" href="notification.php"> <i class="fas fa-bell"> </i> &nbsp; Notification &nbsp; <span id="checkNotification"></span></a>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle " id ="navbardrop" data-toggle="dropdown"> 
                        <i class="fas fa-user-cog"> &nbsp; </i> Hi! &nbsp; <?= $fname; ?> 
                    </a>
                    <div class="dropdown-menu">
                        <a href="" class="dropdown-item "><i class ="fas fa-cog"> &nbsp; Settings</i></a>
                        <a href="assets/php/logout.php" class="dropdown-item"><i class ="fas fa-sign-out-alt"> &nbsp; Logout </i></a>
                    </div>
                </li>
                </ul>
            </div>
        </nav> 
       