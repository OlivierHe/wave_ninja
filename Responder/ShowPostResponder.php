<?php
/**
 * Created by PhpStorm.
 * User: olivier
 * Date: 2017-07-17
 * Time: 23:02
 */

namespace Responder;


class ShowPostResponder
{
    public $censure;
    private $data;
    private $config;

    public function __invoke()
    {
        $data = $this->data;
        $http_host = $this->config->http_host;
        session_start();
        if (isset($_SESSION["type"])) {
            if ($_SESSION["type"] === 'ADMIN') {
                $this->censure = json_encode(['ras']);
            }
        }else{
            $this->censure = json_encode(['jeanforteroche','jf','jean forteroche','modérateur','admin','modo','administrateur']);
        }

        ob_start();

        require '../Views/show_post.php';
        $content = ob_get_clean();
        $script = '<script>$censure = '.$this->censure.'; </script>
                   <script src="http://'.$http_host.'/blog_ecrivain/js/show_post.js"></script>';
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