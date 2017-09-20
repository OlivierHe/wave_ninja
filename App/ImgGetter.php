<?php
/**
 *  * User: Olivier Herzog
 * Date: 29/08/2017
 * Time: 19:02
 */

namespace App;

use GuzzleHttp\Client;



class ImgGetter
{
    private $dateArray;
    private $clientGuzzle;

    public function __construct()
    {
     $this->dateArray = new DateGraber();
    }

    public function getImages()
    {
        ini_set('max_execution_time', 0);

        $types = [['swell_wave_height', 'Houle primaire'],
                 ['significant_wave_height', 'Hauteur significative des vagues'],
                 ['mean_wave_direction', 'Direction des vagues moyennes']];

        $path = "../Public/img/surf_prev/";
        $this->clientGuzzle = new Client(['base_uri' => 'https://erddap.marine.ie/erddap/griddap/']);
        $parisDate = $this->dateArray->currentPastDate->setTimezone(new \DateTimeZone('Europe/Paris'));

        $today = mb_ereg_replace("(:)", '_', $parisDate->format("Y-m-d\TH:i:s\Z"));
        $todayFile =  $path . $types[0][0] . "/" . $today . ".png";

     /*       $imagick = new \Imagick(realpath($todayFile));
 
            $draw = new \ImagickDraw();
            $draw->setFillColor('rgb(0, 0, 0)');
         
            $draw->setStrokeWidth(1);
            $draw->setTextUnderColor('#FFFFCC');
            $draw->setFontSize(10);

            $parisDate = $this->dateArray->currentPastDate->setTimezone(new \DateTimeZone('Europe/Paris'));
            $text = $parisDate->format("Y-m-d\TH:i:s\Z");

      
            $draw->setFont("fonts/Arial.ttf");
            $imagick->annotateimage($draw, 48, 746, 0, $text);
         
            $imagick->writeImage(realpath($todayFile));*/

        // ligne morph image

        $imagesName = array_slice(scandir ('../Public/img/surf_prev/mean_wave_direction/'),2);
        $pathImages = '../Public/img/surf_prev/mean_wave_direction/';
        $images = [];
        foreach ($imagesName as $image){
               array_push($images,$pathImages . $image); 
        }
    
        $this->morphImages($images);

        echo 'Today file is '.$todayFile.'<br>';
        if (file_exists($todayFile)) {
            

            $existingFile = date("Y-m-d\TH:00:00\Z", filemtime($todayFile));
            echo 'Existing file is ' . $existingFile . '<br>';


            $exFileDatetime = new \DateTime();
            $exFileDatetime->setTimestamp(filemtime($todayFile));
            $todDatetime = new \DateTime();
            echo 'Today is ' . $todDatetime->format("Y-m-d\TH:i:s\Z") . '<br>';

            $interval = $exFileDatetime->diff($todDatetime);
            echo 'The interval is '.$interval->format('%H:%i:%s').'<br>';
            if (($interval->format('%H'))< "03") {
                return 'uptodate';
            }
        }

      /*  foreach ($this->dateArray->getDates() as $date) {
            $date->setTimezone(new \DateTimeZone('Europe/Paris'));
            $timeStamp = $date->format("Y-m-d\TH:i:s\Z");
            $imgName = mb_ereg_replace("(:)", '_', $timeStamp);

            foreach($types as $type){
                $img = $path . $type[0] . "/" . $imgName . ".png";
                // houle primaire : swell_wave_height
                // Hauteur significative des vagues  : significant_wave_height
                // direction des vagues moyennes : mean_wave_direction
          
                $this->download_image("IMI_EATL_WAVE.largePng?". $type[0] ."[(" . $date->format("Y-m-d\TH:i:s\Z") . ")][(47.1875):(47.7875)][(-3.7124999999999986):(-3.1125000000000007)]&.draw=surface&.vars=longitude%7Clatitude%7C" . $type[0] . "&.colorBar=%7C%7C%7C%7C%7C&.bgColor=0xffccccff", $img, $type[1], $timeStamp);
            }
        } */
        return 'updated';
    }

    private function download_image($image_url, $image_file, $typeFr, $timeStamp){
        $fp = fopen ($image_file, 'wb');// open file handle
        $this->clientGuzzle->get($image_url,['sink' => $fp, 'verify' => false]);
        
        if(is_resource($fp)) {
            fclose($fp);
        }
        $this->annotateImage($image_file, $typeFr, $timeStamp, '#000000','#FFFFCC');

    }

    private function annotateImage($image_file, $typeFr, $timeStamp, $fillColor, $backgroundColor)
    {
        $imagick = new \Imagick(realpath($image_file));
     
        $draw = new \ImagickDraw();
        $draw->setFillColor($fillColor);
     
        $draw->setStrokeWidth(1);
        $draw->setFontSize(10);
        $draw->setTextUnderColor($backgroundColor);
        $text = $typeFr."\n".$timeStamp;
     
        $draw->setFont("fonts/Arial.ttf");
        $draw->setFontWeight(800);
        $imagick->annotateimage($draw, 48, 746, 0, $text);
        $imagick->writeImage(realpath($image_file));
        return 'done imagick';
    }

    private function morphImages($images)
    {
    
        
        $imagick = new \Imagick(realpath($images[count($images) - 1]));
     
        foreach ($images as $image) {
            $nextImage = new \Imagick(realpath($image));
            $imagick->addImage($nextImage);
        }
     
        $imagick->resetIterator();
        $morphed = $imagick->morphImages(2);
        $morphed->setImageTicksPerSecond(10);
     
   
        $morphed->writeImages(realpath('../Public/img/surf_prev/mean_wave_direction/').'\interfame.png', 0);

        //header("Content-Type: image/gif");
        //$morphed->setImageFormat('gif');
        //echo $morphed->getImagesBlob();
    }

}
