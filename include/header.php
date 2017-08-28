<?php
    session_start();

    if(isset($_GET['logout'])&&$_GET['logout']=="true"){
        session_unset();
        session_destroy();
    }

    $cssFileName = basename($_SERVER['PHP_SELF']);
    $cssFileName = substr($cssFileName, 0, -4);

    $with = basename($_SERVER['REQUEST_URI']);
    $without = basename($_SERVER['PHP_SELF']);
    if($with == $without){
        $final = basename($_SERVER['PHP_SELF'])."?";
    }else{
        $final = basename($_SERVER['REQUEST_URI'])."&";
    }

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="css/bulma-0.5.0/bulma-0.5.0/css/bulma.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/<?= $cssFileName?>.css">
    <link rel="stylesheet" href="css/mobile.css">

    <script src="http://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>


    <title>PlayPal</title>
</head>
<body class="<?php if($_SERVER['PHP_SELF']=='/playpal/gameboard.php'||$_SERVER['PHP_SELF']=='/playpal/game.php'){ echo "bodyheight-auto";}?> <?php if($_SERVER['PHP_SELF']=='/playpal/game.php'){ echo "gameheight-auto";}?>">
    <script>document.write('<script src="http://' + (location.host || 'localhost').split(':')[0] + ':35729/livereload.js?snipver=1"></' + 'script>')</script>
    <script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '391105127975808',
      xfbml      : true,
      version    : 'v2.10'
    });
    FB.AppEvents.logPageView();
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>
    <header class="<?php if($_SERVER['PHP_SELF']=='/playpal/index.php'){ echo "hidden";}?>">
        <div class="mobile">
            <img src="img/icon2.png" alt="" id="mobileMenu">

        </div>
        <div id="dropdown">
            <a href="index.php"><div class="dropdown-option">Home</div></a>
            <?php if(isset($_SESSION['first'])) {?>
                <a href="gameboard.php"><div class="dropdown-option">Game Boards</div></a>
                <a href="<?= $final?>logout=true"><div class="dropdown-option">Log out</div></a>
            <?php }else{ ?>
                <a href="gameboard.php"><div class="dropdown-option">Game Boards</div></a>
                <a href="login.php"><div class="dropdown-option">Login</div></a>
            <?php } ?>
        </div>
        <a href="index.php" id="playpal"><div class="playpal"><img src="img\PlayPal Logo design\final-version-of-logo-white-in.png" class="playpal-logo"><h1><span class="bau">PLAY</span><span class="goth">pal</span></h1></div></a>
        <nav>
            <ul>
            <?php if(isset($_SESSION['first'])) {?>
                <li class="username" id="username"><?= $_SESSION['first']." ".$_SESSION['last']?></li>
                <a href="gameboard.php"><li>Game Boards</li></a>
                <a href="<?= $final?>logout=true"><li>Log out</li></a>
            <?php }else{ ?>
                <a href="gameboard.php"><li>Game Boards</li></a>
                <a href="login.php"><li>Login</li></a>
            <?php } ?>

            </ul>
        </nav>

    </header>
