<?php
/**
 *  * User: Olivier Herzog
 * Date: 28/08/2017
 * Time: 18:28
 */
namespace WaveNinja\App;

require_once '../../vendor/autoload.php';


// updater
$test = new ImgGetter();
echo $test->getImages();
