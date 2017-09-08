/**
 *  * Created by Olivier Herzog on 15/08/2017.
 */
$(document).ready(function () {
    Materialize.updateTextFields();

    $("#modif_pass").click(function(){
        if (typeof $("#identifiant.validate.valid").val() === "undefined") {
            Materialize.toast('Identifiant non valide !', 3000, 'rounded red');
            return;
        }
        if (typeof $("#password.validate.valid").val() === "undefined") {
            Materialize.toast('Mot de passe non valide !', 3000, 'rounded red');
            return;
        }
        swal({
            title: 'Etes-vous sûr,',
            text: "de vouloir changer le mot de passe et ou l'identifiant ?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Oui, j\'ai noté le nouveau !',
            cancelButtonText: 'Non, Annuler !',
            confirmButtonClass: 'waves-effect waves-light btn green',
            cancelButtonClass: 'waves-effect waves-light btn red',
            buttonsStyling: false,
            showLoaderOnConfirm: true,
            preConfirm: function (data) {
                return new Promise(function (resolve) {
                    $.post("http://"+$http_host+"/blog_ecrivain/update_pass/666",
                        {
                            identifiant: $("#identifiant").val(),
                            password: $("#password").val()
                        },
                        function (data) {
                            resolve(data);
                        }, "json"
                    );
                })
            },
            allowOutsideClick: false
        }).then(function (data) {
            swal({
                type: 'success',
                title: 'Changement effectué',
                html: data.content
            })
        }, function (dismiss) {
            if (dismiss === 'cancel') {
                swal(
                    'Annulation',
                    'L\'identifiant et le mot de passe, restent inchangés :)',
                    'error'
                )
            }
        });

    });

    $("#eye").mousedown(function(){
        $("#password").attr("type","text");
    });

    $("#eye").mouseup(function(){
        $("#password").attr("type","password");
    });
});
