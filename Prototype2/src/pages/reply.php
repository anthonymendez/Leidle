<title>
    Reply
</title>
</head>
<body>
<div class = "pageform">
    <div class = "textcenter">
            <h1 class ="hoverable">
                <a href = "homepage.php">
                    Leidle
                </a>
            </h1>
            <h2>
                Reply
            </h2>
            <h4>
                <a href = "rules.php" class = "margin-sides-5 hoverable">RULES</a>
            <a href = "faq.php" class = "margin-sides-5 hoverable">FAQ</a>
            </h4>
    </div>
    <div>
        <?php
            include "assets/php/DatabaseFunctions.php";
            if(isset($_SESSION['login_user'])){
                echo '
                    <form method = "post">
                        <textarea placeholder = "(5000 Character Limit)" name = "content" required></textarea>
                        <div>
                            <input type = "checkbox" name = "showuser" value = "Show Username" /> Show Username
                            <input type = "checkbox" name = "showflair" value = "Show Flair" /> Show Flair
                        </div>
                        <input type = "submit" name = "submitPost" value = "Submit Post" class = "blockcenter button"/>
                    </form>
                ';
                SubmitPost($_GET["boardid"],$_GET["threadid"]);
            }else{
                echo '
                    <h4 class = "textcenter">
                        You must login or create an account with a .edu email to create new posts!
                    </h4>
                ';
            }
        ?>
    </div>
</div>