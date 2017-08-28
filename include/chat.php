<?php
session_start();
$output = "";
$gameId = $_GET['gameId'];
include "db.php";

$query = "SELECT * FROM messages WHERE gameid=$gameId ORDER BY id ASC";
$thread =  mysqli_query($conn, $query);

if(!$thread){
    die("database query failed.");
}else{
    $last="";
    while($message = mysqli_fetch_assoc($thread)){

if(isset($_SESSION['uid'])&&$_SESSION['uid']==$message['uid']){

    if($last==$message["name"]){
        $output = '<div class="bubble no-padding"><div class="user-bubble">'.$message["message"].'</div></div>';
    }else{
        $output = '<div class="bubble"><div class="user-bubble">'.$message["message"].'<div class="user"><div class="set">'.$message["name"].'</div></div></div></div>';
    }

}else{

    if($last==$message["name"]){
        $output = '<div class="bubble no-padding"><div class="message-bubble">'.$message["message"].'</div></div>';

    }else{
        $output = '<div class="bubble"><div class="message-bubble">'.$message["message"].'<div class="name">'.$message["name"].'</div></div></div>';
    }
}

        echo $output;
        $last = $message["name"];

    }
}
?>
