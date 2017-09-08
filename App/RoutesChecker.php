<?php
/**
 * Created by PhpStorm.
 * User: MiniTarlouf
 * Date: 22/07/2017
 * Time: 18:36
 */

namespace App;


class RoutesChecker
{
    private $value;

    private function controlType($args_num, $pathName)
    {
        if ($args_num === 1) {
            return (is_string($_REQUEST['p']));
        } elseif ($args_num === 2) {
            $this->value['args'] = $_REQUEST['n'];
            return (is_string($_REQUEST['p']) && ctype_digit($_REQUEST['n']));
        } elseif ($args_num === 3) {
            $this->value['args'] = [$_REQUEST['n'],$_REQUEST['image_delete']];
            return (is_string($_REQUEST['p']) && ctype_digit($_REQUEST['n']) && is_string($_REQUEST['image_delete']));
        } elseif ($args_num === 4) {
            $fieldName = [];
            if ($pathName === 'login_check' || $pathName === 'update_pass') {
                $fieldName = ['identifiant','password'];
            }elseif ($pathName === 'insert_article') {
                $fieldName = ['titre', 'article'];
            }elseif ($pathName === 'update_article'){
                $fieldName = ['titre', 'article'];
                $this->value['args'] = [$_REQUEST['n']];
            }

            array_push($this->value['args'],$_REQUEST[$fieldName[0]],$_REQUEST[$fieldName[1]]);
            return (is_string($_REQUEST['p']) && ctype_digit($_REQUEST['n']) && is_string($_REQUEST[$fieldName[0]]) && is_string($_REQUEST[$fieldName[1]]));

        } else if ($args_num === 6) {
            $this->value['args'] = [$_REQUEST['n'],$_REQUEST['sous_com'],$_REQUEST['pseudo'],$_REQUEST['email'],$_REQUEST['comment']];
            return (is_string($_REQUEST['p'])
                && ctype_digit($_REQUEST['n'])
                && ctype_digit($_REQUEST['sous_com'])
                && is_string($_REQUEST['pseudo'])
                && filter_var($_REQUEST['email'], FILTER_VALIDATE_EMAIL)
                && is_string($_REQUEST['comment'])
            );

        }
        return $nop = false;
    }

    public function getPath()
    {
        $routes_paths = require "Config/routes_paths.php";
        if(!isset($_COOKIE['user'])) {
            setcookie('user', '0', time() + 86400, "/");
        }
        
        if (count($_REQUEST) !== 0) {
            $routing = null;
            $args_num = null;
            $go_ahead = $routes_paths['error'];
            foreach ($routes_paths as $key => $value) {
                // verifie si l'argument page est bon
                if ($_REQUEST['p'] == $key) {
                    // vérification du type de méthode utilisée
                    if ($_SERVER['REQUEST_METHOD'] === $value['method']) {
                        // verification du nombres d'arguments dans la requete
                        foreach ($_REQUEST as $req) {
                            if ($req !== "") {

                                $args_num++;
                            }
                        }
                        // si bon nombres d'arguments on rentre
                        if ($value['args_num'] === $args_num) {
                            $this->value = $value;
                            if ($this->controlType($args_num, $key)) {
							
                                $go_ahead = $this->value;
                                break;
                            }
                        }

                    }
                }
            }

        } else {
            $go_ahead = $routes_paths['home'];
        }

        return $go_ahead;

    }
}
