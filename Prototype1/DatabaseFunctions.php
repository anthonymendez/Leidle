<?php
    $servername = "localhost";
function getMostRecentThreadId($con){
    $con = mysqli_connect($GLOBALS["servername"],'','');
    $query = "SELECT MAX(threadid) AS max FROM test.thread";
    $result = mysqli_query($con,$query);
    if(!mysqli_num_rows($result) > 0){
        return -1;
    }
    $val = mysqli_fetch_array($result);
    mysqli_close($con);
    $largestNumber = $val['max'];
    return $largestNumber;
}   

function getMostRecentPostId($con){
    $con = mysqli_connect($GLOBALS["servername"],'','');
    $query = "SELECT MAX(postid) AS max FROM test.posts";
    $result = mysqli_query($con,$query);
    if(!mysqli_num_rows($result) > 0){
        return -1;
    }
    $val = mysqli_fetch_array($result);
    mysqli_close($con);
    $largestNumber = $val['max'];
    return $largestNumber;
}

function getMostRecentPostIdInThread($con,$threadID){
    $con = mysqli_connect($GLOBALS["servername"],'','');
    $query = "SELECT MAX(threadpostid) AS max FROM test.posts WHERE threadid = $threadID";
    $result = mysqli_query($con,$query);
    if(mysqli_num_rows($result) == 0){
        return -1;
    }
    $val = mysqli_fetch_array($result);
    mysqli_close($con);
    $largestNumber = $val['max'];
    return $largestNumber;
}
function createRandomUserID(){
    $characters = "qwertyuiopasdfghjklzxcvbnm1234567890QWERTYUIOPLKJHGFDSAZXCVBNM";
    $randString = "";
    for($i = 0; $i < 8; $i++){
        $randString.=($characters[rand(0,strlen($characters)-1)]);
    }
    return $randString;
}
function getUserID($clientIP, $threadID){
    $con = mysqli_connect($GLOBALS["servername"],'','');
    $query = "SELECT threaduserid FROM test.useridthreads WHERE IP = $clientIP AND threadid = $threadID";
    $result = mysqli_query($con,$query);
    if(mysqli_num_rows($result) === 0){
        return createRandomUserID();
    }
    $fetchUSERID = mysqli_fetch_assoc($result);
    return $fetchUSERID['threaduserid'];
}
?>