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


        $this->clientGuzzle = new Client(['base_uri' => 'https://erddap.marine.ie/erddap/griddap/']);
        $path = "../Public/img/surf_prev/";
        $todayRaw = $this->dateArray->currentPastDate->format("Y-m-d\TH:i:s\Z");
        $today = mb_ereg_replace("(:)", '_', $todayRaw);
        $todayFile =  $path . $today . ".png";

        echo 'Today file is '.$todayFile.'<br>';
        if (file_exists($todayFile)) {

            //     echo 'past Date = '.$pasteDate.'<br>';
//            $todayDate = date('Y-m-d H:00:00',strtotime('+2 hours'));
//            $zozo = \DateTime::createFromFormat('Y-m-d H:i:s', $todayDate);
//            $goza = $zozo->format("Y-m-d\TH:i:s\Z");
//            echo 'today datetime is '.$goza.'<br>';
//            echo 'today is '.$todayDate.'<br>';


            $existingFile = date("Y-m-d\TH:00:00\Z", filemtime($todayFile));
            //$todayStripped = substr($today, 0, -10);
            echo 'Existing file is ' . $existingFile . '<br>';
            echo 'Today is ' . $todayRaw . '<br>';
            if ($existingFile == $todayRaw) {
                return 'uptodate';
            }
        }

        foreach ($this->dateArray->getDates() as $date) {
            $imgRawName = $date->format("Y-m-d\TH:i:s\Z");
            $imgName = mb_ereg_replace("(:)", '_', $imgRawName);
            $img = $path . $imgName . ".png";
            $this->download_image("IMI_EATL_WAVE.largePng?swell_wave_height[(" . $imgRawName . ")][(47.1875):(47.7875)][(-3.7124999999999986):(-3.1125000000000007)]&.draw=surface&.vars=longitude%7Clatitude%7Cswell_wave_height&.colorBar=%7C%7C%7C%7C%7C&.bgColor=0xffccccff", $img);
        }
        return 'updated';
    }

    private function download_image($image_url, $image_file){
        //ini_set('max_execution_time', 0);
        $fp = fopen ($image_file, 'wb');// open file handle
        $this->clientGuzzle->get($image_url,['sink' => $fp, 'verify' => false]);

        if(is_resource($fp)) {
        fclose($fp);
        }

    }

}
