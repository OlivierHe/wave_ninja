<?php
/**
 *  * User: Olivier Herzog
 * Date: 29/08/2017
 * Time: 19:02
 */
use App\Router;
use App\ImgGetter;

require_once '../vendor/autoload.php';

//$router = new Router();
//$router->callAction();

$test = new ImgGetter();
echo $test->getImages();
