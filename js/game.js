window.onload = function(){
    var hostname = $("#hostname").val();
    var day = $("#day").val();
    var hour = $("#hour").val();
    var address = $("#address").val();
    var uid = $("#uid").val();
    var gameId = getUrlParameter('gameId');
    console.log(day+hour+address+uid);
    console.log("test");
    list_chats();
    function list_chats(){
        var url = hostname+"/include/chat.php?t="+Math.random()+"&gameId="+gameId;
        $.ajax({
       url: url,
       success: function(data) {
           if(data !==$('#viewChats').html()){
               $('#viewChats').html(data);
               $("#viewChats").animate({ scrollTop: $('#viewChats').prop("scrollHeight")}, 1000);
           }

       }
    });
        setTimeout(list_chats, 1000);
    }

    var form = $("#search_form");
    form.submit(function(event){
        event.preventDefault();
        var chat = $("#chat").val();
        console.log(chat);

        $.post(hostname+'/include/sendChat.php', {chat: chat, gameId: gameId},function(data){
            console.log(data);
            $("#results").html(data);
        });
        $("#chat").val("");
    });

    var clicked=false;

    if($("#rsvpCheck").val()){
        $("#rsvpBtn").html('RSVP\'d!');
        $("#rsvpBtn").off('click');
    }else{
        $("#rsvpBtn").click(function(){
            $.post(hostname+'/include/rsvp.php', {gameId: gameId},function(data){
                if(data == "success"){
                    $("#rsvpBtn").html('RSVP\'d!');
                    $("#rsvpBtn").off('click');
                    $.post(hostname+'/include/email.php', {gameid: gameId, uid: uid, day: day, hour: hour, address: address},function(data){
                        console.log("email sent");
                    });
                }
            });


        });
    }

    get_players();
    function get_players(){
        var url = hostname+"/include/getplayers.php?t="+Math.random()+"&gameId="+gameId;
        $.ajax({
       url: url,
       success: function(data) {
           if(data !==$('#playersBox').html()){
               $('#playersBox').html(data);
           }

       }
    });

        setTimeout(get_players, 1000);
    }

    game_update();
    function game_update(){
        var url = hostname+"/include/gameUpdate.php?t="+Math.random()+"&gameId="+gameId;
        $.ajax({
       url: url,
       success: function(data) {
           var size = JSON.parse(data)[0].size;
           var playerCount = JSON.parse(data)[0].playerCount;
           var openings = size - playerCount;
           if($("#count").html()!=openings){
               $("#count").html(openings);
           }

           if(openings === 0){
               $("#rsvpBtn").html('Game is Full');
               $("#rsvpBtn").off('click');
               $("#plural").html('s');
               $("#count").html("0 ");
           }
           if(openings === 1){
               $("#plural").html('');
           }
       }
    });
        setTimeout(game_update, 5000);
    }
};

var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
};


// /////////////////////////////////////////////////////////////////////// //
//                                google map                              //          API:  AIzaSyCsBiIrBz4y8tB8DGwqzIIta1TyEW90Xcw
// /////////////////////////////////////////////////////////////////////// //

    var lat = parseFloat($("#lat").val());
    var lng = parseFloat($("#lng").val());
    // console.log("lat: "+lat);
    // console.log("lng: "+lng);

      function initMap() {
              var uluru = {lat: lat, lng: lng};
            //   console.log(uluru);
              var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 16,
                center: uluru
              });
              var marker = new google.maps.Marker({
                position: uluru,
                map: map
              });
            }
