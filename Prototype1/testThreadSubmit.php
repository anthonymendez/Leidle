<html>
    <head>
        <title>
            Thread Submit Test
        </title>
        <?php include "DatabaseFunctions.php" ?>
    </head>
    <body>
        <div style = "border: 2px solid black; width = 100%; margin = 20px; padding = 20px;">
        <form method = 'post'>
            <h3> Submit new thread! </h3>
            <input type = "text" name = "subject" required />
            <br />
            <input type = "text" name = "content" required />
            <br />
            <input type = "submit" name = "submit" value = "submit" />
        </form>
        <?php 
            // include 'DatabaseFunctions.php';
            $con = mysqli_connect($GLOBALS["servername"],'','');

            if($con){
                echo "<br /> Connected!";
                echo gmdate("Y-m-d H:i:s", time());
            }else{
                die("<br /> error, could not connect!");
            }
            if(isset($_POST['submit'])){
            try{
                $threadSubject = $_POST['subject'];
                $postContent = $_POST['content'];
                $threadID = getMostRecentThreadId($con)+1;
                $threadpostID = 1;
                $postID = getMostRecentPostId($con)+1;
                $time = gmdate("Y-m-d H:i:s", time());
                echo "<br />".$threadSubject.":".$postContent.":".$threadID.":".$postID.":".$threadpostID;
            }catch(Exception $e){
                echo "<br /> Please Enter your thread information!";
            }
            $clientIP = get_client_ip();
            if(strlen($postContent) !== 0 && $clientIP !== "UNKNOWN"){
                try{
                    $sqli = mysqli_prepare($con, "INSERT INTO test.thread VALUES (?,?,?)");
                    mysqli_stmt_bind_param($sqli,'iss',$threadID,$threadSubject,$time);
                    mysqli_stmt_execute($sqli);
                    $sqli = mysqli_prepare($con, "INSERT INTO test.posts VALUES (?,?,?,?,?)");
                    mysqli_stmt_bind_param($sqli,'iiiss',$threadID,$postID,$threadpostID,$postContent,$time);
                    mysqli_stmt_execute($sqli);
                    $sqli = mysqli_prepare($con, "INSERT INTO test.useridthreads VALUES (?,?,?)");
                    mysqli_stmt_bind_param($sqli,'sis',$clientIP,$threadID,createRandomUserID());
                    mysqli_stmt_execute($sqli);
                }catch(Exception $e){
                    echo "Uh oh! Something went wrong here! <br />".$e;    
                }
                mysqli_close($con);
            }
            unset($threadSubject,$postContent,$threadID,$postthreadid,$postID,$time);
            header("Location:testThread.php");
            }
            exit;
        ?>
        </div>
    </body>
</html>