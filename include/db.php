<?php
date_default_timezone_set('America/Los_Angeles');
// date_default_timezone_set('America/Chicago');
$conn = mysqli_connect("localhost", "root", "qpalz,", "playpal");
// localhost:3306
if(mysqli_connect_errno()){
     $conn = mysqli_connect("localhost", "id2595222_root", "qpalz,123", "id2595222_playpal");
}

if(mysqli_connect_errno()){
     die("database connection failed: ". mysqli_connect_error().
    "(".mysqli_connect_errno().")");
}else{

}
