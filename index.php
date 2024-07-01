<?php 
session_start();
if(isset($_SESSION['user'])){
    header('location:home.php');
}

include_once 'assets/php/config.php';
$db = new Database();

$sql = "UPDATE visitors SET hits = hits+1 WHERE id = 0";
$stmt = $db->conn->prepare($sql);
$stmt->execute();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>razat7</title>
    <!-- bootstrap csss -->
    <link rel="stylesheet" href="assets/bootstrap-4.4.1-dist/css/bootstrap.min.css">
    <!-- Fontawesome CSS CDN -->
    <link rel="stylesheet" href="assets/fontawesome/css/all.min.css">
    <!-- Custom css -->
    <link rel="stylesheet" href="assets/css/style.css" />
</head>
<body>
    <div class="container">
         <!-- Login form Start -->
        <div class="row justify-content-center wrapper" id="login-box">
            <div class="col-lg-10 my-auto">
                <div class="card-group myShadow">
                    <div class="card round-left p-4" style="flex-grow:1.4;">
                    <h2 class="text-center font-weight-bold text-primary" style = "font-family: Kalimati;"> Login Details </h2> 
                    <hr class="my-3">
                    <form action="#" method="post" class="px-3" id="login-form">
                        <div id="loginAlert"></div>
                        <div class="input-group input-group-lg form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text rounded-0">
                                    <i class="fas fa-envelope"> </i>
                                </span>
                            </div>
                            <input type="email" name="email" id="email" class="form-control rounded-0" placeholder="E-Mail" required value ="<?php if(isset($_COOKIE['email'])){echo $_COOKIE['email'];} ?>">
                        </div>
                        <div class="input-group input-group-lg form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text rounded-0">
                                    <i class="fas fa-key fa-lg"> </i>
                                </span>
                            </div>
                            <input type="password" name="password" id="password" class="form-control rounded-0" placeholder="Passwod" autocomplete="on" required value ="<?php if(isset($_COOKIE['password'])){echo $_COOKIE['password'];} ?>">
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-checkbox float-left">
                                <input type="checkbox" name="rem" class="custom-control-input" id="customCheck" <?php if(isset($_COOKIE['email'])){?> checked <?php } ?>>
                                <label for="customCheck" class="custom-control-label" style = "font-family: Kalimati;">Remember me</label>
                            </div>
                            <div class="forgot float-right">
                                <a href="#" id="forgot-link" style = "font-family: Kalimati;">Forgot Password ?</a>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="" value=" Log In" id="login-btn" class="btn btn-primary btn-lg btn-block myBtn">
                        </div>
                    </form>
                    </div>
                    <div class="card justify-content-center rounded-right myColor p-4">
                        <h1 class="text-center font-weight-bold text-white">UNMISS,JUBA</h1>
                        <hr class="my-3 bg-light myHr">
                        <p class="text-center font-weight-bolder text-light lead">NEPFRB-1</p>
                        <button class="btn btn-outline-light btn-lg align-self-center font-weight-bolder mt-4 myLinkBtn" id="register-link"> Sign Up</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- login form ends here -->

        <!-- register form Start -->
        <div class="row justify-content-center wrapper" id="register-box" style="display:none;">
            <div class="col-lg-10 my-auto">
                <div class="card-group myShadow">
                        <div class="card justify-content-center rounded-right myColor p-4">
                            <h1 class="text-center font-weight-bold text-white">Welcome Back!</h1>
                            <hr class="my-3 bg-light myHr">
                            <p class="text-center font-weight-bolder text-light lead"> Signup and Start your Journey with us.</p>
                            <button class="btn btn-outline-light btn-lg align-self-center font-weight-bolder mt-4 myLinkBtn" id="login-link"> Sign In</button>
                        </div>
                    <div class="card round-left p-4" style="flex-grow:1.4;">
                    <h1 class="text-center font-weight-bold text-primary"> Create Account</h1> 
                    <hr class="my-3">
                    <form action="#" method="post" class="px-3" id="register-form">
                        <div id="regAlert"></div>
                    <div class="input-group input-group-lg form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text rounded-0">
                                    <i class="fas fa-user"> </i>
                                </span>
                            </div>
                            <input type="text" name="name" id="name" class="form-control rounded-0" placeholder="Full Name" required>
                        </div>
                        <div class="input-group input-group-lg form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text rounded-0">
                                    <i class="fas fa-envelope"> </i>
                                </span>
                            </div>
                            <input type="email" name="email" id="remail" class="form-control rounded-0" placeholder="E-Mail" required>
                        </div>
                        <div class="input-group input-group-lg form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text rounded-0">
                                    <i class="fas fa-key fa-lg"> </i>
                                </span>
                            </div>
                            <input type="password" name="password" id="rpassword" class="form-control rounded-0" placeholder="Passwod" autocomplete="on" required minlength="5">
                        </div>
                        <div class="input-group input-group-lg form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text rounded-0">
                                    <i class="fas fa-key fa-lg"> </i>
                                </span>
                            </div>
                            <input type="password" name="cpassword" id="cpassword" class="form-control rounded-0" placeholder="Confirm Passwod" autocomplete="on" required minlength="5">
                        </div>   
                        <div class="form-group">
                            <div id="passError" class="text-danger font-weight-bold"></div>
                        </div>                     
                        <div class="form-group">
                            <input type="submit" name="" value="Sign Up" id="register-btn" class="btn btn-primary btn-lg btn-block myBtn">
                        </div>
                    </form>
                    </div>
                   
                </div>
            </div>
        </div>
        <!-- register form ends here -->
        <!-- Forgot Password From Start -->
        <div class="row justify-content-center wrapper" id="forget-box" style="display:none;">
            <div class="col-lg-10 my-auto">
                <div class="card-group myShadow">
                <div class="card justify-content-center rounded-right myColor p-4">
                        <h1 class="text-center font-weight-bold text-white">Reset Password</h1>
                       
                        <hr class="my-3 bg-light myHr">
                        <button class="btn btn-outline-light btn-lg align-self-center font-weight-bolder mt-4 myLinkBtn" id="back-link">Back</button>
                    </div>
                    <div class="card round-left p-4" style="flex-grow:1.4;">
                    <h1 class="text-center font-weight-bold text-primary"> Forgot Your Password ?</h1> 
                    <hr class="my-3">
                    <p class="lead text-center text-secondary"> To reset your password, Please Verify the E-mail address and You will receive OTP.</p>
                    <form action="#" method="post" class="px-3" id="forgot-form">
                         <div id="forgot-Alert"></div>
                        <div class="input-group input-group-lg form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text rounded-0">
                                    <i class="fas fa-envelope"> </i>
                                </span>
                            </div>
                            <input type="email" name="email" id="femail" class="form-control rounded-0" placeholder="E-Mail" required>
                        </div>
                        <div class="form-group">
                        <input type="submit" name="" value="Reset Password" id="forgot-btn" class="btn btn-primary btn-lg btn-block myBtn">
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Forgot Password form ends here -->
    </div>
  <!-- jQuery CDN -->
    <script src="assets/jquery/jquery-3.5.1.min.js"></script>
    <script src="assets/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="assets/font-awesome/js/all.min.js"></script>
    <script src="assets/jquery/sweetalert2.all.min.js"></script>
    <script type="text/javascript">
        
   $(document).ready(function(){
    $("#register-link").click(function(){  //Signup button click function (hide signin box and diplays signup form)
        $("#login-box").hide();
        $("#register-box").show();
    });
    $("#login-link").click(function(){ //sign in button click function (hide signup form and displays signin form)
        $("#login-box").show();
        $("#register-box").hide();
    });
    $("#forgot-link").click(function(){ //forgot password link click (hide signin form and displays forgot password form)
        $("#login-box").hide();
        $("#forget-box").show();
    });
    $("#back-link").click(function(){ //backlink click (hide reset password form and displays signin form)
        $("#login-box").show();
        $("#forget-box").hide();
    });

    //Register Ajax Request
    $("#register-btn").click(function(e){
        if($("#register-form")[0].checkValidity()){
            e.preventDefault();
            $("#register-btn").val('Please Wait...');
            if($("#rpassword").val()!= $("#cpassword").val()){
                $("#passError").text('*Password Mismatched!');
                $("#register-btn").value('Sign Up');
            }
            else{
                $("#passError").text('');
                $.ajax({
                    url: 'assets/php/action.php',
                    method: 'post',
                    data: $("#register-form").serialize()+'&action=register',
                    success:function(response){
                        $("#register-btn").val('Sign Up'); //val means the displaying value in button
                        // console.log(response);
                        if(response === 'register'){
                            window.location = 'index.php';                        
                        }
                        else{
                            $("#regAlert").html(response);
                        }
                    }
                });
            }

        }
    });
    
    //Login Ajax Request
    $("#login-btn").click(function(e){
        if($("#login-form")[0].checkValidity()){
            e.preventDefault();

            $("#login-btn").val('Please Wait...');
                $.ajax({
                url: 'assets/php/action.php',
                method: 'post',
                data: $("#login-form").serialize()+'&action=login',
                success:function(response){
                // console.log(response);
                if(response ==='login'){
                    $("#login-btn").val('Sign In');
                    window.location = "home.php";
                
                }
                    else{
                        $("#loginAlert").html(response);
                        $("#login-btn").val('Sign In');
                    }
                }
            });
                        
            
        }
    });
    
    //password reset button request
    $("#forgot-btn").click(function(e){
        if($("#forgot-form")[0].checkValidity()){
            e.preventDefault();
            
            $("#forgot-btn").val("Please wait...");
            $.ajax({
                url: 'assets/php/action.php',
                method: 'post',
                data: $("#forgot-form").serialize()+'&action=forgot', //creating an action
                success:function(response){
                    $("#forgot-btn").val("Reset Password"); //changing the value of button
                    $("#forgot-form")[0].reset(); //to reset the form data
                    // console.log(response);
                    $("#forgot-alert").html("response");
                }

            });
        }

    });

  

   });
    </script>   
</body>
</html>