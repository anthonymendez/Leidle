<?php
    include "variables.php";
    /*
    Handles getting, creating, editing posts and threads.
    */

    //Picket Class

    class picket{
        function __construct(){
            //TODO Constructor
        }
    }

    //Get the most recent thread ID
    function getMostRecentThreadId(){
    $connection = mysqli_connect($GLOBALS["servername"],$GLOBALS['db_getcontent_username'],$GLOBALS['db_getcontent_password']);
    $query = "SELECT MAX(threadid) AS max FROM p3_content.threads;";
    $result = mysqli_query($connection,$query);
        if(!mysqli_num_rows($result) > 0){
            return -1;
        }
    $val = mysqli_fetch_array($result);
    $largestNumber = $val['max'];
    return $largestNumber;
    }   

    //Get the most recent post iD
    function getMostRecentPostId(){
        $connection = mysqli_connect($GLOBALS["servername"],$GLOBALS['db_getcontent_username'],$GLOBALS['db_getcontent_password']);
        $query = "SELECT MAX(postid) AS max FROM p3_content.posts;";
        $result = mysqli_query($connection,$query);
        if(!mysqli_num_rows($result) > 0){
            return -1;
        }
        $val = mysqli_fetch_array($result);
        mysqli_close($connection);
        $largestNumber = $val['max'];
        return $largestNumber;
    }
    //Get most recent post Id from a specific thread.
    function getMostRecentPostIdInThread($threadID){
        $connection = mysqli_connect($GLOBALS["servername"],$GLOBALS['db_getcontent_username'],$GLOBALS['db_getcontent_password']);
        $threadID = mysqli_escape_string($connection, $threadID);
        $query = "SELECT MAX(threadpostid) AS max FROM p3_content.posts WHERE threadid = '$threadID';";
        $result = mysqli_query($connection,$query);
        if(mysqli_num_rows($result) == 0){
            return -1;
        }
        $val = mysqli_fetch_array($result);
        mysqli_close($connection);
        $largestNumber = $val['max'];
        return $largestNumber;
    }
    //Create a 8 Character randomly generated ID.
    function createRandomUserID(){
        $characters = "qwertyuiopasdfghjklzxcvbnm1234567890QWERTYUIOPLKJHGFDSAZXCVBNM";
        $randString = "";
        for($i = 0; $i < 8; $i++){
            $randString.=($characters[rand(0,strlen($characters)-1)]);
        }
        return $randString;
    }
    //Get the IP Address of the client.
    function get_client_ip(){
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if(isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }
    //Return a UserID if they have posted in the thread before. If they haven't it will return a randomly generated string.
    function getUserID($username, $threadID){
        $connection = mysqli_connect($GLOBALS["servername"],$GLOBALS['db_getcontent_username'],$GLOBALS['pasdb_getcontent_passwordsword']);
        $threadID = mysqli_escape_string($connection, $threadID);
        $session_username = $_SESSION['login_user'];
        $query = "SELECT userid FROM p3_content.posts WHERE username = '$session_username' AND threadid = '$threadID';";
        $result = mysqli_query($con,$query);
        if(mysqli_num_rows($result) === 0){
            $randomID = createRandomUserID();
            $checkquery = "SELECT userid FROM p3_content.posts WHERE threadid = '$threadID' AND userid = '$randomID'";
            $checkresult = mysqli_query($con,$checkquery);
            while(mysqli_num_rows($checkresult) > 0){
                $randomID = createRandomUserID();
                $checkquery = "SELECT userid FROM p3_content.posts WHERE threadid = '$threadID' AND userid = '$randomID'";
                $checkresult = mysqli_query($connection,$checkquery);
            }
            return $randomID;
        }else{
            $fetchUSERID = mysqli_fetch_assoc($result);
            return $fetchUSERID['userid'];
        }
    }
    //Submit the picket the user entered in the database
    function submitPicket(){
        if(isset($_POST["submitpicket"]) && isset($_SESSION['login_user'])){
            $connection = mysqli_connect($GLOBALS["servername"],$GLOBALS['db_submitpicket_username'],$GLOBALS['db_submitpicket_password']);
            $Data = array($_POST["#1"],$_POST["#2"],$_POST["#3"],$_POST["#4"],$_POST["#5"],$_POST["#6"],$_POST["#7"],$_POST["#8"],$_POST["#9"]);
            $serializedPicket = serialize($Data);
            $threadID = getMostRecentThreadId()+1;
            $session_username = $_SESSION['login_user'];
            $subject = $_POST["subject"];
            $timecreated = gmdate("Y-m-d H:i:s", time());
            $timedelete = $timecreated;
            $timedelete->modify('+1 day');
            $postid = getMostRecentPostId()+1;
            $threadpostid = getMostRecentPostIdInThread($threadID)+1;
            try{
                //ThreadID,subject,timeposted,deletetime
                $newthreadquery = "INSERT INTO p3_content.threads VALUES (?,?,?,?)";
                $sqli = mysqli_prepare($connection,$newthreadquery);
                mysqli_stmt_bind_param($sqli,$threadID,$subject,$timecreated,$timedelete);
                mysqli_stmt_execute($sqli);
                //Picket,username,userid,threadid,postid,threadpostid, timeposted
                $newpostquery = "INSERT INTO p3_content.posts VALUES (?,?,?,?,?,?,?)";
                $sqli = mysqli_prepare($connection,$newpostquery);
                mysqli_stmt_bind_param($sqli,$serializedPicket,$session_username,getUserID($session_username,$threadID),$threadID,$postid,$threadpostid,$timecreated);
                mysqli_stmt_execute($sqli);
                mysqli_close($connection);
                // header("Location:".htmlspecialchars("board".urlencode(STUFFHERE).".php"));
            }catch(error $e){
                Echo "Ruh roh raggy! Something went wrong!";
            }
            exit;
        }
    }
    //Retrieve the pickets in the database
    function getPickets(){
        $connection = mysqli_connect($GLOBALS["servername"],$GLOBALS['db_getcontent_username'],$GLOBALS['db_getcontent_password']);
        $getquery = "SELECT * FROM p3_content.posts ORDER BY timeposted DESC LIMIT 50";
        //TODO FINISH
    }

function getPosts($boardid){
    $con = mysqli_connect($GLOBALS["servername"],$GLOBALS['username'],$GLOBALS['password']);

    $threadquery = "SELECT * FROM prototype2.thread WHERE boardid = '$boardid' ORDER BY timestamp DESC;";
    $threadresult = mysqli_query($con,$threadquery);
    
    if(mysqli_num_rows($threadresult) > 0){
        while($threadrow = mysqli_fetch_assoc($threadresult)) {
            $thisThreadID = $threadrow["threadid"];
            //HTML code for a thread
            if(isset($_SESSION['login_user'])){
                echo "
                    <div class = 'large-12 columns'>
                        <div class = 'row textcenter'>
                            <p>
                                Subject: ".$threadrow["subject"]." &middot; Thread ID: ".$threadrow["threadid"]." &middot; Timestamp: ".$threadrow["timestamp"]."
                                &middot;
                                ".'
                                <a class = "button" href = "'.htmlspecialchars("../reply.php?threadid=".urlencode($threadrow["threadid"])."&boardid=".urlencode($boardid)."").'">
                                    Reply to thread
                                </a>
                                '."
                            </p>
                        </div>
                ";
            }else{
                echo "
                    <div class = 'large-12 columns'>
                        <div class = 'row textcenter'>
                            <p>
                                Subject: ".$threadrow["subject"]." &middot; Thread ID: ".$threadrow["threadid"]." &middot; Timestamp: ".$threadrow["timestamp"]."
                            </p>
                        </div>
                ";
            }
            $postquery = "SELECT * FROM prototype2.posts WHERE '$thisThreadID' = threadid ORDER BY timestamp ASC;";
            $postresult = mysqli_query($con,$postquery);
            while($postrow = mysqli_fetch_assoc($postresult)){
                $postsubject = $postrow['subject'];
                //HTML code for each individual post
                echo "
                    <div class = 'large-12 columns row'>
                        <p class = 'post-header'>
                            $postsubject
                        </p>
                        <p class = 'post-content'>
                            ".$postrow["content"]."
                        </p>
                    <hr />
                    </div>
                ";
            }
        }
        if(isset($_SESSION['login_user'])){
            echo "
                    </div>
                    <div class = 'textcenter'>
                        <h5>
                            No more threads to load.
                        </h5>
                        <h5>"."
                            <a  class = 'button large' href = ".htmlspecialchars("../newthread.php?boardid=".urlencode($boardid)."").">
                                Create a new thread!
                            </a>
                            "."
                        </h5>
                    </div>
                ";
        }else{
            echo "
                    </div>
                    <div class = 'textcenter'>
                        <h5>
                            No more threads to load.
                        </h5>
                    </div>
                ";
        }
    }else{
        echo "
        <div class = 'textcenter'>
            <h5>
                No threads at all or something went wrong!...ruh roh raggy!
            </h5>
            <h5>"."
                <a href = ".htmlspecialchars("../newthread.php?boardid=".urlencode($boardid)."").">
                    Create a new thread!
                </a>
                "."
            </h5>
        </div>
        ";
    }

    mysqli_close($con);
}

    //Submit a regular post responding to a comment
    function submitPost(){
        //TODO FINISH
    }
?>