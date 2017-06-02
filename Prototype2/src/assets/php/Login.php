<?php
    include 'variables.php';

    session_start();
    $error = '';

    if(isset($login_session)){
        header("Location:homepage.php");
    }

    if(isset($_POST["submitlogin"])){
        if(empty($_POST["username"]) || empty($_POST["password"])){
            $error = 'Username or Password is empty!';
        }else{
            $loginusername = $_POST["username"];
            $loginpassword = $_POST["password"];

            $con = mysqli_connect($GLOBALS["servername"],$GLOBALS["username"],$GLOBALS["password"]);

            $loginusername = stripslashes($loginusername);
            $loginpassword = stripslashes($loginpassword);
            $loginusername = mysqli_escape_string($con,$loginusername);
            $loginpassword = mysqli_escape_string($con,$loginpassword);

            $loginquery = 
                "SELECT * FROM prototype2.users WHERE username = '$loginusername' OR email = '$loginusername' AND password = '$loginpassword';";
            $loginresult = mysqli_query($con,$loginquery);
            $rows = mysqli_num_rows($loginresult);
            if($rows >= 1){
                $_SESSION['login_user'] = $loginusername;
                header("Location:homepage.php");
            }else{
                $error = "Username/Email or Password is invalid.";
                die($error);
            }

            mysqli_close($con);
        }
    }
?>