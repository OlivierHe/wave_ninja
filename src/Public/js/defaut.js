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
});
