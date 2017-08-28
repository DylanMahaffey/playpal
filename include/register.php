<?php
if(isset($_POST['submit'])){
include "db.php";
include "hostname.php";

$password = $_POST['pass'];
$encrypted_pwd = password_hash($password, PASSWORD_DEFAULT);
$email = $_POST['email'];
$first = $_POST['first'];
$last = $_POST['last'];
$register_ok=false;
$email_error = false;

$query = "SELECT * FROM users WHERE email = '{$email}'";
$users = mysqli_query($conn, $query);

if($user = mysqli_fetch_assoc($users)){
    $email_error=true;
} else {
    $register_ok=true;
}

if($register_ok){
    $query = "INSERT INTO users (email, password, first, last)
                    VALUES ('{$email}', '{$encrypted_pwd}', '{$first}', '{$last}')";

    $result = mysqli_query($conn, $query);
    if($result){
        $query = "SELECT * FROM users WHERE email = '$email'";
        $users = mysqli_query($conn, $query);
        $user = mysqli_fetch_assoc($users);
        $_SESSION["first"] = $user['first'];
        $_SESSION["last"] = $user['last'];
        $_SESSION["uid"] = $user['uid'];
        $_SESSION['rsvps'] = array();

        echo "<script type='text/javascript'>
            window.location.href =\"$hostname/gameboard.php\";
        </script>";
    } else {
        die("database query failed. " . mysqli_error($conn));
    }
}

}
