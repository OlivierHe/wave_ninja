<?php
/**
 *  * User: Olivier Herzog
 * Date: 29/08/2017
 * Time: 19:02
 */

namespace WaveNinja\App;

use GuzzleHttp\Client;



class ImgGetter
{
    private $dateArray;
    private $imgMod;
    private $clientGuzzle;

    public function __construct()
    {
     $this->dateArray = new DateGraber();
     $this->imgMod = new ImgMod();
    }

    public function getImages()
    {
        ini_set('max_execution_time', 0);
        setlocale (LC_TIME, 'fr_FR.utf8','fra');

        $types = [['swell_wave_height', 'Houle primaire'],
                 ['significant_wave_height', 'Hauteur significative des vagues'],
                 ['mean_wave_direction', 'Direction des vagues moyennes']];

        $path = "../Public/img/surf_prev/tmp/";
        $pathRegular = "../Public/img/surf_prev/";
    
        $this->clientGuzzle = new Client(['base_uri' => 'https://erddap.marine.ie/erddap/griddap/']);
      
    
       // telecharge les images temporaires générées toutes les 3 heures
      foreach ($this->dateArray->getDates('PT3H') as $key => $date) {
            foreach($types as $type){
                $img = $path . $type[0] . "/" . $key . ".png";
          
                $this->downloadImages("IMI_EATL_WAVE.largePng?". $type[0] ."[(" . $date->format("Y-m-d\TH:i:s\Z") . ")][(47.1875):(47.7875)][(-3.7124999999999986):(-3.1125000000000007)]&.draw=surface&.vars=longitude%7Clatitude%7C" . $type[0] . "&.colorBar=%7C%7C%7C%7C%7C&.bgColor=0xffccccff", $img);
            }
        }
        

        //create/supp interpolation and rename/add timestamp all types of all png
        foreach($types as $type){

            // supression des anciens fichiers
            $oldFiles = $this->pathScanner($type[0]);
            foreach ($oldFiles as $oldFile) {
                unlink($oldFile);
            }
 
            // interpolation
            $this->imgMod->morphImages($this->pathScanner('tmp/'. $type[0]), $type[0]);

            $mImages = array_slice($this->pathScanner($type[0]),3);
          
            foreach( $this->dateArray->getDates('PT1H') as $key => $date ){
                // limitation de l'intervale =P car l'interpolation boucle la fin et le début.
                if ($key === 118) {
                    break;
                }
                $date->setTimezone(new \DateTimeZone('Europe/Paris'));
                $timeStamp = $date->format("Y-m-d\TH:i:s\Z");
                $imgName = mb_ereg_replace("(:)", '_', $timeStamp);

                $this->imgMod->annotateImage($mImages[$key], $type[1], $date, '#000000', '#FFFFCC');
                rename($mImages[$key], $pathRegular . $type[0] . '/' . $imgName .'.png');
               
            } 

            //supprime le reliquat de fichier 
            unlink($pathRegular . $type[0] . '/' . 'm-0.png');
            unlink($pathRegular . $type[0] . '/' . 'm-1.png');
            unlink($pathRegular . $type[0] . '/' . 'm-2.png');

        }
        
    $time = microtime(true) - $_SERVER["REQUEST_TIME_FLOAT"]; 
    return 'operations executed in '.$time;    
    }

    private function downloadImages($image_url, $image_file){
        $fp = fopen ($image_file, 'wb');
        $this->clientGuzzle->get($image_url,['sink' => $fp, 'verify' => false]);
        
        if(is_resource($fp)) {
            fclose($fp);
        }
    }

    public function pathScanner($dirName, $arrStart = 2, $fullPath = true){
        // lit les noms de fichier et supprimes les . /..
        $imagesName = array_slice((scandir ('../Public/img/surf_prev/'. $dirName .'/')), $arrStart);
        natsort($imagesName);

        $pathImages = '../Public/img/surf_prev/' . $dirName . '/';
        $images = [];
        foreach ($imagesName as $image){
            if ($fullPath){
              array_push($images, $pathImages . $image); 
            } else {
              array_push($images, $image);
            }
        }
    
        return $images;
    }

}
