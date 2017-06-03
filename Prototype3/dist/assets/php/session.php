<?php
    //Starts the session at the beginning of each page and some functions related to sessions.
    //Will be run on each page
    include 'variables.php';
    include 'account.php';
    include 'threadhandling.php';

    //Starts the session on every page
    session_start();

    //2 Quick function to return whether or not $_SESSION['login_user'] is set.
    //Basically checks if the user is logged in.
    function issetLoginUser(){
        return isset($_SESSION['login_user']);
    }
    function loggedin(){
        return isset($_SESSION['login_user']);
    }


?>