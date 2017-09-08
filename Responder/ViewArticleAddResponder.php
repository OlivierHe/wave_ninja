<?php
/**
 *  * User: Olivier Herzog
 * Date: 11/08/2017
 * Time: 18:01
 */

namespace Responder;


class ViewArticleAddResponder
{
    private $data;
    private $config;

    public function __invoke()
    {
        $data = $this->data;
        $http_host = $this->config->http_host;
        if ($data) {
            return $data;
        } else {
            ob_start();
            require '../Views/ajouter_article.php';
            $scriptTop = '<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=6wicdj8y1mi3113p0g6beirmspruhjakl7yy45q8g3y2qqg7"></script>
                        <script>
                            tinymce.init({
                                image_dimensions: false,
                                image_class_list: [
                                    {title: \'Responsive\', value: \'responsive-img\'}
                                ],
                                selector: \'div#tinymce\',
                                language_url: \'js/tiny_mce/langs/fr_FR.js\',
                                skin_url: "css/jftinymceskin",
                                plugins: [
                                    "advlist autolink autosave link image lists charmap print preview hr anchor pagebreak",
                                    "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                                    "table contextmenu directionality emoticons template textcolor paste textcolor colorpicker textpattern"
                                ],
                                toolbar1: "| undo redo | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | styleselect formatselect",
                                toolbar2: "cut copy paste | searchreplace | bullist numlist | outdent indent blockquote  | insertdatetime preview | forecolor backcolor",
                                toolbar3: "table | hr removeformat | charmap emoticons | print fullscreen | ltr rtl | visualchars visualblocks nonbreaking pagebreak restoredraft",
                                menubar: true,
                                relative_urls : false,
                                remove_script_host : false,
                                height : "300"
                            });
                        </script>';
            $content = ob_get_clean();
            $script = '<script src="http://'.$http_host.'/blog_ecrivain/js/ajouter_article.js"></script>';
            require '../Views/templates/default.php';
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
