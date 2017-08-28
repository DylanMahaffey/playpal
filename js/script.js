// /////////////////////////////////////////////////////////////////////// //
//                                   signup                                   //                http://dylanmahaffey.000webhostapp.com
// /////////////////////////////////////////////////////////////////////// //
$(function(){
    $("#signupBtn").click(function(){
        $("#main").css("display","none");
        $("#signup").css("display","flex");
    });
    $("#cancelRegister").click(function(){
        $("#main").css("display","flex");
        $("#signup").css("display","none");
    });
    if($("#emailError").val() == "true"){
        $("#main").css("display","none");
        $("#signup").css("display","flex");
    }

});
// /////////////////////////////////////////////////////////////////////// //
//                                    modal                                   //
// /////////////////////////////////////////////////////////////////////// //

$(function(){
    $("#open").click(function(){
        $("#modal").css("display","flex");
    });
    $("#cancel").click(function(){
        $("#modal").css("display","none");
    });
    $("#submit").click(function(){
        $("#modal").css("display","none");
    });
});

// /////////////////////////////////////////////////////////////////////// //
//                                    tabs                                      //
// /////////////////////////////////////////////////////////////////////// //
$(function(){
    $("#details").click(function(){
        $("#detailsContent").show();
        $("#playersContent").hide();
    });
    $("#players").click(function(){
        $("#detailsContent").hide();
        $("#playersContent").show();
    });
});

// /////////////////////////////////////////////////////////////////////// //
//                                   mobile                                   //
// /////////////////////////////////////////////////////////////////////// //

$("#mobileMenu").click(function(){
    $(".dropdown-option").toggle(function(){
        $(this).animate({height:'0'});
      },function(){
        $(this).animate({height:'auto'});
    });
});
