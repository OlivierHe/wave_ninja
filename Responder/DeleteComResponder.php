<?php
/**
 *  * User: Olivier Herzog
 * Date: 14/08/2017
 * Time: 16:47
 */

namespace Responder;


class DeleteComResponder
{
    private $data;

    public function __invoke()
    {
        $data = $this->data;
        if (count($data) === 2) {
            echo json_encode($this->data);
            return null;
        }else {
            return $data;
        }

    }

    public function setData($data)
    {
        $this->data = $data;
    }
}