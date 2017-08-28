<?php
    include "include/header.php";
    if(isset($_POST['login'])){
    include "include/db.php";
    include "include/register.php";
    include "include/hostname.php";


    $email = $_POST['email'];
    $password = $_POST['pass'];



    $query = "SELECT * FROM users WHERE email = '$email'";
    $users = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($users);
    $hash_pwd = $user['password'];
    $pwd = password_verify($password, $hash_pwd);



    if(!$user){
        $login_error = "Username/Password incorrect";
    }else{
        if ($pwd) {
            $_SESSION["first"] = $user['first'];
            $_SESSION["last"] = $user['last'];
            $_SESSION["uid"] = $user['uid'];
            $_SESSION['rsvps'] = array();
            echo $user['uid'];
            $query = "SELECT * FROM players WHERE uid = '{$user["uid"]}'";
            $games = mysqli_query($conn, $query);
            while($game = mysqli_fetch_assoc($games)){
                array_push($_SESSION['rsvps'], $game['gameid']);
            }

            echo "<script type='text/javascript'>
                window.location.href =\"$hostname/gameboard.php\";
            </script>";
        }else{
            $login_error = "Username/Password incorrect";
        }
    }
}
 ?>
<div class="wrapper">
    <div class="box" id="main">
        <h1 class="title is-2">Login</h1>
        <form action="login.php" method="post">

            <div class="row">
                <div class="sec">
                    <p><?php if(isset($login_error)){echo $login_error;} else{?>Email<?php }?></p>
                    <input type="email" class="input" name="email">
                </div>
                <div class="sec">
                    <p><?php if(isset($login_error)){echo "!";} else{?>Password<?php }?></p>
                    <input type="password" class="input" name="pass">
                </div>
            </div>
            <div class="btn-row">
                <button class="button is-primary" id="submit" type="submit" name="login">login</button>
                <button type="button" id="signupBtn" class="button">Sign up</button>
            </div>
        </form>
    </div>

    <div class="box" id="signup">
        <h2 class="title">Sign-up</h2>
        <form class="" action="index.php" method="post">
            <input type="hidden" id="emailError" name="error" value="<?php if(isset($email_error) && $email_error) {echo "true";}   ?>">
            <div class="row">
                <div class="sec">

                    <p>Email<?php if(isset($email_error) && $email_error) { echo " is taken";}   ?></p>

                    <input type="email" name="email" class="input" required>
                </div>
                <div class="sec">
                    <p>Password</p>
                    <input type="password" name="pass" class="input" required>
                </div>
            </div>
            <div class="row">
                <div class="sec">
                    <p>First Name</p>
                    <input type="text" name="first" class="input" required <?php if(isset($email_error) && $email_error) { echo "value='{$first}'";}   ?>>
                </div>
                <div class="sec">
                    <p>Last Name</p>
                    <input type="text" name="last" class="input" required <?php if(isset($email_error) && $email_error) { echo "value='{$last}'";}   ?>>
                </div>
            </div>
            <div class="btn-row">
                <button class="button is-primary" id="submit" type="submit" name="submit">register</button>
                <button class="button" id="cancelRegister" type="reset">cancel</button>
            </div>
        </form>
    </div>
</div>
<?php include "include/footer.php"; ?>
