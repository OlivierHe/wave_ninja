<?php
/**
 *  * User: Olivier Herzog
 * Date: 11/08/2017
 * Time: 18:01
 */

namespace Action;

use App\Router;
use App\Settings;
use Domain\Database;
use Responder\ViewArticleAddResponder;

class ViewArticleAddAction
{
    private $db;
    private $responder;
    private $request;
    private $config;

    public function __construct(
        Router $request,
        ViewArticleAddResponder $responder,
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
            $this->responder->setData(false);
        } else {
            $this->responder->setData(header('Location: http://'.$this->config->http_host.'/blog_ecrivain/error/403'));
        }
        $this->responder->setConfig($this->config);
        return $this->responder->__invoke();
    }

}