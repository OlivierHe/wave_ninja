<?php
/**
 *  * User: Olivier Herzog
 * Date: 07/08/2017
 * Time: 17:02
 */

namespace Responder;


class ViewLoginResponder
{
    private $data;
    private $config;

    public function __invoke()
    {
        $data = $this->data;
        $http_host = $this->config->http_host;
        ob_start();
        require '../Views/login_view.php';
        $content = ob_get_clean();
        $script = '<script src="http://'.$http_host.'/blog_ecrivain/js/login_view.js"></script>';
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