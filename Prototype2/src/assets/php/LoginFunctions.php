<?php
session_start();

if(isset($_SESSION['login_user'])){
    $sessionusername = $_SESSION['login_user'];
    echo "
        <li class = 'menu-text'>Welcome $sessionusername!</li>
        <li class = 'menu-text'><a href = 'logoutform.php'>Log out</a></li>
    ";
}else{
    echo "
        <li class = 'menu-text'><a href = 'signupform.php'>Sign up</a></li>
        <li class = 'menu-text'><a href = 'loginform.php'>Log in</a></li>
    ";
}

?>