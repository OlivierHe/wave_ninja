<?php
/**
 *  * User: Olivier Herzog
 * Date: 07/08/2017
 * Time: 20:58
 */

namespace Action;

use App\Router;
use Domain\Database;
use Responder\LoginCheckResponder;


class LoginCheckAction
{
    private $db;
    private $responder;
    private $request;

    public function __construct(
        Router $request,
        LoginCheckResponder $responder,
        Database $db
    )
    {
        $this->request = $request->request;
        $this->db = $db;
        $this->responder = $responder;
    }

    public function __invoke()
    {
        $identifiant = $this->request[0];
        $password = $this->request[1];

        $data = $this->db->queryBy('login','identifiant',array($identifiant));

        if ($data && password_verify($password, $data[0]->password_hash)) {
            session_start();
            $_SESSION['pseudonyme'] = $data[0]->pseudonyme;
            $_SESSION['type'] = $data[0]->type;

            $this->responder->setData(['content' => 'Connexion réussie, Bienvenue ' . $data[0]->pseudonyme, 'params' => 'rounded green']);
        } else {
            $this->responder->setData(['content' => 'Echec de la connexion !', 'params' => 'rounded red']);
        }
        return $this->responder->__invoke();
    }
}