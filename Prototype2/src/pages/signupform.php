<title>
    Sign Up
</title>
</head>
<body>
<div class = "pageform">
    <div class = "login-block" style = "margin-top:20%;">
        <h1>
                Leidle
        </h1>
        <form method = "post">
        <input type = "text" name = "email" placeholder = "Email" required />
        <input type = "text" name = "username" placeholder = "Username" required />
        <input type = "password" name = "password" placeholder = "Password" required />
        <input type = "submit" name = "signup" value = " Signup " class = "button large" />
        </form><a href = "loginform.php"><button class = "button large">Back to Login</button></a>
        <?php include "assets/php/Signup.php";
        
        ?>
    </div>
</div>