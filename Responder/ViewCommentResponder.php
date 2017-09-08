<?php
/**
 *  * Created by PhpStorm.
 * User: Olivier Herzog
 * Date: 02/08/2017
 * Time: 13:30
 */

namespace Responder;


class ViewCommentResponder
{

    private $data;

    public function __invoke()
    {
        $data = $this->data;
        require '../Views/view_com.php';
    }

    public function setData($data)
    {
        $this->data = $data;
    }
}