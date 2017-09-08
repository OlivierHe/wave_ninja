<?php
/**
 *  * User: Olivier Herzog
 * Date: 07/08/2017
 * Time: 17:01
 */

namespace Action;


use App\Router;
use App\Settings;
use Domain\Database;
use Responder\ViewLoginResponder;


class ViewLoginAction
{
    private $db;
    private $responder;
    private $request;
    private $config;

    public function __construct(
        Router $request,
        ViewLoginResponder $responder,
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
        $this->responder->setConfig($this->config);
        return $this->responder->__invoke();
    }
}