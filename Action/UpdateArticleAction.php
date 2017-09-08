<?php
/**
 *  * User: Olivier Herzog
 * Date: 13/08/2017
 * Time: 12:35
 */

namespace Action;

use App\Router;
use App\Settings;
use Domain\Database;
use Responder\UpdateArticleResponder;


class UpdateArticleAction
{
    private $db;
    private $responder;
    private $request;
    private $config;

    public function __construct(
        Router $request,
        UpdateArticleResponder $responder,
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
            $id = $this->request[0];
            $titre = htmlspecialchars($this->request[1]);
            $article = $this->request[2];
            $this->db->updateTwoValueWhere('articles',['titre','contenu'],[$titre,$article,$id]);
            $this->responder->setData(['content' => 'Article modifié !', 'params' => 'rounded green']);
        } else {
            $this->responder->setData(header('Location: http://'.$this->config->http_host.'/blog_ecrivain/error/403'));
        }
        return $this->responder->__invoke();
    }
}