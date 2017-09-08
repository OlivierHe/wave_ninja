/**
 * Created by MiniTarlouf on 07/08/2017.
 */

$(document).ready(function(){
    $uri = $(location).attr('pathname');
    $re = /([a-z_]+)(?:\/)([0-9]+)$/mg;
    $idPost = $re.exec($uri)[2];
    $insCom = '<div id="insert_comments">'
        +'<div class="card-panel">'
        +'<div class="input-field">'
        +'<input id="sous_com" type="hidden" value="0">'
        +'</div>'
        +'<div class="row">'
        +'<div class="input-field col l6 m6 s12">'
        +'<input id="pseudo" type="text" class="validate">'
        +'<label for="pseudo">Pseudonyme</label>'
        +'</div>'
        +'<div class="input-field col l6 m6 s12">'
        +'<input id="email" type="email" class="validate">'
        +'<label for="email" data-error="valeur erronée">Courriel</label>'
        +'</div>'
        +'</div>'
        +'<div class="row">'
        +'<div class="input-field col s12">'
        +'<textarea id="comment" class="materialize-textarea validate" ></textarea>'
        +'<label for="comment">Commentaire</label>'
        +'</div>'
        +'</div class="col">'
        +'<a class="waves-effect waves-light teal btn" id="send_com"><i class="material-icons left">message</i>Ajouter un commentaire</a>'
        +'</div>'
        +'</div>'
        +'</div>'
        +'</div>';



    function append(elem){
        $id = $(elem).attr("data-id");
        if (!$("#insert_comments").length) {
            $($insCom).appendTo($('#'+$id));
            $("#sous_com").val($id);
        }
    }

    function view_com() {
        $.get("http://"+$http_host+"/blog_ecrivain/view_comment/" + $idPost,
            function (data) {
                $( ".comments" ).html( data ).hide().fadeIn("slow");
                $('.tooltipped').tooltip({delay: 50});
            });
    }

    function insert_com() {

        if (typeof $("#comment.validate.valid").val() === "undefined") {
            Materialize.toast('Vous devez remplir un message !', 3000, 'rounded red');
            return;
        }
        if (typeof $("#pseudo.validate.valid").val() === "undefined") {
            Materialize.toast('Vous devez remplir le pseudonyme !', 3000, 'rounded red');
            return;
        }

        $pseudoLow = $("#pseudo").val().toLowerCase();
        if (jQuery.inArray($pseudoLow, $censure)!==-1) {
            Materialize.toast('L\'utilisation du pseudonyme, '+$("#pseudo").val()+' sous toutes ses formes, est reservé', 3000, 'rounded red');
            return;
        }

        if (typeof $("#email.validate.valid").val() === "undefined") {
            Materialize.toast('L\'adresse email n\'est pas valide !', 3000, 'rounded red');
            return;
        }


        $.post("http://"+$http_host+"/blog_ecrivain/insert_comment/" + $idPost,
            {
                sous_com: $("#sous_com").val(),
                pseudo: $("#pseudo").val(),
                email: $("#email").val(),
                comment: $("#comment").val(),
                ip_addr: $("#ip_addr").val()
            },
            function (data) {
                Materialize.toast(data.content, 3000, data.params);
                view_com();
                $("#insert_comments").remove();
            },
            "json"
        );
    }

    function report_com(elem){
        $idPostReport = $(elem).attr("data-id");
        $.post("http://"+$http_host+"/blog_ecrivain/report_comment/" + $idPostReport,
            function (data) {
                Materialize.toast(data.content, 3000, data.params);
            },
            "json"
        );
    }
    view_com();

    $(".container").on("click", "#repondre", function (){
        $("#insert_comments").remove();
        append($(this));
    });


    $(".container").on("click", "#send_com", function (){
        insert_com();
    });

    $(".container").on("click", "#report", function (){
        report_com($(this));
    });


});