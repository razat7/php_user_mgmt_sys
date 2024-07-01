<?php
session_start();
if(isset($_SESSION['username'])){
    header('location:admin-dashboard.php');
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Panel</title>
    <!-- bootstrap csss -->
    <link rel="stylesheet" href="../assets/bootstrap-4.4.1-dist/css/bootstrap.min.css">
    <!-- Fontawesome CSS CDN -->
    <link rel="stylesheet" href="assets/fontawesome/css/all.min.css">
    <!-- Custom css -->
    <link rel="stylesheet" href="assets/css/style.css" />
    <style>
        html,body {
            height:100%

        }
    </style>
</head>
<body class = "bg-dark">
    <div class="container h-100">
        <div class="row h-100 align-items-center justify-content-center ">
            <div class="col-lg-5">
                <div class="card border-success shadow-lg">
                    <div class="card-header bg-danger">
                        <h3 class="m-0 text-white"><i class="fas fa-user-cog"></i>&nbsp; Admin Panel Login</h3>
                    </div>
                    <div class="card-body">
                        <form action="#" method="post" class="px-3" id="admin-login-form">
                            <div class="form-group">
                                <input type="text" name="username" class="form-control form-control-lg rounded-0" placeholder="Username" required autofocus>
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" class="form-control form-control-lg rounded-0" placeholder="Password" required>
                            </div>
                            <div class="form-group" id="adminLoginAlert">
                                
                            </div>
                            <div class="form-group">
                                <input type="submit" name="admin-login" class="btn btn-danger btn-block rounded-5" value="Login" id="adminLoginBtn">
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- jQuery CDN -->
    <script src="../assets/jquery/jquery-3.5.1.min.js"></script>
    <script src="../assets/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="../assets/font-awesome/js/all.min.js"></script>
    <script src="../assets/jquery/sweetalert2.all.min.js"></script>
    <script type="text/javascript">

        $(document).ready(function(){

            $("#adminLoginBtn").click(function(e){
              if($("#admin-login-form")[0].checkValidity()){
                e.preventDefault(); 

                $(this).val("Please Wait....");
                $.ajax({
                    url: 'assets/php/admin-action.php',
                    method: 'post',
                    data: $("#admin-login-form").serialize()+'&action=adminLogin',
                    success:function(response){
                        if(response === 'admin_login'){
                            window.location = 'admin-dashboard.php';
                        }
                        else{
                            $("#adminLoginAlert").html(response);
                        }
                        $("#adminLoginBtn").val('Login');
                    }
                });
              }
            });
            
        });
    </script>
    
</body>
</html>