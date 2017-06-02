<?php
    include 'variables.php';
    session_start();

function getMostRecentThreadId($con){
    $con = mysqli_connect($GLOBALS["servername"],$GLOBALS['username'],$GLOBALS['password']);
    $query = "SELECT MAX(threadid) AS max FROM prototype2.thread;";
    $result = mysqli_query($con,$query);
    if(!mysqli_num_rows($result) > 0){
        return -1;
    }
    $val = mysqli_fetch_array($result);
    $largestNumber = $val['max'];
    return $largestNumber;
}   

function getMostRecentPostId($con){
    $con = mysqli_connect($GLOBALS["servername"],$GLOBALS['username'],$GLOBALS['password']);
    $query = "SELECT MAX(postid) AS max FROM prototype2.posts;";
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
    $con = mysqli_connect($GLOBALS["servername"],$GLOBALS['username'],$GLOBALS['password']);
    $threadID = mysqli_escape_string($con, $threadID);
    $query = "SELECT MAX(threadpostid) AS max FROM prototype2.posts WHERE threadid = '$threadID';";
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
function getUserID($clientIP, $threadID){
    $con = mysqli_connect($GLOBALS["servername"],$GLOBALS['username'],$GLOBALS['password']);
    $threadID = mysqli_escape_string($con, $threadID);
    $sessionusername = $_SESSION['login_user'];
    $query = "SELECT userid FROM prototype2.useridthreads WHERE username = '$sessionusername' AND threadid = '$threadID';";
    $result = mysqli_query($con,$query);
    if(mysqli_num_rows($result) === 0){
        $randomID = createRandomUserID();
        $checkquery = "SELECT userid FROM prototype2.useridthreads WHERE threadid = '$threadID' AND userid = '$randomID'";
        $checkresult = mysqli_query($con,$checkquery);
        while(mysqli_num_rows($checkresult) > 0){
            $randomID = createRandomUserID();
            $checkquery = "SELECT userid FROM prototype2.useridthreads WHERE threadid = '$threadID' AND userid = '$randomID'";
            $checkresult = mysqli_query($con,$checkquery);
        }
        $insertquery = "INSERT INTO prototype2.useridthreads VALUES (?,?,?,?)";
        $insertresult = mysqli_query($con,$insertquery);
        $insert = mysqli_prepare($con, $insertquery);
        mysqli_stmt_bind_param($insert, 'siss', $clientIP, $threadID,$randomID,$sessionusername);
        mysqli_stmt_execute($insert);
        return $randomID;
    }else{
        $fetchUSERID = mysqli_fetch_assoc($result);
        return $fetchUSERID['userid'];
    }
}

function getThreads($boardid){
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

function SubmitThread($boardid){
    $con = mysqli_connect($GLOBALS["servername"],$GLOBALS['username'],$GLOBALS['password']);
    if(mysqli_connect_errno()){
        echo "Connect failed: ".mysqli_connect_error();
        exit();
    }

    if(isset($_POST['submitThread'])){
    try{
        $threadSubject = mysqli_escape_string($con, $_POST['subject']);
        $postContent = mysqli_escape_string($con, $_POST['content']);
        $threadID = getMostRecentThreadId($con)+1;
        $threadpostID = 1;
        $postID = getMostRecentPostId($con)+1;
        $time = gmdate("Y-m-d H:i:s", time());
        $clientIP = get_client_ip();   
    }catch(Exception $e){
        echo "<br /> Please Enter your thread information!";
    }
    if(strlen($postContent) !== 0 && $clientIP !== "UNKNOWN"){
        try{
            $threadCreatorUserID = createRandomUserID();
            $postsubject = "User ID: $threadCreatorUserID &middot; Thread Post ID: $threadpostID &middot; $time";
            if($_POST['showuser']){
                $postsubject = "Username: ".$_SESSION['login_user']." &middot; ".$postsubject;
            }
            $sqli = mysqli_prepare($con, "INSERT INTO prototype2.thread VALUES (?,?,?,?);");
            mysqli_stmt_bind_param($sqli,'isis',$threadID,$threadSubject,$boardid,$time);
            mysqli_stmt_execute($sqli);
            $sqli = mysqli_prepare($con, "INSERT INTO prototype2.posts VALUES (?,?,?,?,?,?,?,?,?);");
            mysqli_stmt_bind_param($sqli,'iiisssiss',$threadID,$postID,$threadpostID,$postContent,$threadCreatorUserID,$time,$boardid,$_SESSION['login_user'],$postsubject);
            mysqli_stmt_execute($sqli);
            $sqli = mysqli_prepare($con, "INSERT INTO prototype2.useridthreads VALUES (?,?,?,?);");
            mysqli_stmt_bind_param($sqli,'siss',$clientIP,$threadID,$threadCreatorUserID,$_SESSION['login_user']);
            mysqli_stmt_execute($sqli);
        }catch(Exception $e){
            echo "Uh oh! Something went wrong here! <br />".$e;    
        }
        mysqli_close($con);
    }
    unset($threadSubject,$postContent,$threadID,$postthreadid,$postID,$time);
    header("Location:".htmlspecialchars("boards/board".urlencode($boardid).".php"));
    }
    exit;
}

function SubmitPost($boardid,$threadid){
    $con = mysqli_connect($GLOBALS["servername"],$GLOBALS['username'],$GLOBALS['password']);

    if(isset($_POST['submitPost'])){
    try{
        $postContent = mysqli_escape_string($con, $_POST['content']);
        $threadpostID = getMostRecentPostIdInThread($con,$threadid)+1;
        $postID = getMostRecentPostId($con)+1;
        $time = gmdate("Y-m-d H:i:s", time());
        $clientIP = get_client_ip();
        $userID = getUserID($clientIP,$threadid);
        $postsubject = "User ID: $userID &middot; Thread Post ID: $threadpostID &middot; $time";
        if($_POST['showuser']){
            $postsubject = "Username: ".$_SESSION['login_user']." &middot; ".$postsubject;
        }
    }catch(Exception $e){
        echo "<br /> Please Enter your post information!";
    }
    
    if(strlen($postContent) !== 0){
        try{
            $sqli = mysqli_prepare($con, "INSERT INTO prototype2.posts VALUES (?,?,?,?,?,?,?,?,?);");
            mysqli_stmt_bind_param($sqli,'iiisssiss',$threadid,$postID,$threadpostID,$postContent,$userID,$time,$boardid,$_SESSION['login_user'],$postsubject);
            mysqli_stmt_execute($sqli);
        }catch(Exception $e){
            echo "Uh oh! Something went wrong here! <br />".$e;    
        }
        mysqli_close($con);
    }
    unset($postContent,$threadid,$postthreadid,$postID,$time);
    header("Location:".htmlspecialchars("boards/board".urlencode($boardid).".php"));
    }
    exit;
}
?>