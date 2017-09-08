/**
 *  * Created by Olivier Herzog on 11/08/2017.
 */
$(document).ready(function(){

    function insert_article() {
        if (tinyMCE.activeEditor.getContent() == "") {
            Materialize.toast('Vous devez remplir un message !', 3000, 'rounded red');
            return;
        }
        if (!$("#titre.validate").hasClass( "valid" )) {
            Materialize.toast('Vous devez remplir un titre !', 3000, 'rounded red');
            return;
        }

        $.post("http://"+$http_host+"/blog_ecrivain/insert_article/1",
            {
                titre: $("#titre").val(),
                article: tinyMCE.activeEditor.getContent()
            },
            function (data) {
                Materialize.toast(data.content, 3000, data.params);
                // clean content
                tinyMCE.activeEditor.setContent('');
                $("#titre").val(null);
                $("#titre.validate").removeClass( "valid" );
            },
            "json"
        );
    }

    $("#send_article").click(function(){
        insert_article();
    });
});