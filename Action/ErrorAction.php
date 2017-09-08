<?php
/**
 *  * User: Olivier Herzog
 * Date: 11/08/2017
 * Time: 18:29
 */

namespace Action;

use App\Router;
use Domain\Database;
use Responder\ErrorResponder;

class ErrorAction
{
    private $db;
    private $responder;
    private $request;

    public function __construct(
        Router $request,
        ErrorResponder $responder,
        Database $db
    )
    {
        $this->request = $request->request;
        $this->db = $db;
        $this->responder = $responder;
    }

    public function __invoke()
    {

        $data = null;

        if ($this->request) {
            switch ($this->request) {
                case '403':
                    $data = "HTTP/1.0 403 Forbidden";
                    break;
                case '404' :
                    $data = "HTTP/1.0 404 Not Found";
                    break;
                default:
                    $data = "HTTP/1.0 404 Not Found";
                    break;
            }
        } else {
            $data = "HTTP/1.0 404 Not Found";
        }

        $this->responder->setData($data);
        return $this->responder->__invoke();
    }

}
