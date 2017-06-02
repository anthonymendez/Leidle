<title>
    New Thread
</title>
</head>
<body>
<div class = "pageform">
    <div class = "textcenter">
            <h1 class = "hoverable">
                <a href = "homepage.php">
                    Leidle
                </a>
            </h1>
            <h2>
                New Thread
            </h2>
            <h4>
                <a href = "rules.php" class = "margin-sides-5 hoverable">RULES</a>
            <a href = "faq.php" class = "margin-sides-5 hoverable">FAQ</a>
            </h4>
    </div>
    <div class = "textcenter">
        <?php
            include "assets/php/DatabaseFunctions.php";

            if(isset($_SESSION['login_user'])){
                echo '
                    <form method = "post">
                        <input type = "text" placeholder = "(128 Character Limit)" name = "subject" required />
                        <textarea placeholder = "(5000 Character Limit)" name = "content" required></textarea>
                        <div>
                            <fieldset class = "fieldset">
                                <legend> Customize your Anonymity! </legend>
                                <input type = "checkbox" name = "showuser" id = "showuser" value = "Show Username" /><label for = "showuser"> Show Username </label>
                                <input type = "checkbox" name = "showflair" id = "showflair" value = "Show Flair" /><label for = "showflair"> Show Flair </label>
                            <label>
                                <select>
                                    <option value = "normie">Normie</option>
                                    <option value = "student">Student</option>
                                    <option value = "faculty">Faculty</option>
                                    <option value = "mod">Mod</option>
                                    <option value = "supermod">Super Mod</option>
                                    <option value = "admin">Admin</option>
                                </select>
                            </label>
                            </fieldset>
                        </div>
                        <input type = "submit" name = "submitThread" value = "Submit Thread" class = "blockcenter button"/>
                    </form>
                ';
                SubmitThread($_GET["boardid"]);
            }else{
                echo '
                    <h4>
                        You must login or create an account with a .edu email to create new pickets!
                    </h4>
                ';
            }
            
        ?>
    </div>
</div>