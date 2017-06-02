<html>
    <head>
        <title>
            Thread Test
        </title>
        <?php include "DatabaseFunctions.php" ?>
    </head>
    <body>
        <div style = "border: 2px solid black; width = 100%; margin = 20px; padding = 20px;">
            <h2> Threads </h2>
            
            <?php
            // include "DatabaseFunctions.php";
            $con = mysqli_connect($GLOBALS["servername"],'','');

            $threadquery = "SELECT threadid, subject, timestamp FROM test.thread ORDER BY timestamp DESC";
            $threadresult = mysqli_query($con,$threadquery);
            
            echo "<br />";
            
            if(/*!$result ||*/ mysqli_num_rows($threadresult) > 0){
                while($threadrow = mysqli_fetch_assoc($threadresult)) {
                    $thisThreadID = $threadrow["threadid"];
                    echo "threadid: " . $threadrow["threadid"]. " - subject: " . $threadrow["subject"]." - timestamp ".$threadrow["timestamp"].
                    "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".
                    '<a href = "'.htmlspecialchars("testThreadReply.php?threadid=".urlencode($threadrow["threadid"])."").'">
                        Reply to thread
                    </a>'
                    ."<br />";
                    $postquery = "SELECT * FROM test.posts WHERE $thisThreadID = threadid ORDER BY timestamp ASC";
                    $postresult = mysqli_query($con,$postquery);
                    while($postrow = mysqli_fetch_assoc($postresult)){
                        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
                                .$postrow["content"].": ".$postrow["timestamp"].":<br />";
                    }
                }
            }else{
                echo "No threads to load...ruh roh raggy!";
            }

            mysqli_close($con);
            ?>
        </div>
        <div style = "border: 2px solid black; width = 100%; margin = 20px; padding = 20px;">
            <h2><a href = "testThreadSubmit.php">
                Want to submit your own thread?
                </a>
            </h2>
        </div>
    </body>
</html>