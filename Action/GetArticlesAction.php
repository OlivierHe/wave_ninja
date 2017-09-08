<?php
/**
 *  * User: Olivier Herzog
 * Date: 12/08/2017
 * Time: 20:30
 */

namespace Action;

use App\Router;
use Domain\Database;
use Responder\GetArticlesResponder;

class GetArticlesAction
{
    private $db;
    private $responder;
    private $request;

    public function __construct(
        Router $request,
        GetArticlesResponder $responder,
        Database $db
    )
    {
        $this->request = $request;
        $this->db = $db;
        $this->responder = $responder;
    }

    public function __invoke()
    {
        $data = $this->db->queryAllExcerpt('id, titre','contenu',300,'articles');
        $this->responder->setData($data);
        return $this->responder->__invoke();
    }
}

