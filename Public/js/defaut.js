/**
 *  * Created by Olivier Herzog on 09/08/2017.
 */
$(document).ready(function() {
    $(".button-collapse").sideNav({
        closeOnClick: true
    });

    $(".dropdown-button").dropdown({
        hover : true,
        constrainWidth : false,
        belowOrigin : true
    });

    $('#logout').click(function () {
        console.log('logout clicked');
        $.get("http://"+$http_host+"/blog_ecrivain/login_out",
            function (data) {
                Materialize.toast(data.content, 3000, data.params);

                setTimeout(function () {
                    $(location).attr('href', 'http://'+$http_host+'/blog_ecrivain/home');
                }, 1000);
            },
            "json"
        );
    });
});