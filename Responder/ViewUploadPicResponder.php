<?php
/**
 *  * User: Olivier Herzog
 * Date: 11/08/2017
 * Time: 18:03
 */

namespace Responder;


class ViewUploadPicResponder
{
    private $data;
    private $config;

    public function __invoke()
    {
        $data = $this->data;
        $http_host = $this->config->http_host;

        if ($data) {
            return $data;
        } else {
            ob_start();
            require '../Views/upload_pic.php';
            $content = ob_get_clean();
            $script = '<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.8/sweetalert2.min.js"></script>
                        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.8/sweetalert2.min.css">
                        <!-- Include a polyfill for ES6 Promises (optional) for IE11 and Android browser -->
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
                        <script src="http://'.$http_host.'/blog_ecrivain/js/upload_pic.js"></script>';
            require '../Views/templates/default.php';
        }
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