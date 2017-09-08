<?php
/**
 *  * User: Olivier Herzog
 * Date: 15/08/2017
 * Time: 23:57
 */

namespace Action;

use App\Router;
use App\Settings;
use Domain\Database;
use Responder\UpdatePassResponder;


class UpdatePassAction
{
    private $db;
    private $responder;
    private $request;
    private $config;

    public function __construct(
        Router $request,
        UpdatePassResponder $responder,
        Database $db,
        Settings $config
    )
    {
        $this->request = $request->request;
        $this->db = $db;
        $this->responder = $responder;
        $this->config = $config;
    }

    public function __invoke(){
        session_start();
        if ($_SESSION['type'] === 'ADMIN') {
            $identifiant = $this->request[0];
            $password = $this->request[1];

            $hash = password_hash($password,PASSWORD_DEFAULT);
            $this->db->updateTwoValueWhere('login',['identifiant','password_hash'],[$identifiant,$hash,'1']);
            $this->responder->setData(['content' => 'Modification effectuée, Reconnectez vous']);
        }else{
            $this->responder->setData(header('Location: http://'.$this->config->http_host.'/blog_ecrivain/error/403'));
        }
        return $this->responder->__invoke();
    }

}