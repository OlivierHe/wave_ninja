<?php
/**
 *  * User: Olivier Herzog
 * Date: 12/08/2017
 * Time: 13:17
 */

namespace Responder;


class InsertArticleResponder
{
    private $data;
    private $config;

    public function __invoke()
    {
        $data = $this->data;
        $http_host = $this->config->http_host;
        if (count($data) === 2) {
            echo json_encode($this->data);
        }else {
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