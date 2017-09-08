<?php
/**
 *  * User: Olivier Herzog
 * Date: 14/08/2017
 * Time: 16:26
 */

namespace Responder;


class GetCommentsResponder
{
    private $data;

    public function __invoke()
    {

        $data = $this->data;
        if ($_SESSION['type'] === 'ADMIN') {
            echo json_encode(["data" => $data]);
            return;
        } else{
            return $data;
        }
    }

    public function setData($data)
    {
        $this->data = $data;
    }

}