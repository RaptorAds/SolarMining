$(document).ready(function () {

  $("#submitForgot").click(function () {

    var email = $("#myusername").val();

    if ((email == "")) {

        $("#messageSignIn").fadeOut(0, function (){
            $(this).html("<div class=\"alert alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Please enter a username or email</div>").fadeIn();
        });
    }
    else {
      $.ajax({
        type: "POST",
        url: "/login/ajax/sendresetemail.php",
        data: "email=" + email,
        dataType: "JSON",
        success: function (json) {

        if(json.status == 1){

            $("#messageSignIn").fadeOut(0, function (){
                $(this).html("<div class=\"alert alert-success\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>"+json.response+"</div>").fadeIn();
            });
            $('#submitbtn').hide();

        } else {
            $("#messageSignIn").fadeOut(0, function (){
                $(this).html("<div class=\"alert alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>"+json.response+"</div>").fadeIn();
            });
        }
        },
        beforeSend: function () {

        $("#messageSignIn").fadeOut(0, function (){
          $(this).html("<p class='text-center'><img src='/login/images/ajax-loader.gif'></p>").fadeIn();
        })

        }
      });
    }
    return false;
  });
});
