<?php
/**
 * Created by PhpStorm.
 * User: olivier
 * Date: 2017-07-17
 * Time: 23:01
 */

namespace Action;

use App\Router;
use App\Settings;
use Domain\Database;
use Responder\GetOneArticleResponder;

class GetOneArticleAction
{
    private $db;
    private $responder;
    private $request;
    private $config;

    public function __construct(
        Router $request,
        GetOneArticleResponder $responder,
        Database $db,
        Settings $config
    )
    {
        $this->request = $request->request;
        $this->db = $db;
        $this->responder = $responder;
        $this->config = $config;
    }

    public function __invoke()
    {
        session_start();
        if ($_SESSION['type'] === 'ADMIN') {
            $data = $this->db->queryBy('articles', 'id', array($this->request));
            $this->responder->setData($data);
        } else {
            $this->responder->setData(header('Location: http://'.$this->config->http_host.'/blog_ecrivain/error/403'));
        }
        $this->responder->setConfig($this->config);
        return $this->responder->__invoke();

    }

}