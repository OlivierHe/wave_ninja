<?php
/**
 * Created by PhpStorm.
 * User: MiniTarlouf
 * Date: 10/07/2017
 * Time: 18:50
 */

namespace WaveNinja\Responder;


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
        $script = '<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.8/sweetalert2.min.js"></script>
                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.8/sweetalert2.min.css">
                    <!-- Include a polyfill for ES6 Promises (optional) for IE11 and Android browser -->
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
                    <script src="http://'.$http_host.'/wave_ninja/js/home.js"></script>';
                    
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
