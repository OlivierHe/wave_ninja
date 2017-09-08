<?php
/**
 *  * User: Olivier Herzog
 * Date: 15/08/2017
 * Time: 21:37
 */

namespace Responder;


class DeletePicResponder
{
    private $data;
    private $config;

    public function __invoke()
    {
        $data = $this->data;
        $http_host = $this->config->http_host;
        if ($_SESSION['type'] === 'ADMIN') {
            $_SESSION['message'] = json_encode($data);
            return (header('Location: http://'.$http_host.'/blog_ecrivain/televerser_image'));
        } else {
            return $data;
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