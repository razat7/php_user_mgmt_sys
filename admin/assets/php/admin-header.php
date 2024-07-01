<?php
session_start();
if(!isset($_SESSION['username'])){
    header('location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
        $title = basename($_SERVER['PHP_SELF'], '.php');
        $title = explode('-', $title);
        $title = ucfirst($title[1]);
    ?>
    <title><?= $title; ?> | Admin Panel</title>
    <!-- bootstrap csss -->
    <link rel="stylesheet" href="../assets/bootstrap-4.4.1-dist/css/bootstrap.min.css">
    <!-- Fontawesome CSS CDN -->
    <link rel="stylesheet" href="../assets/fontawesome/css/all.min.css">
    <!-- Custom css -->
    <link rel="stylesheet" href="assets/css/style.css">
     <!-- Data Tables -->
     <link href="../assets/DataTables/datatables.min.css" rel="stylesheet">

    <!-- javscript links -->
    <script src="../assets/jquery/jquery-3.5.1.min.js"></script>
    <script src="../assets/bootstrap-4.4.1-dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/font-awesome/js/all.min.js" defer></script>
    <script src="../assets/jquery/sweetalert2.all.min.js"></script>
    <script src="../assets/DataTables/datatables.min.js"></script>
    <script src="../assets/js/loader.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#open-nav").click(function(){
                $(".admin-nav").toggleClass('animate');
            })
        })
    </script>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="admin-nav p-0">
                <h4 class="text-light text-center p-2">Admin Panel</h4>
                <div class="list-group list-group-flush">

                    <a href="admin-dashboard.php" class="list-group-item text-light admin-link <?= (basename($_SERVER['PHP_SELF']) == 'admin-dashboard.php')?"nav-active":"";?>"><i class="fas fa-chart-pie"></i>&nbsp; Dashboard</a>
                    
                    <a href="admin-users.php" class="list-group-item text-light admin-link <?= (basename($_SERVER['PHP_SELF'])=='admin-users.php')?"nav-active":""; ?>"><i class="fas fa-user-friends"></i>&nbsp; Users</a>
                    
                    <a href="admin-notes.php" class="list-group-item text-light admin-link <?=(basename($_SERVER['PHP_SELF'])=='admin-notes.php')?"nav-active":""; ?>"><i class="fas fa-sticky-note"></i>&nbsp; Notes</a>
                    
                    <a href="admin-feedback.php" class="list-group-item text-light admin-link <?=(basename($_SERVER['PHP_SELF'])=='admin-feedback.php')?"nav-active":""; ?>"><i class="fas fa-comment"></i>&nbsp; Feedback</a>
                    
                    <a href="admin-notification.php" class="list-group-item text-light admin-link <?= (basename($_SERVER['PHP_SELF'])== 'admin-notification.php')?"nav-active":""; ?>"><i class="fas fa-bell"></i>&nbsp; Notification &nbsp; <span id="checkNotification"></span></a>
                    
                    <a href="admin-deleteduser.php" class="list-group-item text-light admin-link <?= (basename($_SERVER['PHP_SELF'])=='admin-deleteduser.php')?"nav-active":""; ?>"><i class="fas fa-user-slash"></i>&nbsp;Deleted Users</a>
                    
                    <a href="assets/php/admin-action.php?export=excel" class="list-group-item text-light admin-link"><i class="fas fa-table"></i>&nbsp; Export Users</a>
                    
                    <a href="#" class="list-group-item text-light admin-link"><i class="fas fa-id-card"></i>&nbsp; Profile</a>
                    
                    <a href="#" class="list-group-item text-light admin-link"><i class="fas fa-cog"></i>&nbsp; Settings</a>
                </div>
            </div>
            <div class="col">
                <div class="row">
                    <div class="col-lg-12 bg-secondary pt-2 justify-content-between d-flex">
                       <a href="#" class="text-white" id="open-nav"><h3><i class="fas fa-bars"></i></h3></a>   <!-- Opennav button -->
                        <h4 class="text-light"><?= $title; ?></h4> 
                        <a href="assets/php/logout-admin.php" class="text-light mt-1"><i class="fas fa-sign-out-alt">&nbsp; Logout</i></a>
                    </div>
                </div>