var hostname = $("#hostname").val();
window.onload = function(){

    games_populate();

    function games_populate(){
        var url = hostname+"/include/getgames.php?t="+Math.random();
        console.log(url);
        $.ajax({
       url: url,
       success: function(data) {
           if(data !==$('#gameBox').html()){
               $('#gameBox').html(data);
           }

       }
    });

        setTimeout(games_populate, 5000);
    }
};


// /////////////////////////////////////////////////////////////////////// //
//                                  form                                       //
// /////////////////////////////////////////////////////////////////////// //


var form = $("#add-form");
form.submit(function(event){
    var sendOk = true;
    event.preventDefault();
    var month = $("#month").val();
    var day = $("#day").val();
    var hour = $("#hour").val();
    var min = $("#min").val();
    var ampm = $("#ampm").val();
    var gender = $('input[name=gender]:checked', form).val();
    var intensity = $('input[name=level]:checked', form).val();
    var address = $("#address").val();
    var lat = $("#lat").val();
    var lng = $("#lng").val();
    var size = $("#size").val();
    var color1 = $("#color1").val();
    var color2 = $("#color2").val();
    var details = $("#details").val();
    if(min===undefined){
        min = "00";
    }
    if(details===""){
        details = "none";
    }
    if(gender===undefined){
        $("#genderTitle").addClass("red");
        sendOk = false;
    }else{
        $("#genderTitle").removeClass("red");
    }
    if(intensity===undefined){
        $("#intensityTitle").addClass("red");
        sendOk = false;
    }else{
        $("#intensityTitle").removeClass("red");
    }
    if(size===""){
        $("#openingsTitle").addClass("red");
        $("#size").addClass("is-danger");
        sendOk = false;
    }else{
        $("#openingsTitle").removeClass("red");
        $("#size").removeClass("is-danger");
    }
    if(color1===""||color2===""){
        if(color1===""){
            $("#color1").addClass("is-danger");
        }else{
            $("#color1").removeClass("is-danger");
        }
        if(color2===""){
            $("#color2").addClass("is-danger");
        }else{
            $("#color2").removeClass("is-danger");
        }
        $("#colorsTitle").addClass("red");
        sendOk = false;
    }else{
        $("#colorsTitle").removeClass("red");
    }
    if(address===""||lat===""||lng===""){
        $("#locationBtn").addClass("is-danger");
        sendOk = false;
    }else{
        $("#locationBtn").removeClass("is-danger");
    }

    if(sendOk){
        console.log("sent");
        $.post(hostname+'/include/addgame.php', {month: month, day: day, hour: hour, minute: min, ampm: ampm, gender: gender, level: intensity,address: address,lat: lat,lng: lng,size: size,colors: color1,colors2: color2,details: details, submit:"submit"},function(data){
            console.log(data);
            $("#results").html(data);
        });
        
    }else{
        $("#modal").css("display","flex");
        $("#fieldsCheck").show();
    }



});

// /////////////////////////////////////////////////////////////////////// //
//                                location                                    //
// /////////////////////////////////////////////////////////////////////// //
var saveLat;
var saveLng;
var saveAddress;
var testVar;
function latlngMarker (lat, lng){
    this.lat = lat;
    this.lng=lng;
}

$("#locationBtn").click(function(){

    $("#modal").css("display","none");

    $("#gameBox").hide();
    $("#open").hide();

    $("#locationMain").show();
    $("#pac-input").show();
    $("#locationSave").show();

    $("#pac-input").focus();
});
$("#locationSave").click(function(){

    $("#modal").css("display","flex");


    $("#gameBox").show();
    $("#open").show();
    $("#locationMain").hide();
    $("#pac-input").hide();
    $("#locationSave").hide();

    saveLocation();

});

function saveLocation(){
    $("#lat").val(saveLat);
    $("#lng").val(saveLng);
    $("#address").val(saveAddress);
    if(saveLat!==null&&saveLng!==null&&saveAddress!==null){
        $("#locationBtn").html("Location Saved!") ;
        $("#locationBtn").addClass("is-success");
        $("#locationBtn").removeClass("is-primary");
        $("#locationBtn").removeClass("is-danger");
    }
}

var allLocations = [];

// /////////////////////////////////////////////////////////////////////// //
//                          Google map logic                          //
// /////////////////////////////////////////////////////////////////////// //


function initAutocomplete() {
  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 9,
    mapTypeId: 'roadmap'
  });

var bounds  = new google.maps.LatLngBounds();
var loc;
var markers = [];

allGames();

$("#locationSave").click(function(){
    var arr = [];
    markers.forEach(function(marker) {
      marker.setMap(map);
    });
});

$("#locationBtn").click(function(){
    markers.forEach(function(marker) {

      bounds.extend(marker);
      map.fitBounds(bounds);
      map.panToBounds(bounds);
      map.setZoom(9);
    });

    navigator.geolocation.getCurrentPosition(function(position) {
        loc = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
        map.setZoom(9);
        bounds.extend(loc);
        map.fitBounds(bounds);
        map.panTo(loc);
    });
});

function allGames(){
    var url =  hostname+"/include/getlatlng.php?t="+Math.random();
    console.log(url);
    $.ajax({
    url: url,
    success: function(data) {
        console.log(data.length);
       JSON.parse(data).forEach(function(val){
               loc = new google.maps.LatLng(parseFloat(val.lat), parseFloat(val.lng));
               addMarker(loc);
               bounds.extend(loc);
               map.fitBounds(bounds);
               map.panToBounds(bounds);
           });
           if(data.length === 2){
               loc =new google.maps.LatLng(39.098878, -94.594917);

               bounds.extend(loc);
               map.fitBounds(bounds);
               map.panTo(loc);
               map.setZoom(9);
           }
        }
    });
}



function addMarker(location) {
        var marker = new google.maps.Marker({
          position: location,
          zoom: 9,
          map: map
        });
        markers.push(marker);
      }

  // Create the search box and link it to the UI element.
  var input = document.getElementById('pac-input');
  var searchBox = new google.maps.places.SearchBox(input);
  map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

  // Bias the SearchBox results towards current map's viewport.
  map.addListener('bounds_changed', function() {
    searchBox.setBounds(map.getBounds());
  });

  // Listen for the event fired when the user selects a prediction and retrieve
  // more details for that place.
  searchBox.addListener('places_changed', function() {
    var places = searchBox.getPlaces();

    // bounds.extend(places);
    // map.fitBounds(bounds);
    // map.panToBounds(bounds);

    if (places.length === 0) {
      return;
    }
    // Clear out the old markers.
    markers.forEach(function(marker) {
      marker.setMap(null);
    });

    // For each place, get the icon, name and location.
    places.forEach(function(place) {



      if (!place.geometry) {
        console.log("Returned place contains no geometry");
        return;
      }


      // Create a marker for each place.
      markers.push(new google.maps.Marker({
        map: map,
        zoom: 9,
        title: place.name,
        position: place.geometry.location
      }));

      map.addListener('click', function(event) {
          addMarker(event.latLng);
        });


      saveAddress = place.formatted_address;
      saveLat = place.geometry.location.lat();
      saveLng = place.geometry.location.lng();

      if (place.geometry.viewport) {
        // Only geocodes have viewport.
        bounds.union(place.geometry.viewport);
      } else {
        bounds.extend(place.geometry.location);
      }
      map.setZoom(17);
      map.fitBounds(bounds);
    });

  });

}
