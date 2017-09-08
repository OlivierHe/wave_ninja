<?php
/**
 *  * Created by PhpStorm.
 * User: Olivier Herzog
 * Date: 02/08/2017
 * Time: 13:30
 */

namespace Action;

use App\Router;
use Domain\Database;
use Responder\ViewCommentResponder;


class ViewCommentAction
{
    private $db;
    private $responder;
    private $request;

    public function __construct(
        Router $request,
        ViewCommentResponder $responder,
        Database $db
    )
    {
        $this->request = $request->request;
        $this->db = $db;
        $this->responder = $responder;
    }

    public function __invoke()
    {

        $data = $this->db->queryByAndNull(
            'commentaires',
            'article_id',
            'sous_com_id',
            array($this->request)
        );

        $sousCom = $this->db->queryByAndNotNull(
            'commentaires',
            'article_id',
            'sous_com_id',
            array($this->request)
        );


        rsort($data);
        foreach ($sousCom as $scVal) {
                foreach($data as $mcKey => $mcVal) {
                    if ($scVal->sous_com_id == $mcVal->id) {
                        array_splice($data, $mcKey +1  ,0,array($scVal));
                    }
                }
        }


        $this->responder->setData($data);
        return $this->responder->__invoke();
    }

}