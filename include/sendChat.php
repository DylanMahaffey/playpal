<?php
session_start();
include "db.php";

if(isset($_SESSION['uid'])){
    $uid = $_SESSION['uid'];
    $uname = $_SESSION['first']." ".$_SESSION['last'];
}
if(isset($_POST['chat'])){
    $chat = $_POST['chat'];
    $gameId = $_POST['gameId'];

    $query = "INSERT INTO messages (message, uid, name, gameid)
                    VALUES ('{$chat}', '{$uid}', '{$uname}', '{$gameId}')";

    $result = mysqli_query($conn, $query);
    if($result){

    } else {
        die("database query failed. " . mysqli_error($conn));
    }
    exit();
}
