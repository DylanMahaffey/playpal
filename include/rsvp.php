<?php
session_start();
include "db.php";

  $gameId = $_POST['gameId'];
  $name = $_SESSION['first']." ".$_SESSION['last'];
  $uid = $_SESSION['uid'];

  $playerCount = "UPDATE `games`
                             SET playerCount = playerCount + 1
                             WHERE id = '{$gameId}';";

$playerCountResult = mysqli_query($conn, $playerCount);

 if($playerCountResult){

 } else {
     die("database query failed. " . mysqli_error($conn));
 }



$query = "INSERT INTO players(gameid, uid, name)
                              VALUES($gameId, $uid, '{$name}')";
$result = mysqli_query($conn, $query);
array_push($_SESSION['rsvps'], $gameId);

if($result){
    echo "success";
} else {
    die("database query failed. " . mysqli_error($conn));
}
