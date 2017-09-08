<?php
/**
 * Created by PhpStorm.
 * User: MiniTarlouf
 * Date: 31/07/2017
 * Time: 16:33
 */

namespace Action;

use App\Router;
use Domain\Database;
use Responder\InsertCommentResponder;


class InsertCommentAction
{
    private $db;
    private $responder;
    private $request;
    private $censure;

    public function __construct(
        Router $request,
        InsertCommentResponder $responder,
        Database $db
    )
    {
        $this->request = $request->request;
        $this->db = $db;
        $this->responder = $responder;
    }

    public function __invoke()
    {

        $article_id = $this->request[0];
        $sous_com_id = ($this->request[1] === '0') ? null : $this->request[1];
        $pseudo = htmlspecialchars($this->request[2]);
        $email = htmlspecialchars($this->request[3]);
        $comment = htmlspecialchars($this->request[4]);

        session_start();
        if (isset($_SESSION["type"])) {
            if ($_SESSION["type"] === 'ADMIN') {
                $this->censure = ['ras'];
            }
        }else{
            $this->censure = ['jeanforteroche','jf','jean forteroche','modérateur','admin','modo','administrateur'];
        }

        if(in_array(strtolower($pseudo),$this->censure)){
            $this->responder->setData(['content' => 'L\'utilisation du pseudonyme, '.$pseudo.' sous toutes ses formes, est reservé', 'params' => 'rounded red']);
        }else {
            $this->db->insertComment(array($article_id, $sous_com_id, $pseudo, $email, $comment, 0, $_SERVER['REMOTE_ADDR']));
            $this->responder->setData(['content' => 'Commentaire ajouté !', 'params' => 'rounded green']);
        }
            return $this->responder->__invoke();

    }

}