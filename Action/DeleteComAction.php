<?php
/**
 *  * User: Olivier Herzog
 * Date: 14/08/2017
 * Time: 16:46
 */

namespace Action;

use App\Router;
use App\Settings;
use Domain\Database;
use Responder\DeleteComResponder;


class DeleteComAction
{
    private $db;
    private $responder;
    private $request;
    private $config;

    public function __construct(
        Router $request,
        DeleteComResponder $responder,
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
            $this->db->deleteFromWhere('commentaires','id',[$this->request]);
            $this->responder->setData(['content' => 'Commentaire supprimé !', 'params' => 'rounded green']);
        }else{
            $this->responder->setData(header('Location: http://'.$this->config->http_host.'/blog_ecrivain/error/403'));
        }
        return $this->responder->__invoke();
    }

}