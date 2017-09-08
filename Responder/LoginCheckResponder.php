<?php
/**
 *  * User: Olivier Herzog
 * Date: 07/08/2017
 * Time: 20:58
 */

namespace Responder;


class LoginCheckResponder
{
    private $data;


    public function __invoke()
    {
       echo json_encode($this->data);

    }

    public function setData($data)
    {
        $this->data = $data;
    }
}