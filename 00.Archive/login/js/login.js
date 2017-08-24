$(document).ready(function () {
    "use strict";
    $("#submitLogin").click(function () {

        var username = $("#myusername").val(), password = $("#mypassword").val();

        if ((username === "") || (password === "")) {
            $("#messageSignIn").html("<div class=\"alert alert-danger alert-dismissable\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Please enter a username and a password</div>");
        } else {
            $.ajax({
                type: "POST",
                url: "./login/checklogin.php",
                data: "myusername=" + username + "&mypassword=" + password,
                dataType: 'JSON',
                success: function (html) {
                    //console.log(html.response + ' ' + html.username);
                    if (html.response === 'true') {
                        //location.assign("../index.php");
                       location.reload();
                        return html.username;
                    } else {
                        $("#messageSignIn").html(html.response);
                    }
                },
                error: function (textStatus, errorThrown) {
                    console.log(textStatus);
                    console.log(errorThrown);
                },
                beforeSend: function () {
                    $("#messageSignIn").html("<p class='text-center'><img src='./login/images/ajax-loader.gif'></p>");
                }
            });
        }
        return false;
    });
});
