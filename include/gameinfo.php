<?php
$gameId = $_GET['gameId'];
$output='';
include "db.php";
include "hostname.php";

$query = "SELECT * FROM games WHERE id=$gameId";
$games =  mysqli_query($conn, $query);

if(mysqli_num_rows($games) == 0){
    echo "<script type='text/javascript'>
        window.location.href =\"$hostname/gameboard.php\";
    </script>";
}

if(!$games){
    die("database query failed.");
}else{

    $game = mysqli_fetch_array($games);

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

    $gameDay = $game['day'];
    $gameHour = $game['hour'];
    $gameAddress = $game['address'];
    $gameid = $game['id'];

$message = "
<html>
<head>
    <title>Document</title>
    <style>
    *{
        margin: 0;
        padding: 0;
    }
    .background{
        width: auto;
        background-image: url('https://playpal3.000webhostapp.com/img/goal.jpg');
        background-position: center;
        background-size: cover;
        border-radius: 10px;
    }
    .box{
        background: rgba(0, 196, 167, 0.8);
        border-radius: 10px;
        padding: 30px 50px;
    }
    .top{
        display: table;
        margin: 0 auto;
        margin-bottom: 30px;
    }
    h1{
        color: white;
        font-size: 3em;
        margin-right: 20px;
        display: inline;
        margin: 20px;
    }
    img{
        width: 100px;
        display: inline-block;
    }
    .info-body{
        line-height: 35px
    }
    h2{
        color: white;
        font-size: 2em;
        text-align: center;
        margin-bottom: 10px
    }
    p{
        color: white;
        font-size: 18px;
        text-align: center;
    }
    </style>
</head>
<body>
    <div class='background'>
    <div class='box'>
        <div class='top'>
            <h1>PlayPal </h1><img src='https://playpal3.000webhostapp.com/img/PlayPal%20Logo%20design/PlayPal%20final%20logo%201%20in%20PSD%20HQ.png'>
        </div>
        <div class='info-body'>
            <h2>Game Reminder!</h2>
            <p>
                You have a soccer game coming up on $gameDay at  $gameHour.  <br>
                The address is  $gameAddress <br>
                You can find more details <a href='https://playpal3.000webhostapp.com/game.php?gameId=$gameid'>here!</a>
            </p>
        </div>
    </div>
    </div>
</body>
</html>
";
}
