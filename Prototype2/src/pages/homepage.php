<title>
Homepage
</title>
</head>
<body>
    <div class = "top-bar pageform">
        <div class = "top-bar-left">
            <ul class = "menu medium-horizontal">
                <li class = "menu-text"><a href = "homepage.php" class = "hoverable leidlefont button large">Liedle</a></li>
                <li class = "menu-text"><a href = "faq.php" class = "hoverable">FAQ</a></li>
                <li class = "menu-text"><a href = "rules.php" class = "hoverable">Rules</a></li>
            </ul>
        </div>
        <div class = "top-bar-right">
            <ul class = "menu medium-horizontal">
                <?php
                    include "assets/php/LoginFunctions.php";
                ?>
            </ul>
        </div>
    </div>
    <div class = "pageform">
        <div class = "large-12 columns menu-centered">
            <a href = "boards/board1.php">
                <div class = "primary callout medium-3 columns hoverable">
                    <h4>
                        Board 1
                    </h4>
                </div>
            <a href = "boards/board2.php">
                <div class = "primary callout medium-3 columns hoverable">
                    <h4>
                        Board 2
                    </h4>
                </div>
            </a>
            <a href = "boards/board3.php">
                <div class = "primary callout medium-3 columns hoverable">
                    <h4>
                        Board 3
                    </h4>
                </div>
            </a>
            <a href = "boards/board4.php">
                <div class = "primary callout medium-3 columns hoverable">
                    <h4>
                        Board 4
                    </h4>
                </div>
            </a>
        </div>
        <div class = "large-12 columns">
            <p class = "medium-9 columns">
                Leidle is a free, local, and anonymous hub for college and university discussion. 
                Users will have the option of posting anonymously without fear of having their user 
                data logged and sold to third party buyers. User profiles are strictly optional and 
                transactional benefits are primarily cosmetic. Topics such as sports, clubs, campus activity, 
                campus culture, and off-topic discussions are all welcomed within the guidelines outlined by Leidle’s rules.
            </p>
            <a href = "boards/unicorn.php">
                <div class = "primary callout medium-3 columns hoverable textcenter">
                    <h3>
                        Unincorporated <br /> Board
                    </h3>
                </div>
            </a>
        </div>
    </div>