<?php
/**
 *  * User: Olivier Herzog
 * Date: 13/08/2017
 * Time: 15:25
 */

namespace Action;

use App\Router;
use Domain\Database;
use Responder\DeleteArticleResponder;


class DeleteArticleAction
{
    private $db;
    private $responder;
    private $request;

    public function __construct(
        Router $request,
        DeleteArticleResponder $responder,
        Database $db
    )
    {
        $this->request = $request->request;
        $this->db = $db;
        $this->responder = $responder;
    }

    public function __invoke()
    {
        session_start();
        if ($_SESSION['type'] === 'ADMIN') {
            $this->db->deleteFromWhere('articles','id',[$this->request]);
            $this->responder->setData(['content' => 'Article supprimé !', 'params' => 'rounded green']);
            return $this->responder->__invoke();
        }
    }
}