<?php
    include 'variables.php';
    if(isset($_POST['signup'])){
        $error = '';

        $con = mysqli_connect($GLOBALS["servername"],$GLOBALS["username"],$GLOBALS["password"]);
        session_start();

        $signupemail = $_POST["email"];
        $signupusername = $_POST["username"];
        $signuppassword = $_POST["password"];
        $signupemail = stripslashes($signupemail);
        $signupusername = stripslashes($signupusername);
        $signuppassword = stripslashes($signuppassword);
        $signupemail = mysqli_escape_string($con,$signupemail);
        $signupusername = mysqli_escape_string($con,$signupusername);
        $signuppassword = mysqli_escape_string($con,$signuppassword);

        if(!filter_var($signupemail, FILTER_VALIDATE_EMAIL) === true){
            $error = "<h5 class = ''>Email not valid.</h5>";
            die($error);
        }
        if(empty($signupemail) || empty($signupusername) || empty($signuppassword)){
            $error = "<h5 class = ''>Email/Username/Password is empty!</h5>";
            die($error);
        }

        $checkemailquery = "SELECT email FROM prototype2.users WHERE email = '$signupemail'";
        $checkusernamequery = "SELECT username FROM prototype2.users WHERE username = '$signupusername'";

        $checkemailresult = mysqli_query($con,$checkemailquery);
        $checkusernameresult = mysqli_query($con,$checkusernamequery);

        $checkemailrow = mysqli_num_rows($checkemailresult);
        $checkusernamerow = mysqli_num_rows($checkusernameresult);

        if($checkemailrow > 0){
            $error = "<h5 class = ''>Email is already in use!</h5>";
            die($error);
        }
        if($checkusernamerow > 0){
            $error = "<h5 class = ''>Username is already in use!</h5>";
            die($error);
        }
        $signupquery = "INSERT INTO prototype2.users VALUES (?,?,?)";
        $userinfoquery = "INSERT INTO prototype2.userinfo VALUES (?,?,?,?)";
        try{
            $sqli = mysqli_prepare($con,$signupquery);
            mysqli_stmt_bind_param($sqli,'sss',$signupemail,$signupusername,$signuppassword);
            mysqli_stmt_execute($sqli);
            $sqli = mysqli_prepare($con,$userinfoquery);
            $default = 0;
            mysqli_stmt_bind_param($sqli,'siii',$signupusername,$default,$default,$default);
            mysqli_stmt_execute($sqli);
            echo "<h5 class = ''>Account created!</h5>";
            echo "<h5 class = ''>Logging you in...</h5>";
            $_SESSION['login_user'] = $signupusername;
            header("Location:welcome.php");
        }catch(Exception $e){
            $error = "<h5 class = ''>Account creation failed!</h5><hr />";
            die($error.$e);
        }
    }
    mysqli_close($con);
?>