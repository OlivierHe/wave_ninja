<?php
/**
 * Created by PhpStorm.
 * User: MiniTarlouf
 * Date: 16/07/2017
 * Time: 20:39
 */

namespace Action;

use App\Router;
use App\Settings;
use Responder\HomeResponder;

class HomeAction
{
    private $responder;
    private $request;
    private $config;

    public function __construct(
        Router $request,
        HomeResponder $responder,
        Settings $config
    )
    {
        $this->request = $request->request;
        $this->responder = $responder;
        $this->config = $config;
    }

    public function __invoke()
    {
        //$data = $this->db->queryAllExcerpt('id, titre','contenu',300,'articles');
        $this->responder->setConfig($this->config);
        //$this->responder->setData($data);

        return $this->responder->__invoke();
    }
}
