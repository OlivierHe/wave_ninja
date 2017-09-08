<?php
/**
 *  * User: Olivier Herzog
 * Date: 05/08/2017
 * Time: 15:19
 */

namespace Responder;


class ReportCommentResponder
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