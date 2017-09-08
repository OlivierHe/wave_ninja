<?php
/**
 *  * User: Olivier Herzog
 * Date: 13/08/2017
 * Time: 15:27
 */

namespace Responder;


class DeleteArticleResponder
{
    private $data;

    public function __invoke()
    {
        $data = $this->data;
        if (count($data) === 2) {
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