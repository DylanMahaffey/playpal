<?php
include "db.php";
$current_date = date("Ymdhis");

$query = "SELECT * FROM games  WHERE realDate < $current_date";
$games =  mysqli_query($conn, $query);


if(!$games){
    die("database query failed.");
}else{
    while($game = mysqli_fetch_assoc($games)){
        $gameid = $game['id'];
        $delete = "DELETE FROM games WHERE id=$gameid";
        $delResult =  mysqli_query($conn, $delete);
        $messages = "DELETE FROM messages WHERE gameid=$gameid";
        $mesResult =  mysqli_query($conn, $messages);
        $players = "DELETE FROM players WHERE gameid=$gameid";
        $playResult =  mysqli_query($conn, $players);

        if(!$delResult){
             die("database query failed.");
        }
        if(!$mesResult){
             die("database query failed.");
        }
        if(!$playResult){
             die("database query failed.");
        }
    }
}
