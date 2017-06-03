
<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link rel="stylesheet" href="assets/css/app.css">
    <?php include "assets/php/session.php"; ?>
    <!--<title>Foundation for Sites</title>
    
  </head>
  <body>-->

    <title>Board</title>
    </head>
    <div class = "signup-menu">
        <div class = "">
            <div class = "toprow">
                <div class = "button secondary large exit" id = "signup-menu-exit">
                    X
                </div>
            </div>
            <div class = "middle">
                <form method = "POST">
    
                </form>
            </div>
        </div>
    </div>
    <div class = "login-menu">
        <div class = "callout">
            <div class = "button large" id = "login-menu-exit">
                X
            </div>
            <form>
                
            </form>
        </div>
    </div>
    <body class = "board">
        <div class = "menucontainer">
            <div class = "menubar callout">
                <div class = "left">
                    <a href = "">FAQ</a>
                    <br />
                    <a href = "">Rules</a>
                </div>
                <div class = "center">
                    <h2> Leidle </h2>
                </div>
                <div class = "right">
                    <button class = "button secondary large " id = "signup-menu">Sign Up</button>
                    <br />
                    <button class = "button secondary large " id = "login-menu">Login</button>
                </div>
            </div>
        </div>
        <br />
    <div class = "main">
        <div class = "top callout">
            <div class = "expandcreate hoverable callout">
                <h5>Submit your own Picket!</h5>
            </div>
            <div class = "create">
                <form id = "picketform" method = "post">
                    <div class = "options">
                        <input type = "checkbox" id = "showuser" name = "showuser" class = "" /><label for ="showuser">Show Username</label>
                        <input type = "checkbox" id = "showflair" name = "showflair" class = "" /><label for ="showflair">Show Flair</label>
                        <label for ="subjectline"> Subject: </label><input type = "text" class = "subject" id = "subjectline" name = "subject" />
                    </div>
                    <div class = "grid">
                        <div class = "gridrow">
                            <div class = "square" id = "1">
                                <div class = "picksquares"></div>
                            </div>
                            <div class = "square" id = "2">
                                <div class = "picksquares"></div>
                            </div>
                            <div class = "square" id = "3">
                                <div class = "picksquares"></div>
                            </div>
                        </div>
                        <div class = "gridrow">
                            <div class = "square" id = "4">
                                <div class = "picksquares"></div>
                            </div>
                            <div class = "square" id = "5">
                                <div class = "picksquares"></div>
                            </div>
                            <div class = "square" id = "6">
                                <div class = "picksquares"></div>
                            </div>
                        </div>
                        <div class = "gridrow">
                            <div class = "square" id = "7">
                                <div class = "picksquares"></div>
                            </div>
                            <div class = "square" id = "8">
                                <div class = "picksquares"></div>
                            </div>
                            <div class = "square" id = "9">
                                <div class = "picksquares"></div>
                            </div>
                        </div>
                    </div>
                    <div class = "backnext">
                        <div class = "button secondary large" id = "back">
                            Back
                        </div>
                        <div class = "button large" id = "next">
                            Next
                        </div>
                    </div>
                    <div class = "submit">
                            <!--<div class=" captcha g-recaptcha" data-sitekey="6LeZtSMUAAAAALXmuaBYijJNVg-F7uWDH9a9X-sP"></div>-->
                            <!--<button class="button large g-recaptcha" data-sitekey="6LeZtSMUAAAAALXmuaBYijJNVg-F7uWDH9a9X-sP" data-callback='onSubmit' value = "getResponse" name = "submit" id = "submitpicket">Submit Picket</button>-->
                            <button class = "button large" type = "submit" name = "submitpicket">Submit Picket</button>
                    </div>
                </form>
            </div>
        </div>
        <div class = "bars">
            <div class = "left callout">
            </div>
            <div class = "right callout">
            </div>
        </div>
    </div>
    <script src="assets/js/app.js"></script>
    <script type = "text/javascript" src='http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.5/jquery-ui.min.js'></script>
    <!--Change this and-->
    <script type = "text/javascript" src = "https://rawgit.com/alexei/sprintf.js/master/src/sprintf.js"></script>
  </body>
</html>