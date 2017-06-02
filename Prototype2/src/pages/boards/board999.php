<title>
    Unicorp. Board
</title>
</head>
<body>
<div class = "pageform">
    <div class = "textcenter">
        <h1>
            <a href = "../homepage.php">
                Leidle
            </a>
        </h1>
        <h2>
            Unincorporated Board
        </h2>
        <h4>
            <a href = "rules.php" class = "margin-sides-5 hoverable">RULES</a>
            <a href = "faq.php" class = "margin-sides-5 hoverable">FAQ</a>
        </h4>
    </div>
    <div class = "large-12 columns">
        <?php include "../assets/php/DatabaseFunctions.php";
        //Add @ to suppress warnings
        getThreads(999);
        ?>
    </div>
</div>