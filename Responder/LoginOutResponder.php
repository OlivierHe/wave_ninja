<?php
/**
 *  * User: Olivier Herzog
 * Date: 09/08/2017
 * Time: 15:29
 */

namespace Responder;


class LoginOutResponder
{
    private $data;

    public function __invoke()
    {
        echo json_encode($this->data);
    }

    public function setData($data){
        $this->data = $data;
    }
}