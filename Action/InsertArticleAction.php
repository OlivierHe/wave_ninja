<?php
/**
 *  * User: Olivier Herzog
 * Date: 12/08/2017
 * Time: 13:17
 */

namespace Action;

use App\Router;
use App\Settings;
use Domain\Database;
use Responder\InsertArticleResponder;


class InsertArticleAction
{
    private $db;
    private $responder;
    private $request;
    private $config;

    public function __construct(
        Router $request,
        InsertArticleResponder $responder,
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
        if ($_SESSION['pseudonyme']) {
            $titre = htmlspecialchars($this->request[0]);
            $article = $this->request[1];

            $this->db->InsertArticle([$titre,$article]);

            $this->responder->setData(['content' => 'Article ajouté !', 'params' => 'rounded green']);
        } else {
            $this->responder->setData(header('Location: http://'.$this->config->http_host.'/blog_ecrivain/error/403'));
        }
        $this->responder->setConfig($this->config);
        return $this->responder->__invoke();
    }
}
