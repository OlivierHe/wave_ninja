<?php
/**
 * Created by PhpStorm.
 * User: olivier
 * Date: 2017-06-27
 * Time: 21:48
 */
// si session enabled but none exist

$config = new WaveNinja\App\Settings();
$http_host = $config->http_host;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
    <title>Wave ninja / Trouvez les meilleures conditions de surf</title>

    <!-- CSS  -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.99.0/css/materialize.min.css">
    <style type="text/css">
        body {
            background-image: linear-gradient(to bottom,#e0f2f1 0,#2196f3 100%);
            /* fix bg */
            height: 100%;
            margin: 0;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }
        .section {
            padding-top: 0;
            min-height: 700px;
        }

        .card, .card-panel {
            background : white;
            transition: box-shadow .25s;
            border-radius: 10px;
        }

        .pagination li a {
            color: white;
            display: inline-block;
            font-size: 1.2rem;
            padding: 0 10px;
            line-height: 30px;
        }



        .pagitop {
            box-shadow: 0 6px 10px 0 rgba(0, 0, 0, 0.14), 0 3px 5px -1px rgba(0, 0, 0, 0.3);
            border-radius: 0 0 10px 10px;
            margin-top: 0;
        }

        .pagibot {
            box-shadow: 0 6px 10px 0 rgba(0,0,0,0.14), 0 1px 18px 0 rgba(0,0,0,0.12), 0 3px 5px -1px rgba(0,0,0,0.3);
            border-radius: 10px 10px 0 0;
            margin-top: 1px;
            margin-bottom: 0;
        }

        img.responsive-img, video.responsive-video {
            max-width: 100%;
            height: auto;
            display: block;
            margin: 0 auto;
        }

        .comments{
            animation-duration: 0.5s;
            animation-timing-function: ease-in;
        }
        .btn-floating.btn-large {
            border: 2px solid white;
        }


    </style>
    <!--  Scripts  -->
    <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <?= $scriptstop = isset($scriptTop) ? $scriptTop : ''; ?>

</head>
<body>
<img class="responsive-img" src="http://<?= $http_host ?>/wave_ninja/img/header_surf.jpg">
<nav class="blue" role="navigation">
    <div class="nav-wrapper container">
        <a id="logo-container" href="http://<?= $http_host ?>/wave_ninja/home" class="brand-logo">Wave Ninja</a>
        <ul class="right hide-on-med-and-down">
            <li><a href="http://<?= $http_host ?>/wave_ninja/home"><i class="small material-icons left orange-text text-lighten-3">home</i>Accueil</a></li>
        </ul>


        <ul id="nav-mobile" class="side-nav">
            <li><a href="http://<?= $http_host ?>/wave_ninja/home"><i class="small material-icons left orange-text text-lighten-3">home</i>Accueil</a></li>
            <li class="divider"></li>
        </ul>
        <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
    </div>
</nav>



<div class="section no-pad-bot" id="index-banner">
    <div class="container">
        <!--  short hand pour echo-->
        <?= $content ?>

        <div class="comments">
        </div>


    </div>
</div>




<footer class="page-footer blue darken-1">
    <div class="container">
        <div class="row">
            <div class="col l6 s12">
                <h5 class="white-text">Wave Ninja c'est quoi ?</h5>
                <p class="grey-text text-lighten-4">Wave ninja, est un site qui vous aide
                à trouver les conditions de surf parfaites.</p>
                <p class="grey-text text-lighten-4">Wave ninja, utilise les données du modèle "SWAN" fournies gratuitement par Le "Marine institute ERDAPP (Ireland)"
                </p>


            </div>
          <!--  <div class="col l3 s12">
                <h5 class="white-text">Articles récents</h5>
                <ul>
                 placeholder
                </ul>
            </div>
            <div class="col l3 s12">
                placeholder
            </div> -->
        </div>
    </div>
    <div class="footer-copyright">
        <div class="container">
            Made with <a class="orange-text text-lighten-3" href="http://materializecss.com">Materialize</a> By <span class="orange-text text-lighten-3">Olivier Herzog</span>
        </div>
    </div>
</footer>


<!-- Compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.99.0/js/materialize.min.js"></script>
<script>$http_host = '<?= $http_host ?>'; </script>
<script src="http://<?= $http_host ?>/wave_ninja/js/defaut.js"></script>

<?= $scripts = isset($script) ? $script : ''; ?>
</body>
</html>
