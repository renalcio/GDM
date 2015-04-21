<?
use Libs\SessionHelper;
use Libs\Helper;
$db = new Libs\UnitofWork();
$sessao = new SessionHelper("GDMAuth");

?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>MediaSpot</title>
    <meta name="description" content="Ouvir Musica Online, Videos e Imagens.">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />

    <!-- Ionicons -->
    <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!--CSS-->
    <script>
        var SiteURL = "<?=URL?>";
    </script>
    <? \Libs\Helper::LoadMedia("css",[
        "bootstrap/css/bootstrap.min.css",
        "dist/css/style.css",
        "dist/css/AdminLTE.css",
        "dist/css/skins/_all-skins.css",
        "dist/css/avatar.css"
    ]);
    echo "<!--JAVASCRIPT-->\n";
    \Libs\Helper::LoadMedia("js", [
        //JQUERY
        "dist/js/jquery.js",
        //BOOTSTRAP
        "bootstrap/js/bootstrap.min.js",
        //TEMA
        "dist/js/app.js",
        //"dist/js/demo.js"
    ]);

    echo "\n<!--ASSETS-->\n";
    $this->AddAsset(["fastclick","bootstrap-switch", "datatables", "select2", "jquery.maskedinput", "datepicker", "jquery.gritter","moment", "ionslider", "bootstrap-typeahead", "jquery.cookie"]);
    $this->PrintAssets();

    echo "\n<!--/ASSETS-->\n";

    echo "\n<!--JAVASCRIPT-->\n";
    \Libs\Helper::LoadMedia("js", [
        //HELPER
        "dist/js/helper.js",
        "dist/js/pessoa.js",
        "dist/js/avatar.js",
        "dist/js/functions.js"
    ]);
    ?>
    <script>
        $(function(){
            var Resultados = new Bloodhound({
                datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
                queryTokenizer: Bloodhound.tokenizers.whitespace,
                prefetch: '<?=URL?>handler/artista/Consulta/',
                remote: '<?=URL?>handler/artista/Consulta/?query=%QUERY'
            });

            Resultados.initialize();

            $('#navbar-search-input').typeahead({
                hint: true,
                highlight: true,
                minLength: 1
            }, {
                name: 'busca-q',
                displayKey: 'value',
                source: Resultados.ttAdapter(),
                templates: {
                    empty: [
                        '<p style="padding: 0 12px;">',
                        'Nenhum artista encontrado, pressione enter para uma pesquisa personalizada',
                        '</p>'
                    ].join('\n'),
                    suggestion: Handlebars.compile('<p>{{name}}</p>')
                }
            });
            $('#navbar-search-input').on(['typeahead:selected'].join(' '), function(item){
                var id = $(this).val();
                $(this).val("");
                //console.log(id);
                location.href = "<?=URL?>Player/Index/"+id;
            });

            $('#navbar-search-input').keyup(function(e) {
                if (e.keyCode == 13) {
                    setTimeout(function(){
                        $("#buscaForm").submit();
                    }, 800);
                }
            });
        });
    </script>

<style>
    * {
        -moz-user-select: none;
        -khtml-user-select: none;
        -webkit-user-select: none;
        user-select: none;
    }
</style>
</head>
<body class="skin-blue layout-top-nav fixed">
<div class="wrapper">

    <header class="main-header">
        <nav class="navbar navbar-static-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a href="<?=Helper::getUrl("Index","Home");?>" class="navbar-brand"><b>Media</b>Spot</a>
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                        <i class="fa fa-bars"></i>
                    </button>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="<?=Helper::getUrl("Index","Home");?>">Músicas <span class="sr-only">(current)</span></a></li>
                        <li><a href="<?=Helper::getUrl("Index","Video");?>">Vídeos</a></li>
                        <li><a href="<?=Helper::getUrl("Index","Imagem");?>">Imagens</a></li>
                    </ul>
                    <form class="navbar-form navbar-left" role="search" id="buscaForm" method="post" action="<?=\Libs\Helper::getUrl("Index",
                        "Busca");?>">
                        <div class="form-group">
                            <input type="text" class="form-control" id="navbar-search-input" placeholder="Buscar Artistas ou Músicas" autocomplete="off" name="q">
                        </div>
                    </form>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#">Entrar</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Olá, Renalcio <span
                                    class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Action</a></li>
                                <li><a href="#">Another action</a></li>
                                <li><a href="#">Something else here</a></li>
                                <li class="divider"></li>
                                <li><a href="#">Separated link</a></li>
                            </ul>
                        </li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
    </header>

    <!-- Full Width Column -->
    <div class="content-wrapper">
            <section class="content">
