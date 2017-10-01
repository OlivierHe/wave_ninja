<?php
/**
 * Created by PhpStorm.
 * User: MiniTarlouf
 * Date: 16/07/2017
 * Time: 20:39
 */

namespace WaveNinja\Action;

use WaveNinja\App\Router;
use WaveNinja\App\Settings;
use WaveNinja\App\ImgGetter;
use WaveNinja\Responder\HomeResponder;


class HomeAction
{
    private $responder;
    private $request;
    private $config;
    private $pathScanner;

    public function __construct(
        Router $request,
        HomeResponder $responder,
        Settings $config
    )
    {
        $this->request = $request->request;
        $this->responder = $responder;
        $this->config = $config;
        $ImgGetter = new ImgGetter();
        $this->pathScanner = $ImgGetter->pathScanner('swell_wave_height',2,false);
    }

    public function __invoke()
    {
        setlocale (LC_TIME, 'fr_FR.utf8','fra');
        $data = [ucfirst(strftime("%a %d %B %G")),strftime("%H"),strftime("%G-%m-%dT%H_00_00Z"),$this->pathScanner];
        $this->responder->setConfig($this->config);
        $this->responder->setData($data);

        return $this->responder->__invoke();
    }
}
