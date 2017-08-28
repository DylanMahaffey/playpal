<?php
    include "include/header.php";
    include "include/gameinfo.php";
    include "include/hostname.php";

    $message = "
    <html><head><title>Document</title><style>*{margin:0;padding:0;}.background{width: auto;background-image:url('https://playpal3.000webhostapp.com/img/goal.jpg');background-positioncenter;background-sizecover;border-radius10px;}.box{backgroundrgba(0, 196, 167, 0.8);border-radius10px;padding30px 50px;}.top{display:table;margin:0 auto;margin-bottom:30px;}h1{color:white;font-size:3em;margin-right:20px;display:inline;margin:20px;}img{width:100px !impotant;display:inline-block;}.info-body{line-height:35p}h2{color:white;font-size:2em;text-align:center;margin-bottom:10px}p{color:white;font-size:18px;text-align:center;}</style></head><body><div class='background'><div class='box'><div class='top'><h1>PlayPal </h1><img src='https://playpal3.000webhostapp.com/img/PlayPal%20Logo%20design/final-version-of-logo-white-in.png'></div><div class='info-body'><h2>Game Reminder!</h2><p>You have a soccer game coming up on $gameDay at  $gameHour. <br>The address is  $gameAddress <br>You can find more details <a href='https://playpal3.000webhostapp.com/game.php?gameId=$gameid'>here!</a></p></div></div></div></body></html>";

    $message = urlencode ($message);

    $rsvp = false;
    if(isset($_SESSION['uid']) ){
        foreach ($_SESSION['rsvps'] as $val) {
            if($val==$_GET['gameId']){
                $rsvp = true;
            }
        }
   }
 ?>
  <input type="hidden" value="<?= $hostname?>" id="hostname">
 <div class="top">
     <?php if(isset($_SESSION['uid']) ){ ?>
     <a class="button is-large" id="rsvpBtn">RSVP for game</a>
     <?php } ?>
</div>
 <input type="hidden" id="rsvpCheck" value="<?= $rsvp?>">
 <main class="main-game <?php if(!isset($_SESSION['uid'])){echo "mar-top";}?>">
     <div class="box box-style">
         <div class="tabs">
             <ul>
                 <li id="details">Game Details</li>
                 <li id="players">Players</li>
             </ul>
         </div>
         <div id="detailsContent">
             <h2 class="title">Game Details</h2>
              <div class="det-row"><p class="det-key">Host:</p><p class="det-val"><?= $game['hostname']?></p></div>
             <div class="det-row"><p class="det-key">Date:</p><p class="det-val"><?= $game['day']?></p></div>
             <div class="det-row"><p class="det-key">Time:</p><p class="det-val"><?= $game['hour']?></p></div>
             <div class="det-row"><p class="det-key">Address:</p><p class="det-val"><?= $game['address']?></p></div>
             <div class="det-row"><p class="det-key">Gender:</p><p class="det-val"><?= $gender?></p></div>
             <div class="det-row"><p class="det-key">Intensity:</p><p class="det-val"><?= $level?></p></div>
             <div class="det-row"><p class="det-key"># of Players:</p><p class="det-val"><?= $game['size']?></p></div>
             <div class="det-row"><p class="det-key">Shirt Colors:</p><p class="det-val"><?= $game['colors']?> vs. <?= $game['colors2']?></p></div>
             <div class="det-row"><p class="det-key">Misc. Details: </p><p class="det-val"><?= $game['details']?></p></div>
         </div>
         <div id="playersContent">
             <h2 class="title"> <span id="count"></span> Opening<span id="plural">s</span> Available</h2>
             <div class="player-box" id="playersBox">
                 <div class="container"><div class="loader"></div> </div>
             </div>

         </div>
     </div>
     <div class="box box-style message-board">
         <div class="message-title"><h3>Message Board</h3></div>
        <div class ="message-window" id="viewChats">
            <div class="container"><div class="loader"></div> </div>
        </div>
        <?php if(isset($_SESSION['uid'])){ ?>
        <div class="message-write">
            <form action="include/sendChat.php" method="post" id="search_form">
                <input  class="input" type="text" name="chat" id="chat">
                <button class="button is-primary" id="chatBtn" type="submit">send</button>
            </form>
        </div>
    <?php } ?>

     </div>
     <div class="box box-style" id="map"></div>
 </main>

 <div class="icons">
     <div class="conf-box"><div class="share">Invite your friends to play!</div></div>
     <div class="conf-box"><div class="confirm" id="conf">Link copied to clipboard!</div></div>
     <img src="img/share.png" alt="" id="share" onclick="copyToClipboard('#link')">
     <img src="img/fb.png" alt="" id="fb">
     <img src="img/twitter.png" alt="" id="tweet" onclick="tweetTweet()">
     <a href="mailto:?body=<?= $message?>"><img src="img/email.png" alt="" id="email"></a>
 </div>

<input type="hidden" id="lat" value=" <?= $game['lat']?>"><input type="hidden" id="lng" value=" <?= $game['lng']?>">
<input type="hidden" id="dayTime" value="<?= $game['day']?> at <?= $game['hour']?>">
<input type="hidden" id="day" value="<?= $game['day']?>">
<input type="hidden" id="hour" value="<?= $game['hour']?>">
<input type="hidden" id="address" value="<?= $game['address']?>">
<input type="hidden" id="uid" value="<?= $_SESSION['uid']?>">
<input type="hidden" id="link" value="<?php echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>">

<script type="text/javascript" src="js/game.js"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCsUAWUqSMfwGjlJkxgr-yqeUOTD3GA51A&callback=initMap"
 type="text/javascript"></script>
 <?php
     include "include/footer.php";
  ?>
