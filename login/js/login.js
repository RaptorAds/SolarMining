$(document).ready(function () {
    "use strict";
    $("#submitLogin").click(function () {

        var username = $("#myusername").val(), password = $("#mypassword").val();

        if ($("#remember").is(":checked")){
            var remember = 1;
        } else {
            var remember = 0;
        }

        if ((username === "") || (password === "")) {
          $("#messageSignIn").fadeOut(0, function (){
            $(this).html("<div class=\"alert alert-danger alert-dismissable\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Please enter a username and a password</div>").fadeIn();
        });

        } else {
            $.ajax({
                type: "POST",
                url: "../login/ajax/checklogin.php",
                data: "myusername=" + username + "&mypassword=" + password + "&remember=" + remember,
                dataType: 'JSON',
                success: function (html) {

                    if (html.response === 'true') {
                       location.reload();
                        return html.username;
                    } else {
                        $("#messageSignIn").fadeOut(0, function (){
                            $(this).html(html.response).fadeIn();
                        })
                    }
                },
                error: function (textStatus, errorThrown) {
                    console.log(textStatus);
                    console.log(errorThrown);
                    $("#messageSignIn").fadeOut(0, function (){
                        $(this).html("<div class='alert alert-danger'>" + textStatus.responseText + "</div>").fadeIn();
                    })
                },
                beforeSend: function () {
                    $("#messageSignIn").fadeOut(0, function (){
                        $(this).html("<p class='text-center'><img src='../login/images/ajax-loader.gif'></p>").fadeIn();
                    })
                }
            });
        }
        return false;
    });
});
