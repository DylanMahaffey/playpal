// /////////////////////////////////////////////////////////////////////// //
//                                  tweet                                      //
// /////////////////////////////////////////////////////////////////////// //
function tweetTweet(){
    var url="https://twitter.com/intent/tweet";
    var text="Soccer Game "+$("#dayTime").val()+", check it out!";
    var link = $("#link").val();
    var via="userName";
    window.open(url+"?text="+text+"&url="+link+";width=500,height=300");
}

// /////////////////////////////////////////////////////////////////////// //
//                                 share                                       //
// /////////////////////////////////////////////////////////////////////// //

function copyToClipboard(element) {
  var $temp = $("<input>");
  $("body").append($temp);
  $temp.val($(element).val()).select();
  document.execCommand("copy");
  $temp.remove();
  $("#conf").fadeIn("fast", function(){
      setTimeout(function(){$("#conf").fadeOut( "slow" );}, 1500);
  });

}

// /////////////////////////////////////////////////////////////////////// //
//                               facebook                                   //
// /////////////////////////////////////////////////////////////////////// //
