/**
 *  * Created by Olivier Herzog on 12/08/2017.
 */

$(document).ready(function () {


    var table = $('#articles').DataTable({
        "language": {
            "search": "Chercher :",
            "loadingRecords": '<div class="progress  light-blue accent-4" id="loader"> <div class="indeterminate  light-blue lighten-4"></div> </div>',
            "lengthMenu": "Nombre de résultats par page _MENU_ ",
            "zeroRecords": "Aucun résultat",
            "info": "Page _PAGE_ sur _PAGES_ ",
            "infoFiltered": "( filtrées sur _MAX_ résultats )",
            "paginate": {
                "previous": "Précedent",
                "next": "Suivant"
            }
        },
        "ajax": "get_articles",
        "columns": [
            {"data": "titre"},
            {"data": "contenu"},
            {"data": "id",
                "render": function (data) {
                    return '<a class="btn-floating btn-small waves-effect waves-light green btn-action" href="#" data-idarticle="'
                        + data
                        + '" data-state="1"><i class="material-icons">edit</i></a>'
                        + ' <a class="btn-floating btn-small waves-effect waves-light red btn-action" href="#" data-idarticle="'
                        + data
                        + '" data-state="2"><i class="material-icons">delete_forever</i></a>';
                }
            }
        ],
        "searching" : true,
        "info" : true,
        "ordering" : true,
        responsive: true,
        "lengthMenu": [[3, 5, 10, 20], [3, 5, 10, 20]]
    });

   $('select').material_select();

    $('#articles tbody').on('click', '.btn-action', function () {
        $idArt = $(this).data("idarticle");
        $state = $(this).data("state");
        if ($state === 1) {
            $(location).attr('href', 'http://'+$http_host+'/blog_ecrivain/getone_article/' + $idArt);
        } else{
            swal({
                title: 'Etes-vous sûr,',
                text: "de vouloir supprimer l'article définitivement ?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Oui, supprimer le !',
                cancelButtonText: 'Non, Annuler !',
                confirmButtonClass: 'waves-effect waves-light btn green',
                cancelButtonClass: 'waves-effect waves-light btn red',
                buttonsStyling: false,
                showLoaderOnConfirm: true,
                preConfirm: function (data) {
                    return new Promise(function (resolve) {
                            $.post("http://"+$http_host+"/blog_ecrivain/delete_article/" + $idArt,
                                function (data) {
                                    table.ajax.reload();
                                    resolve(data);
                                }, "json"
                            );
                    })
                },
                allowOutsideClick: false
            }).then(function (data) {
                swal({
                    type: 'success',
                    title: 'Suppression',
                    html: data.content
                })
            }, function (dismiss) {
                if (dismiss === 'cancel') {
                    swal(
                        'Annulation',
                        'L\'article est en sécurité :)',
                        'error'
                    )
                }
            });

        }
    });

});

