/**
 *  * Created by Olivier Herzog on 14/08/2017.
 */
$(document).ready(function () {


    var table = $('#com').DataTable({
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
        "ajax": "get_comments",
        "columns": [
            {"data": "signale"},
            {"data": "pseudo"},
            {"data": "email"},
            {"data": "content"},
            {"data": "ip"},
            {"data": "date"},
            {"data": "id",
                "render": function (data) {
                    return '<a class="btn-floating btn-small waves-effect waves-light red btn-action" href="#" data-idcom="'
                        + data
                        + '"><i class="material-icons">delete_forever</i></a>';
                }
            }
        ],
        "searching" : true,
        "info" : true,
        "ordering" : true,
        responsive: true,
        "lengthMenu": [[5, 10, 20], [5, 10, 20]],
        "order": [ 0, 'desc' ]
    });

    $('select').material_select();

    $('#com tbody').on('click', '.btn-action', function () {
        $idCom = $(this).data("idcom");
            swal({
                title: 'Voulez vous,',
                text: "supprimer le commentaire définitivement, ainsi que ses sous commentaires ?",
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
                        $.post("http://"+$http_host+"/blog_ecrivain/delete_comment/" + $idCom,
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
                        'Le commentaire est en sécurité :)',
                        'error'
                    )
                }
            });
    });

});


