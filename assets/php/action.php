<?php
session_start();
require_once 'auth.php';
$user = new Auth();

//handle register Ajax Request
if(isset($_POST['action']) && $_POST['action'] == 'register'){
    $name = $user->test_input($_POST['name']);
    $email = $user->test_input($_POST['email']);
    $pass = $user->test_input($_POST['password']);

    $hpass = password_hash($pass, PASSWORD_DEFAULT);
    if($user->user_exist($email)){ //this method will check whether the email is registered or not
        echo $user->showMessage ('warning', 'This Email is already Registered');
    }
    else{
        if($user->register($name, $email, $hpass)){
            echo'register';
            $_SESSION['user'] = $email;
        }
        else{
            echo $user->showMessage('danger', 'Something went wrong!');
        }
    }
}

//handle login ajax request
if(isset($_POST['action']) && $_POST['action'] == 'login'){
// print_r($_POST); //to print the posted data  
$email = $user->test_input($_POST['email']);
$pass = $user->test_input($_POST['password']);

$loggedInUser = $user->login($email);
if($loggedInUser != null){ // checking whether the email is stored in database or not
    if(password_verify($pass, $loggedInUser['password'])){ //checking the password coming from user input and password stored in database
        if(!empty($_POST['rem'])){ //on clicking remember me this function will be storing cookies of username and password in browser for 30 days
            setcookie("email", $email, time()+(30*24*60*60), '/');
            setcookie("password", $pass, time()+(30*24*60*60), '/');

        }
        else { //keeping cookie empty
            setcookie("email", "",1, '/');
            setcookie("password", "",1, '/');
        }
        echo 'login';
        $_SESSION['user'] = $email;
    }
    else {
        echo $user->showMessage('primary', 'Password is Wrong');
    }
}
else {
    echo $user->showMessage('primary', 'User Not Found');
}

}

// //handle reset pasword ajax request
// if(isset($_POST['action']) && $_POST['action'] == 'forgot'){
//     // print_r($_POST); 
//     $email = $user->test_input($_POST['email']);

// }

//checking user is logged in or not
if(isset($_POST['action']) && $_POST['action'] == 'checkUser'){
    if(!$user->currentUser($_SESSION['user'])){
        echo 'bye';
        unset($_SESSION['user']);
    }
}

 
?>