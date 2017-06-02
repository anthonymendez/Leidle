<html>
    <head>
        <title>
            Send PHP
        </title>
    </head>
    <body>
        <form method = 'post' action = 'post'>
        <input type = 'text' name = 'id' />
        <br />
        <input type = 'text' name = 'info' />
        <br />
        <input type = 'submit' name = 'submit' />
        </form>
        <?php
            $servername = 'localhost';
            $username = '';
            $password = '';

            $con = mysqli_connect($servername,$username,$password);

            if($con){
                echo "<br /> Connected!";
            }else{
                die("<br /> error, could not connect!");
            }

            $ID = $_POST['id'];
            $INFO = $_POST['info'];
            
            if(strlen($ID) !== 0 && strlen($INFO) !== 0 ){
                $sqli = mysqli_prepare($con, "INSERT INTO test.testtable VALUES (?,?)");
                mysqli_stmt_bind_param($sqli,'is',$ID,$INFO);
                mysqli_stmt_execute($sqli);
                mysqli_close($con);
            }
        ?>
    </body>
</html>