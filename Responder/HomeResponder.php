<?php
/**
 * Created by PhpStorm.
 * User: MiniTarlouf
 * Date: 10/07/2017
 * Time: 18:50
 */

namespace Responder;


class HomeResponder
{
    private $data;
    private $config;

    public function __invoke()
    {
        $data = $this->data;
        $http_host = $this->config->http_host;
        ob_start();
        require '../Views/home.php';
        $content = ob_get_clean();
        $script = '<script src="http://'.$http_host.'/wave_ninja/js/home.js"></script>';
        require '../Views/templates/default.php';
    }

    public function setData($data)
    {
      $this->data = $data;
    }

    public function setConfig($config)
    {
        $this->config = $config;
    }
}
