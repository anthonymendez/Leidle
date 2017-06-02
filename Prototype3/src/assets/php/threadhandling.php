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

    //Serialize Picket
    function serializePicket($picket){

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
        if(isset($_POST["submitpicket"])){
            $connection = mysqli_connect($GLOBALS["servername"],$GLOBALS['db_submitpicket_username'],$GLOBALS['db_submitpicket_password']);
            $Data = array($_POST["#1"],$_POST["#2"],$_POST["#3"],$_POST["#4"],$_POST["#5"],$_POST["#6"],$_POST["#7"],$_POST["#8"],$_POST["#9"]);
            $serializedData = serialize($values);
            $threadID = getMostRecentThreadId()+1;
            $session_username = $_SESSION['login_user'];
            $newthreadquery = "INSERT INTO p3_content.threads VALUES (?,?,?,?)";
            $newpostquery = "INSERT INTO p3_content.threads VALUES (?,?,?,?,?,?)";
            //TODO FINISH
        }
    }
?>