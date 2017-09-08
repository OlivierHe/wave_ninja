/**
 *  * Created by Olivier Herzog on 07/08/2017.
 */
$(document).ready(function() {
    function login_check() {
        if (typeof $("#identifiant.validate.valid").val() === "undefined") {
            Materialize.toast('Identifiant non valide !', 3000, 'rounded red');
            return;
        }
        if (typeof $("#password.validate.valid").val() === "undefined") {
            Materialize.toast('Mot de passe non valide !', 3000, 'rounded red');
            return;
        }

        $.post("http://"+$http_host+"/blog_ecrivain/login_check/666",
            {
                identifiant: $("#identifiant").val(),
                password: $("#password").val(),
               // ip_addr: $("#ip_addr").val()
            },
            function (data) {
                Materialize.toast(data.content, 3000, data.params);

                setTimeout(function(){
                    $(location).attr('href', 'http://'+$http_host+'/blog_ecrivain/home');
                }, 1000);
            },
            "json"
        );
    }

    $("#login").click(function () {
        login_check();
    });


});