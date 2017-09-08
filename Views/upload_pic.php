<?php
/**
 *  * User: Olivier Herzog
 * Date: 15/08/2017
 * Time: 15:10
 */
if (isset($_SESSION['message'])) {
    $message = json_decode($_SESSION['message']);
    $titre = $message->titre;
    $content = $message->content;
    $params = $message->params;
    unset($_SESSION['message']);
} else {
    $content = '';
    $params = '';
    $titre = '';
}

?>

<div class="card-panel">
    <div id="message" data-params="<?= $params
    ?>" data-message="<?= $content ?>" data-titre="<?= $titre ?>"></div>


    <form action="http://<?= $http_host ?>/blog_ecrivain/upload_pic" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="file-field input-field col s12">
                <div class="btn">
                    <span>Choisir une image</span>
                    <input id="file" type="file" name="file">
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" type="text">
                </div>
            </div>
        </div>
        <div class="row">
            <button class="waves-effect waves-light blue btn tooltipped col sl2 m4 l3" data-html="true" data-position="bottom" data-delay="50" data-tooltip="Choisissez une image d'abord (400ko max)" id="send_image" type="submit" name="action">
                <i class="material-icons left">add_a_photo</i>
                Téléverser une image
            </button>
    </form>
    <form id="delimg" action="http://<?= $http_host ?>/blog_ecrivain/delete_pic/1" method="post">
        <input id="img_name" type="hidden" name="image_delete">
        <button class="waves-effect waves-light red btn tooltipped col s12 m4 l3" id="delete_image"
                data-position="bottom" data-delay="50"
                data-tooltip="Cliquer sur l'image à supprimer et ensuite ce bouton">
            <i class="material-icons left">delete_forever</i>
            Supprimer une image
        </button>
    </form>
        </div>
    <div class="row">
        <div class="divider"></div>
        <h4>Images disponibles</h4> cliquer sur une image pour obtenir son lien.
        <div class="input-field col s12">
            <input id="lien" type="text">
            <label for="lien">lien</label>
        </div>
        <?php
        $dir    = '../Public/img';
        $files1 = scandir($dir,1);
        if($files1) {
            $row = 0;
            foreach ($files1 as $key => $filename){

               if($filename != "." && $filename != "..") {
                   $row++;
                   if($row === 1){
                       echo '<div class="row">';
                   }
                       echo '<div class="col s12 m6 l4">
                             <img class="responsive-img" data-img="'.$filename.'" src="http://'.$http_host.'/blog_ecrivain/img/' . $filename . '">
                           </div>';

                   if($row === 3){
                       echo '</div>';
                       $row = 0;
                   }

               }
            }
        }else{
            echo 'Pas de fichiers images disponibles';
        }

        ?>
    </div>
</div>


