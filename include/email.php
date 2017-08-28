<?php
if(isset($_POST['gameid'])){
    include "db.php";
    $playerid = $_POST['uid'];
    $gameDay = $_POST['day'];
    $gameHour = $_POST['hour'];
    $gameAddress = $_POST['address'];
    $gameid = $_POST['gameid'];
}else{
    $playerid = $uid;
    $gameDay = $date;
    $gameHour = $time;
    $gameAddress = $_POST['address'];
    $gameid = $gameId;
}

$sql = "SELECT * FROM users WHERE uid='$playerid' limit 1";
$result = mysqli_query($conn, $sql);
if ($result) {
    $userinfo = mysqli_fetch_assoc($result);
    $sendto = $userinfo['email'];

    $to = "$sendto";
    $subject = "PlayPal Soccer Game Reminder";

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
                <h1>PlayPal </h1><img src='https://playpal3.000webhostapp.com/img/PlayPal%20Logo%20design/final-version-of-logo-white-in.png'>
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

    // Always set content-type when sending HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

    // More headers
    $headers .= 'From: <PlayPal@playpals.com>' . "\r\n";

    mail($to,$subject,$message,$headers);
}
