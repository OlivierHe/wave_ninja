<?php
/**
 *  * User: Olivier Herzog
 * Date: 05/08/2017
 * Time: 14:02
 */

namespace Action;

use App\Router;
use Domain\Database;
use Responder\ReportCommentResponder;


class ReportCommentAction
{
    private $db;
    private $responder;
    private $request;

    public function __construct(
        Router $request,
        ReportCommentResponder $responder,
        Database $db
    )
    {
        $this->request = $request->request;
        $this->db = $db;
        $this->responder = $responder;
    }

    public function __invoke()
    {

        if(isset($_COOKIE['user'])) {
            if ($_COOKIE['user'] === '0') {
                setcookie('user', '1', time() + 86400, "/");
                $com_id = $this->request;


                $this->db->updateOneValueWhere('commentaires', 'signale', '+ 1', array($com_id));
                $this->responder->setData(['content'=>'Commentaire signalé !','params'=>'rounded orange']);
            } else {
                $this->responder->setData(['content'=>'Vous ne pouvez faire qu\'un signalement par jour !','params'=>'rounded red']);
            }
            return $this->responder->__invoke();
        }
    }
}