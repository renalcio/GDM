<?
use Libs\SessionHelper;
use Libs\Helper;
$db = new Libs\UnitofWork();
$sessao = new SessionHelper("GDMAuth");
//$HUser = $db->select("SELECT * FROM UsuarioAplicacao WHERE UsuarioId = '". $sessao->Ver("UsuarioId")."' AND AplicacaoId = '". $sessao->Ver("AplicacaoId")."'", "Model\\UsuarioAplicacao");
$HUser = new \Model\UsuarioAplicacao();
$HUser = $db->Get(new \Model\UsuarioAplicacao(), "UsuarioId = '". $sessao->Ver("UsuarioId")."' AND AplicacaoId = '". $sessao->Ver("AplicacaoId")."'")->First();
//var_dump($HUser);
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>ClassHub</title>
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
<body class="skin-blue">

<!-- Login -->

<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginTitulo" aria-hidden="true">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Fechar</span></button>

                <h4 class="modal-title" id="loginTitulo" style="text-transform:capitalize">Entrar</h4>

            </div>

            <div class="modal-body">

                <? Helper::LoadView("index", "login");?>

            </div>



        </div>

    </div>

</div>

<div class="wrapper">
    <header class="main-header">
        <!-- Logo -->
        <a href="<?=URL?>home/" class="logo"><b>Class</b>Hub</a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Alternar Navegaçao</span>
            </a>
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">

                    <!-- Tasks: style can be found in dropdown.less -->
                    <li class="dropdown tasks-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-flag-o"></i>
                            <span class="label label-danger">9</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">You have 9 tasks</li>
                            <li>
                                <!-- inner menu: contains the actual data -->
                                <ul class="menu">
                                    <li><!-- Task item -->
                                        <a href="#">
                                            <h3>
                                                Design some buttons
                                                <small class="pull-right">20%</small>
                                            </h3>
                                            <div class="progress xs">
                                                <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                    <span class="sr-only">20% Complete</span>
                                                </div>
                                            </div>
                                        </a>
                                    </li><!-- end task item -->
                                    <li><!-- Task item -->
                                        <a href="#">
                                            <h3>
                                                Create a nice theme
                                                <small class="pull-right">40%</small>
                                            </h3>
                                            <div class="progress xs">
                                                <div class="progress-bar progress-bar-green" style="width: 40%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                    <span class="sr-only">40% Complete</span>
                                                </div>
                                            </div>
                                        </a>
                                    </li><!-- end task item -->
                                    <li><!-- Task item -->
                                        <a href="#">
                                            <h3>
                                                Some task I need to do
                                                <small class="pull-right">60%</small>
                                            </h3>
                                            <div class="progress xs">
                                                <div class="progress-bar progress-bar-red" style="width: 60%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                    <span class="sr-only">60% Complete</span>
                                                </div>
                                            </div>
                                        </a>
                                    </li><!-- end task item -->
                                    <li><!-- Task item -->
                                        <a href="#">
                                            <h3>
                                                Make beautiful transitions
                                                <small class="pull-right">80%</small>
                                            </h3>
                                            <div class="progress xs">
                                                <div class="progress-bar progress-bar-yellow" style="width: 80%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                    <span class="sr-only">80% Complete</span>
                                                </div>
                                            </div>
                                        </a>
                                    </li><!-- end task item -->
                                </ul>
                            </li>
                            <li class="footer">
                                <a href="#">View all tasks</a>
                            </li>
                        </ul>
                    </li>
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="<?=$HUser->Usuario->Avatar;?>" class="user-image" alt="User Image"/>
                            <span class="hidden-xs"><?=Helper::Abreviar($HUser->Usuario->Pessoa->Nome);?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="<?=$HUser->Usuario->Avatar;?>" class="img-circle" alt="User Image" />
                                <p>
                                    <?=Helper::Abreviar($HUser->Usuario->Pessoa->Nome);?> - Web Developer
                                    <small>Member since Nov. 2012</small>
                                </p>
                            </li>
                            <!-- Menu Body -->
                            <li class="user-body">
                                <div class="col-xs-4 text-center">
                                    <a href="#">Followers</a>
                                </div>
                                <div class="col-xs-4 text-center">
                                    <a href="#">Sales</a>
                                </div>
                                <div class="col-xs-4 text-center">
                                    <a href="#">Friends</a>
                                </div>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="<?=Helper::getUrl("selecionaAplicacao", "login");?>" class="btn btn-default btn-flat">Selecionar Aplicaçao</a>
                                </div>
                                <div class="pull-right">
                                    <a href="<?=Helper::getUrl("logout", "login");?>" class="btn btn-default btn-flat">Sair</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="<?=$HUser->Usuario->Avatar;?>" class="img-circle" alt="User Image" />
                </div>
                <div class="pull-left info">
                    <p><?=Helper::Abreviar($HUser->Usuario->Pessoa->Nome);?></p>

                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>
            <!-- search form -->
            <script>
                $(function(){
                    $("#BuscaSidebarForm").submit(function(){
                        var termo = $("#BuscaSidebar", this).val();
                        $(".sidebar-menu li").hide();
                        if(termo.length > 0){
                            $(".sidebar-menu>li:contains('"+termo+"')").show();
                        }else{
                            $(".sidebar-menu li").show();
                        }
                        return false;
                    });
                });
            </script>
            <form action="#" method="get" id="BuscaSidebarForm" class="sidebar-form">
                <div class="input-group">
                    <input type="text" name="q" id="BuscaSidebar" class="form-control" placeholder="Pesquisar..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
                </div>
            </form>
            <!-- /.search form -->
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <?php \Libs\Helper::LoadView("menu","menu"); ?>
        </section>
        <!-- /.sidebar -->
    </aside>
    <!-- Full Width Column -->
    <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1 style="text-transform: capitalize;">

                <?
                $Tctrl = $this->GetControllerTitle();
                echo $Tctrl;
                ?>

                <?
                $Tact = $this->GetActionTitle();
                //var_dump($Tact);
                //if(strtolower($Tact) != strtolower($Tctrl)){ ?>
                <small><?=$Tact;?></small>
                <? //} ?>
            </h1>
            <ol class="breadcrumb" style="text-transform: capitalize;">
                <li><a href="<?=URL;?>home/"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active"><a href="<?=URL . \Libs\Helper::getController();?>"><?=$Tctrl;?></a></li>
                <? if(strtolower($Tact) != ""){ ?>
                    <li class="active"><a href="<?=URL . \Libs\Helper::getController() . "/" . \Libs\Helper::getAction(); ?>"><?=$Tact;?></a></li>
                <? } ?>
            </ol>
        </section>
        <section class="content">
