<?php
/**
 * Created by PhpStorm.
 * User: MiniTarlouf
 * Date: 04/07/2017
 * Time: 13:37
 */

echo '<div class="row">
        <div class="col s12 m12 l12">
          <div class="card">
            <div class="card-content">
              <span class="card-title"><h4>' . $data[0]->titre . '</h4></span>
              <blockquote>' . $data[0]->contenu . '</blockquote>
            </div>
          </div>
          </div>
      </div>
      <div class="row">
          <div class="col">
            <a class="waves-effect waves-light teal btn" id="repondre" data-id="0"><i class="material-icons left">message</i>Commenter l\'article</a>
          </div>
      </div>
      <div id="0"></div>
      ';

