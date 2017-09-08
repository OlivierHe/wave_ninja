<?php
/**
 *  * User: Olivier Herzog
 * Date: 11/08/2017
 * Time: 18:30
 */

namespace Responder;


class ErrorResponder
{
    private $data;

    public function __invoke()
    {
        $data = $this->data;
        header($data);
    }

    public function setData($data)
    {
        $this->data = $data;
    }

}