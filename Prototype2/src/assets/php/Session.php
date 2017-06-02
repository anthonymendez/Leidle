<?php
    include "variables.php";

    $con =  mysqli_connect($GLOBALS["servername"],$GLOBALS["username"],$GLOBALS["password"]);

    session_start();

    $user_check = $_SESSION["login_user"];

    $sessionquery = "SELECT username FROM prototype2.users WHERE username = '$user_check';";

    $result = mysqli_query($con, $sessionquery);

    $row = mysqli_fetch_assoc($result);
    
    $login_session = $row['username'];

    if(isset($login_session)){
        mysqli_close($con);
        header('Location:homepage.php');        
    }else{
        mysqli_close($con);
        header('Location:loginform.php');       
    }
?>