<?php
session_start();
$output = "";
include "db.php";

$query = "SELECT * FROM games ORDER BY realDate ASC";
$games =  mysqli_query($conn, $query);

if(mysqli_num_rows($games) == 0){
    echo "<div class='no-games'><h3 class='title'>currently no games</h3></div>";
}
if(!$games){
    die("database query failed.");
}else{
    $lastRow=array('day'=>'');

    while($game = mysqli_fetch_assoc($games)){
    $numberOpen = $game['size']-$game['playerCount'];

    if($numberOpen===0){
        $open = "Full";
    }else{
        $open = "Open";
    }

    if($game['gender'] == "m"){
        $gender = "Men's";
    }else if($game['gender'] == "f"){
        $gender = "Women's";
    }else if($game['gender'] == "c"){
        $gender = "Co-Ed";
    }

    if($game['intensity']==1){
        $level = "Recreational";
    }else if($game['intensity']==2){
        $level = "Competitive";
    }



        $daybar = '<div class="day-bar">'.$game['day'].'</div>';

        $output = '<a href="game.php?gameId='.$game["id"].'"><div class="game-bar">
            <div class="time">
                <h4>'.$game["hour"].'</h4>
                <p>'.$open.' - '.$numberOpen.'</p>
            </div>
            <div class="game-info">
                <span>Host: </span>'.$game['hostname'].'<br>
                <span>Location: </span>'.$game['address'].'<br>
                <span>Gender: </span>'.$gender.'<br>
                <span>Intensity: </span>'.$level.'
            </div>
        </div></a>';

        if($game['day']!=$lastRow['day']){
            $lastRow = $game;

            echo $daybar.$output;
        }else{
            echo $output;
        }



    }
}
?>
