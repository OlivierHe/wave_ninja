<?php
/**
 *  * User: Olivier Herzog
 * Date: 16/08/2017
 * Time: 12:45
 */

namespace App;


class Settings
{
    public $config;
    public $http_host;

    public function __construct()
    {
        $this->config = require '../App/Config/config.php';
        $this->http_host = $this->config['http_host'];
    }

}