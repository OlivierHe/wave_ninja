<?php
/**
 *  * User: Olivier Herzog
 * Date: 09/08/2017
 * Time: 15:29
 */

namespace Action;

use App\Router;
use Domain\Database;
use Responder\LoginOutResponder;


class LoginOutAction
{
    private $db;
    private $responder;
    private $request;

    public function __construct(
        Router $request,
        LoginOutResponder $responder,
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
        unset($_SESSION['pseudonyme']);
        unset($_SESSION['type']);

        $this->responder->setData(['content' => 'Vous êtes déconnecté', 'params' => 'rounded green']);
        return $this->responder->__invoke();
    }
}