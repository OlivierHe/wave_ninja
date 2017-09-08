<?php
/**
 *  * Created by PhpStorm.
 * User: Olivier Herzog
 * Date: 02/08/2017
 * Time: 13:31
 */

$sous_com_id = [];

foreach ($data as $comment){
    echo '<div class="row">';
            if ($comment->sous_com_id) {
                if (in_array($comment->sous_com_id, $sous_com_id)) {
                    echo '<div class="col s10 m10 l10 offset-s2 offset-m2 offset-l2">';
                } else {
                    echo '<div class="col s11 m11 ll1 offset-s1 offset-m1 offset-l1">';
                }
                array_push($sous_com_id,$comment->id);
            } else {
                echo '<div class="col s12 m12 l12">';
            }
                echo '<div class="card">
                      <div class="card-content">
                      <b>' . $comment->pseudo . '</b> - ' . (new DateTime($comment->date))->format('d/m/Y H:i:s') . '<br>
                      ' . $comment->content . '
                      </div>
                          <div class="card-action" style="border-radius: 0 0 10px 10px; background : grey;">
                          <a class="waves-effect waves-light orange btn" id="repondre" data-id="' . $comment->id . '" ><i class="material-icons left">forum</i>Répondre</a>
                          <a class="btn-floating tooltipped red right " id="report" data-id="' . $comment->id . '" data-position="bottom" data-delay="50" data-tooltip="Signaler un commentaire"><i class="material-icons">report_problem</i></a>
                          </div>
                       </div>
                     </div>
                    </div>
                    <div id="' . $comment->id . '"></div>
                    ';
}

