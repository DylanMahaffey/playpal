<?php
session_start();
$gameId = $_GET['gameId'];
$output = "";
include "db.php";

$query = "SELECT * FROM players WHERE gameid=$gameId";
$players =  mysqli_query($conn, $query);

if(mysqli_num_rows($players) == 0){
    echo "<script type='text/javascript'>
        window.location.href =\"$hostname/gameboard.php\";
    </script>";
}

if(!$players){
    die("database query failed.");
}else{
    $playerCount = 1;
    while($player = mysqli_fetch_assoc($players)){
        $output = '<div class="player-row"><p class="player-key">'.$playerCount.'</p>'.$player['name'].'</div>';

        echo $output;
        $playerCount++;

    }
}
?>
