<?php
/**
 *  * User: Olivier Herzog
 * Date: 15/08/2017
 * Time: 23:57
 */

namespace Responder;


class UpdatePassResponder
{
    private $data;

    public function __invoke()
    {
        $data = $this->data;
        if ($_SESSION['type'] === 'ADMIN') {
            echo json_encode($this->data);
        }else {
            return $data;
        }

    }

    public function setData($data)
    {
        $this->data = $data;
    }


}