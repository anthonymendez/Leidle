<?php
    include 'variables.php';
    //Functions to sign in, sign up, log out, edit account preferences, etc.

    //Log In Function
    function login(){
        $error = "";

        $login_username = $_POST[$GLOBALS["form_login_username"]];
        $login_password = $_POST[$GLOBALS["form_login_password"]];

        if(isset($_POST[$GLOBALS["form_login_submit"]])){
            //Check if the username or password entry is empty.
            if( empty($login_username) || empty($login_password)){
                $error = "Username or Password is empty!";
                die($error);
            }else{
                $connection = mysqli_connect($GLOBALS["servername"],$GLOBALS["db_signup_username"],$GLOBALS["db_signup_username"]);
                // Protect against SQL Injections
                $login_username = stripslashes($loginusername);
                $login_password = stripslashes($loginpassword);
                $login_username = mysqli_escape_string($connection,$loginusername);
                $login_password = mysqli_escape_string($connection,$loginpassword);
                $one = 1;
                $login_query = "SELECT * FROM p3_registration.users WHERE username = '$login_username' OR email = '$login_username' AND password = '$login_password';";

                $login_result = mysqli_query($connection,$login_query);
                $login_rows = mysqli_num_rows($login_result);
                if($login_rows >= 1){
                    $login_fetch = mysqli_fetch_assoc($login_result);
                    if($login_fetch["verified"] === 0){
                        $error = "Account not verified, please check your email and verify first!";
                        mysqli_close($connection);
                        die($error);
                    }else{
                        $_SESSION['login_user'] = $login_username;
                        mysqli_close($connection);
                        header("Refresh:0");
                    }
                }else{
                    $error = "Username/Email or Password is invalid.";
                    mysqli_close($connection);
                    die($error);
                }
            }
            mysqli_close($connection);
        }
    }
    //Log out Function
    function logout(){
        $error = "";
        
        if(session_destroy()){
            header("Refresh:0");
        }
    }
    //Sign Up Function
    function signup(){
        if(isset($_POST[$GLOBALS['form_signup_submit']])){
            $error = "";

            $connection = mysqli_connect($GLOBALS["servername"],$GLOBALS["db_signup_username"],$GLOBALS["db_signup_password"]);

            $signup_email = $POST[$GLOBALS['form_signup_email']];
            $signup_username = $POST[$GLOBALS['form_signup_username']];
            $signup_password = $POST[$GLOBALS['form_signup_password']];

            $signup_email = stripslashes($signup_email);
            $signup_username = stripslashes($signup_username);
            $signup_password = stripslashes($signup_password);
            $signup_email = mysqli_escape_string($connection,$signup_email);
            $signup_username = mysqli_escape_string($connection,$signup_username);
            $signup_password = mysqli_escape_string($connection,$signup_password);

           if(!filter_var($signup_email, FILTER_VALIDATE_EMAIL) === true){
                $error = "<h5 class = ''>Email not valid.</h5>";
                die($error);
            }
            if(empty($signup_email) || empty($signup_username) || empty($signup_password)){
                $error = "<h5 class = ''>Email/Username/Password is empty!</h5>";
                die($error);
            }

            $check_email_query = "SELECT email FROM p3_registration.users WHERE email = '$signup_email'";

            $check_username_query = "SELECT username FROM p3_registration.users WHERE username = '$signup_username'";

            $check_email_result = mysqli_query($connection,$check_email_query);
            $check_username_result = mysqli_query($connection,$check_username_query);

            $check_email_row = mysqli_num_rows($check_email_result);
            $check_username_row = mysqli_num_rows($check_username_result);

            if($check_email_row > 0){
                $error = "<h5 class = ''>Email is already in use!</h5>";
                die($error);
            }
            if($check_username_row > 0){
                $error = "<h5 class = ''>Username is already in use!</h5>";
                die($error);
            }
            // ID, Email, username, password, hash, verified, edu
            $signup_query = "INSERT INTO p3_registration.users VALUES (?,?,?,?,?,?,?)";
            //username, experience (points), level, usertype 
            $userinfo_query = "INSERT INTO p3_data.userinfo VALUES (?,?,?,?)";

            try{
                $zero = 0;
                $one = 1;
                $normie = "normie";
                $sqli = mysqli_prepare($connection, $signup_query);
                $id = getAmountOfUsers()+1;
                mysqli_stmt_bind_param($sqli,'issssii',$id,$signup_email,$signup_username,$signup_password,$signup_email,$zero,$zero);
                mysqli_stmt_execute($sqli);
                $sqli = mysqli_prepare($connection, $userinfo_query);
                mysqli_stmt_bind_param($sqli,'siis',$signup_username,$zero,$one,$normie);
                mysqli_stmt_execute($sqli);
            }catch(Exception $e){
                $error = "<h5 class = ''>Account creation failed!</h5><hr />";
                echo $error;
                die($error.$e);
            }
            mysqli_close($connection);
        }
    }
    //Edit Account Setting

    //Increment the amount of users in the users table.
    function getAmountOfUsers(){
        $connection = mysqli_connect($GLOBALS["servername"],$GLOBALS["db_login_username"],$GLOBALS["db_login_password"]);
        $id_query = "SELECT MAX(id) FROM p3_registration.users";
        $id_result = mysqli_query($connection,$id_query);
        if(mysqli_num_rows($id_result) === 0){
            return 0;
        }else{
            $id_fetch = mysqli_fetch_assoc($id_result);
            return $id_fetch["id"];
        }
    }
    //Get user level
    function getUserLevel($username){
        $connection = mysqli_connect($GLOBALS["servername"],$GLOBALS['db_getdata_username'],$GLOBALS['db_getdata_password']);
    }
    //TODO
    function getUserExperience($username){

    }
    //TODO
    function getAccountType($username){

    }
    //TODO
    function getFavoriteBoard($username){

    }
?>