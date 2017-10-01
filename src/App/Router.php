<?php
/**
 * Created by PhpStorm.
 * User: MiniTarlouf
 * Date: 16/07/2017
 * Time: 18:50
 */

namespace WaveNinja\App;


class Router
{
    public $request;

    public function callAction()
    {
       $route = new RoutesChecker();
       $path = $route->getPath();
       $this->request = $path['args'];

       $goAction = new $path['action_route']($this,new $path['responder_route'](),new Settings());
       $goAction();
    }

}
