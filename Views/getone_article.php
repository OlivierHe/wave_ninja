<?php
/**
 *  * User: Olivier Herzog
 * Date: 13/08/2017
 * Time: 11:14
 */


echo '<div class="card-panel">
    <div class="row">
        <div class="input-field col s12">
            <input id="titre" value="'.$data[0]->titre.'" type="text" class="validate">
            <label for="titre">Titre de l\'article</label>
        </div>
    </div>
    <div class="row">
        <div id="tinymce"></div>
    </div>
    <div class="row">
        <a class="waves-effect waves-light blue btn" id="send_article">
            <i class="material-icons left">edit</i>
            Modifier l\'article
        </a>
    </div>
</div>';
