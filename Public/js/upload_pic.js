/**
 *  * Created by Olivier Herzog on 15/08/2017.
 */
$(document).ready(function(){
    $('.tooltipped').tooltip({delay: 50});

    if ($("#message").data('params') !== '') {
        $titre = $("#message").data('titre');
        $params = $("#message").data('params');
        $message = $("#message").data('message');

        swal({
            title: $titre,
            type: $params,
            html: $message
        })
    }

    $("#delete_image").click(function (e){
        if ($("#img_name").val()) {
            $("#delimg").submit();
        }else{
            Materialize.toast('Vous devez d\'abord cliquer, sur l\'image que vous voulez supprimer', 3000, 'rounded red');
            e.preventDefault();
        }
    });

    $(".container").on("click",".responsive-img", function (){
        $("#img_name").val($(this).data('img'));
        $("#lien").val($(this).attr("src"));
        $("#lien").focus();
        $("#lien").select();
        Materialize.updateTextFields();
        if(document.execCommand( 'copy' )){
            swal(
                'Lien Copié !',
                'Utiliser coller ou ctrl + v pour coller le lien!',
                'success'
            )
        }
    });
});