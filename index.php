<?php
    include "include/header.php";
    include "include/register.php";
 ?>
 <div class="wrapper">
    <div class="box index-main box-style" id="main">
        <h2>Play pick-up soccer in KC, for FREE</h2>

        <h3>Find the games and players</h3>
        <h3>YOU are looking for.</h3>
        <h3> And help them find you.</h3>
        <div class="btn-container">
            <a href="gameboard.php" class="button is-medium is-primary">Game Boards</a><a class="button is-medium is-primary" id="signupBtn">Sign-Up</a>
        </div>
    </div>
    <div class="box box-style" id="signup">
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
 <?php
 include "include/footer.php";
  ?>
