<title>
    Login
</title>
</head>
<body>
<div class = "pageform">
    <div class = "login-block" style = "margin-top:20%;">
        <h1>
                Leidle
        </h1>
        <form method = "post">
        <input type = "text" name = "username" placeholder = "Username/Email" required />
        <input type = "password" name = "password" placeholder = "Password" required />
        <input type = "submit" name = "submitlogin" value = " Login " class = "button large" />
        </form>
        <a href = "signupform.php"><button class = "button large">Don't have an account? Sign-up now!</button></a>
        <?php include "assets/php/Login.php";
        
        ?>
    </div>
</div>