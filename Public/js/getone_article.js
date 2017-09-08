/**
 *  * Created by Olivier Herzog on 13/08/2017.
 */
$(document).ready(function(){


    $uri = $(location).attr('pathname');
    $re = /([a-z_]+)(?:\/)([0-9]+)$/mg;
    $idPost = $re.exec($uri)[2];
    Materialize.updateTextFields();

    function insert_article() {
        if ($("#titre").val() === "") {
            Materialize.toast('Vous devez remplir un titre !', 3000, 'rounded red');
            return;
        }
        if (tinyMCE.activeEditor.getContent() === "") {
            Materialize.toast('Vous devez remplir un message !', 3000, 'rounded red');
            return;
        }

        $.post("http://"+$http_host+"/blog_ecrivain/update_article/" + $idPost,
            {
                titre: $("#titre").val(),
                article: tinyMCE.activeEditor.getContent()
            },
            function (data) {
                Materialize.toast(data.content, 3000, data.params);

                setTimeout(function(){
                    $(location).attr('href', 'http://'+$http_host+'/blog_ecrivain/editer_article');
                }, 1000);
            },
            "json"
        );
    }

    $("#send_article").click(function(){
        insert_article();
    });
});
