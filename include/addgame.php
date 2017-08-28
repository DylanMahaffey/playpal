<?php
session_start();
  if(isset($_POST['submit'])){
 include "db.php";
 include "hostname.php";

$host = $_SESSION['first']." ".$_SESSION['last'];

$day = $_POST['day'];
$realDay = date("d");
$month = $_POST['month'];
$realMonth =  date("m");
$time = $_POST['hour'].":".$_POST['minute']." ".$_POST['ampm'];
$gender = $_POST['gender'];
$intensity = $_POST['level'];
$size = $_POST['size'];
$playerCount = 1;
$colors = $_POST['colors'];
$colors2 = $_POST['colors2'];
$details = $_POST['details'];
$address = $_POST['address'];
$lat = $_POST['lat'];
$lng = $_POST['lng'];
if($_POST['ampm'] == "am"){
    $realHour = $_POST['hour'];
}else if($_POST['ampm'] == "pm"){
$realHour = $_POST['hour']+12;
}

if($day - $realDay==0){
    $monthCheck = $month;
}else{
    $monthCheck = $month-1;
}
if($monthCheck - $realMonth >=0){
    $year = date("Y");
}else{
    $year = date("Y")+1;
}
$realDate = $day."-".$month."-".$year." ".$realHour.":".$_POST['minute'].":00";
$realDate = date("Y-m-d H:i:s", strtotime($realDate));


$longMonth="";
if($month == 1){
    $longMonth = "January";
} else if($month == 2){
    $longMonth = "February";
} else if($month == 3){
    $longMonth = "March";
} else if($month == 4){
    $longMonth = "April";
} else if($month == 5){
    $longMonth = "May";
} else if($month == 6){
    $longMonth = "June";
} else if($month == 7){
    $longMonth = "July";
} else if($month == 8){
    $longMonth = "August";
} else if($month == 9){
    $longMonth = "September";
} else if($month == 10){
    $longMonth = "October";
} else if($month == 11){
    $longMonth = "November";
} else if($month == 12){
    $longMonth = "December";
}

$date = $longMonth." ".$day.", ".$year;



  $query =
  "INSERT INTO games
  (hostname, day, hour, realDate, gender, intensity, size, playerCount, colors, colors2, details, address, lat, lng)
  VALUES
  ('{$host}','{$date}','{$time}','{$realDate}', '{$gender}', '{$intensity}', '{$size}', '{$playerCount}', '{$colors}', '{$colors2}', '{$details}', '{$address}', '{$lat}','{$lng}')";


$name = $_SESSION['first']." ".$_SESSION['last'];
$uid = $_SESSION['uid'];
$result = mysqli_query($conn, $query);
$gameId = $conn->insert_id;

$player_query = "INSERT INTO players(gameid, uid, name)
                              VALUES($gameId, $uid, '{$name}')";
$player_result = mysqli_query($conn, $player_query);

if($result && $player_result){
    array_push($_SESSION['rsvps'], $gameId);
    include "email.php";
    echo "<script type='text/javascript'>
        window.location.href =\"$hostname/game.php?gameId=$gameId\";
    </script>";
} else {
    die("database query failed. " . mysqli_error($conn));
}

}

?>
