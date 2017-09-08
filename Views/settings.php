<?php
/**
 *  * User: Olivier Herzog
 * Date: 15/08/2017
 * Time: 23:27
 */
?>

<div class="row">
    <div class="col m8 l4 s12 offset-m2 offset-l4">
        <div class="card-panel">
            <h4>Paramètres</h4>
            Modifier l'identifiant et ou le mot de passe
            <div class="row">
                <div class="input-field col l12 m12 s12">
                    <i class="material-icons prefix">person_pin</i>
                    <input id="identifiant" type="text" class="validate">
                    <label for="identifiant">Nouvelle Identifiant</label>
                </div>
                <div class="input-field col l12 m12 s12">
                    <i class="material-icons prefix tooltipped" id="eye" data-tooltip="Pressez l'icone, pour voir le mot de passe en clair">remove_red_eye</i>
                    <input id="password" type="password" class="validate active">
                    <label for="password">Nouveau Mot de passe </label>
                </div>
                    <a class="waves-effect waves-light orange btn col s12 m12 l12" id="modif_pass">
                        <i class="material-icons left">lock_open</i>
                        Envoyer les modifications</a>
            </div>
        </div>
    </div>
</div>
