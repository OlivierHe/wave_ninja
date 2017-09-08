<?php
/**
 *  * User: Olivier Herzog
 * Date: 15/08/2017
 * Time: 17:48
 */

namespace Action;

use App\Router;
use App\Settings;
use Domain\Database;
use Responder\UploadPicResponder;

class UploadPicAction
{
    private $db;
    private $responder;
    private $request;

    public function __construct(
        Router $request,
        UploadPicResponder $responder,
        Database $db,
        Settings $config
    )
    {
        $this->request = $request->request;
        $this->db = $db;
        $this->responder = $responder;
        $this->config = $config;
    }

    public function __invoke()
    {
        session_start();
        if ($_SESSION['type'] === 'ADMIN') {

            if(isset($_FILES['file']))
            {
                $dossier = '../Public/img/';
                $fichier = basename($_FILES['file']['name']);
                $taille_maxi = 400000;
                $taille = filesize($_FILES['file']['tmp_name']);
                $extensions = array('.png', '.gif', '.jpg', '.jpeg');
                $extension = strrchr($_FILES['file']['name'], '.');
                if (!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
                {
                    $erreur = 'Vous devez uploader un fichier de type png, gif, jpg, jpeg !';
                }
                if ($taille > $taille_maxi) {
                    $erreur = 'Le fichier est trop gros...';
                }
                if(!isset($erreur))
                {
                    //On formate le nom du fichier ici...
                    $fichier = strtr($fichier,
                        'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ',
                        'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
                    $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);

                    if (move_uploaded_file($_FILES['file']['tmp_name'], $dossier . $fichier)) {

                        $this->responder->setData(['titre' => 'Téléversement', 'content' => 'Effectué avec succès !', 'params' => 'success']);
                    } else {
                        $this->responder->setData(['titre' => 'Téléversement', 'content' => 'Echec durant le téléversement !', 'params' => 'error']);
                    }
                }else{
                    $this->responder->setData(['titre' => 'Téléversement', 'content' => $erreur, 'params' => 'error']);
                }
            }
        } else {
            $this->responder->setData(header('Location: http://'.$this->config->http_host.'/blog_ecrivain/error/403'));
        }
        $this->responder->setConfig($this->config);
        return $this->responder->__invoke();

    }

}