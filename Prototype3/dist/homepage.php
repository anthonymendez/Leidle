
<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link rel="stylesheet" href="assets/css/app.css">
    <?php include "assets/php/session.php";?>
    <!--<title>Foundation for Sites</title>
    
  </head>
  <body>-->

    <title>Leidle</title>
    </head>
    <div class = "signup-menu">
        <div class = "">
            <div class = "toprow">
                <div class = "button secondary large exit" id = "signup-menu-exit">
                    X
                </div>
            </div>
            <div class = "middle">
                <h3>Sign up!</h3>
                <h5>Enter your information to get started!</h5>
                <form method = "POST">
                    <label for = "Susername">Username</label><input type = "text" name = "Susername" />
                    <label for = "Semail">Email</label><input type = "text" name = "Semail" />
                    <label for = "Spassword">Password</label><input type = "password" name = "Spassword" />
                    <input type = "submit" name = "Ssubmit" value = "Sign up" class = "button large Ssubmit" />
                </form>
            </div>
        </div>
    </div>
    <div class = "login-menu">
        <div class = "">
            <div class = "toprow">
                <div class = "button secondary large exit" id = "login-menu-exit">
                    X
                </div>
            </div>
            <div class = "middle">
                <form method = "POST">
                    
                </form>
            </div>
        </div>
    </div>
    <body class = "homepage">
    
        <div class = "sideCol">
    
        </div>
        <div class = "mainCol">
            <div class = "menubar">
                <div class = "left">
                    <button class = "button secondary large " id = "">FAQ</button>
                    <br />
                    <button class = "button secondary large " id = "">Rules</button>
                </div>
                <div class = "center">
                    <h2> Leidle </h2>
                    <h3> The greatest website in the world!</h3>
                </div>
                <div class = "right">
                    <button class = "button secondary large " id = "signup-menu">Sign Up</button>
                    <br />
                    <button class = "button secondary large " id = "login-menu">Login</button>
                </div>
            </div>
            <div class = "boardlist">
                <a href = "board.php">
                    <div class = "board">
                        <h3>
                            Unincorporated <br /> Board
                        </h3>
                    </div>
                </a>
            </div>
        </div>
        <div class = "sideCol">
    
        </div>
    <?php signup(); ?>
    <script src="assets/js/app.js"></script>
    <script type = "text/javascript" src='http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.5/jquery-ui.min.js'></script>
    <!--Change this and-->
    <script type = "text/javascript" src = "https://rawgit.com/alexei/sprintf.js/master/src/sprintf.js"></script>
  </body>
</html>