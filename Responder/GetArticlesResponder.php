<?php
/**
 *  * User: Olivier Herzog
 * Date: 12/08/2017
 * Time: 20:31
 */

namespace Responder;


class GetArticlesResponder
{
    private $data;

    public function __invoke()
    {
        $data = $this->data;
        echo json_encode(['data' => $data]);
    }

    public function setData($data)
    {
        $this->data = $data;
    }

}
