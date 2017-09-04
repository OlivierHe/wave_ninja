<?php
/**
 *  * User: Olivier Herzog
 * Date: 29/08/2017
 * Time: 19:02
 */

namespace App;


class ImgGetter
{
    private $dateArray;
    private $curlHandle;

    public function __construct()
    {
     $this->dateArray = new DateGraber();
    }

    public function getImages()
    {

        // on init le curl
        $this->curlHandle = curl_init();

        curl_setopt_array($this->curlHandle,array(
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_VERBOSE => 1,
            CURLOPT_FOLLOWLOCATION => 1,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36'
        ));

        $path = "../Public/img/";

        foreach ($this->dateArray->getDates() as $date) {
            $imgRawName = $date->format("Y-m-d\TH:i:s\Z");
            $imgName = mb_ereg_replace("(:)", '_', $imgRawName);
            $img = $path . $imgName . ".png";

            $this->download_image("https://erddap.marine.ie/erddap/griddap/IMI_EATL_WAVE.largePng?swell_wave_height[(" . $imgRawName . ")][(47.1875):(47.7875)][(-3.7124999999999986):(-3.1125000000000007)]&.draw=surface&.vars=longitude%7Clatitude%7Cswell_wave_height&.colorBar=%7C%7C%7C%7C%7C&.bgColor=0xffccccff", $img);
        }

        curl_close($this->curlHandle);


    }

    private function download_image($image_url, $image_file){
        ini_set('max_execution_time', 0);
        $curl_log = fopen("log_con.txt", 'w+'); // log file
        $fp = fopen ($image_file, 'wb');// open file handle
        curl_setopt($this->curlHandle,CURLOPT_STDERR, $curl_log);
        curl_setopt($this->curlHandle, CURLOPT_FILE, $fp);// output to file
        curl_setopt($this->curlHandle, CURLOPT_TIMEOUT_MS, 300000);
        curl_setopt($this->curlHandle, CURLOPT_URL, $image_url);
        curl_exec($this->curlHandle);
        fclose($fp);
    }

}