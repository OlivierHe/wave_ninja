<?php

function paginatron($data,$color,$pnum){
    echo '<ul class="pagination '. $color.' center-align '. $pnum .'">';
    $z = 1;
    for ($i = 1; $i <= count($data); $i++) {

        if(($i % 3) === 1) {

            if ($z === 1 ){
                $active = 'active';
            }else{
                $active = '';
            }

            echo '<li class="waves-effect '. $active .'"><a href="#ppp">'.$z.'</a></li>';
            $z++;
        }
    }

    echo '</ul>';
}

paginatron($data,'grey','pagitop');

$cleanContent = new \tidy();

    foreach ($data as $key => $post)  {

            $cleanContent->parseString($post->contenu,array('show-body-only'=>true),'utf8');
            $cleanContent->cleanRepair();
            $hidden = $key >= 3 ? '<div class="row post" hidden data-id="'.$key.'">' : '<div class="row post" data-id="'.$key.'">';
            echo $hidden;
            echo '<div class="col s12 m12 l12">
                      <div class="card">
                        <div class="card-content">
                          <span class="card-title"><h3>'. $post->titre .'</h3></span>
                            <blockquote>
                            '. $cleanContent .'...
                            </blockquote>
                            <div class="card-Action">
                                <a href="show_post/'.$post->id.'">Lire l\'article</a>
                            </div>
                         </div>
                        </div>
                     </div>
                    </div>
                    ';

    }


paginatron($data,'grey darken-1','pagibot');









