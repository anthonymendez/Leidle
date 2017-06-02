<html>
    <head>
        <title>
            Retrieve PHP
        </title>
    </head>
    <body>
        <?php
            $servername = 'localhost';
            $username = '';
            $password = '';

            $con = mysqli_connect($servername,$username,$password);

            if($con){
                echo "<br /> Connected!\n";
            }else{
                die("<br /> error, could not connect!");
            }

            $query = "SELECT id, info FROM test.testtable ORDER BY id DESC";
            $result = mysqli_query($con,$query);
            
            echo "<br />";

            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)) {
                    echo "id: " . $row["id"]. " - Info: " . $row["info"]."<br />";
                }
            }else{
                echo "Something went wong!";
            }

            mysqli_close($con);
        ?>
    </body>
</html>