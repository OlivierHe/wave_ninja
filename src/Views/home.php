<?php


            echo '<div class="card">
                        <div class="card-content">
                        <div class="row">
                        <div class="col s12 m12 l3">
                            <div class="input-field">
                                <select id="donne">
                                  <option value="mean_wave_direction">Direction des vagues moyennes</option>
                                  <option value="significant_wave_height">Hauteur significative des vagues</option>
                                  <option value="swell_wave_height">Houle primaire</option>
                                </select>
                                <label>Type de données</label>
                              </div>

                              <div class="input-field">
                                <label for="dateprev">Entrez la date</label>
                                <input value="' . $data[0] . '"id="dateprev" type="text" class="datepicker">
                              </div>

                              <div class="input-field">
                                <select id="heureprev">
                                </select>
                                <label>Entrez l\'heure</label>
                              </div>
                                <a class="btn-large waves-effect waves-light green" id="nextimg"><i class="material-icons">add_to_photos</i></a>
                                <a class="btn-large waves-effect waves-light  orange darken-3" id="animateimg"><i class="material-icons">ondemand_video</i></a>
                            </div>
                            <div class="col s12 m12 l9">
                              <img class="responsive-img" id="previmg" src="http://'.$http_host.'/wave_ninja/img/surf_prev/mean_wave_direction/'.$data[2].'.png">
                            </div>
                               <div id="currhour" data-currhour=' . $data[1] . '></div>
                               <div id="prevfiles" data-prevfiles=' . json_encode($data[3]) . '></div>
                          </div>
                         </div>
                        </div>
                     </div>
                    ';










