<?php
/**
 *  * User: Olivier Herzog
 * Date: 13/08/2017
 * Time: 11:06
 */

namespace Responder;


class GetOneArticleResponder
{
    private $data;
    private $config;

    public function __invoke()
    {
        $data = $this->data;
        $http_host = $this->config->http_host;

        if ($_SESSION['pseudonyme']) {
            ob_start();
            require '../Views/getone_article.php';
            //$resultat = str_replace(['\r\n','\r','\n'], '', $data[0]->contenu);
            $resultat = str_replace("\n", "", $data[0]->contenu);
            $resultat = str_replace("'", "\'", $resultat);
            $scriptTop = '<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=6wicdj8y1mi3113p0g6beirmspruhjakl7yy45q8g3y2qqg7"></script>
                        <script>
                            tinymce.init({  
                                image_dimensions: false,
                                image_class_list: [
                                    {title: \'Responsive\', value: \'responsive-img\'}
                                ],
                                selector: \'div#tinymce\',
                                language_url: \'../js/tiny_mce/langs/fr_FR.js\',
                                skin_url: "../css/jftinymceskin",
                                plugins: [
                                    "advlist autolink link image lists charmap print preview hr anchor pagebreak",
                                    "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                                    "table contextmenu directionality emoticons template textcolor paste textcolor colorpicker textpattern"
                                ],
                                toolbar1: "| undo redo | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | styleselect formatselect",
                                toolbar2: "cut copy paste | searchreplace | bullist numlist | outdent indent blockquote  | insertdatetime preview | forecolor backcolor",
                                toolbar3: "table | hr removeformat | charmap emoticons | print fullscreen | ltr rtl | visualchars visualblocks nonbreaking pagebreak restoredraft",
                                menubar: true,
                                height : "300",
                                relative_urls : false,
                                remove_script_host : false,
                                init_instance_callback: "insert_contents"
                            });';
            $scriptTop .= "function insert_contents(inst){
                               inst.setContent('". $resultat . "'); 
                            }
                        </script>";

            $content = ob_get_clean();
            $script = '<script src="http://'.$http_host.'/blog_ecrivain/js/getone_article.js"></script>';
            require '../Views/templates/default.php';
        } else {
            return $data;
        }

    }

    public function setData($data)
    {
        $this->data = $data;
    }

    public function setConfig($config)
    {
        $this->config = $config;
    }
}
