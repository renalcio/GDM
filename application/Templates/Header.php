<?
use Libs\SessionHelper;
use Libs\Helper;
$db = new Libs\UnitofWork();
$sessao = new SessionHelper("GDMAuth");
//$HUser = $db->select("SELECT * FROM UsuarioAplicacao WHERE UsuarioId = '". $sessao->Ver("UsuarioId")."' AND AplicacaoId = '". $sessao->Ver("AplicacaoId")."'", "DAL\\UsuarioAplicacao");
$HUser = new \DAL\UsuarioAplicacao();
$HUser = $db->Get(new \DAL\UsuarioAplicacao(), "UsuarioId = '". $sessao->Ver("UsuarioId")."' AND AplicacaoId = '". $sessao->Ver("AplicacaoId")."'")->First();
//var_dump($HUser);
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title><?=$HUser->Aplicacao->Titulo?></title>
    <meta name="description" content="Gerenciador de Dados Modular">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

    <!-- JS -->
    <!-- please note: The JavaScript files are loaded in the footer to speed up page construction -->
    <!-- See more here: http://stackoverflow.com/q/2105327/1114320 -->


    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />

    <!-- Ionicons -->
    <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <script>
        var SiteURL = "<?=URL?>";
    </script>

    <!--CSS-->
    <? \Libs\Helper::LoadMedia("css", Array(
        "bootstrap/css/bootstrap.min.css",
        "dist/css/style.css",
        "dist/css/AdminLTE.css",
        "dist/css/skins/_all-skins.css",
        //DATEPICKER
        "plugins/daterangepicker/daterangepicker-bs3.css",
        "plugins/timepicker/bootstrap-timepicker.min.css",
        "plugins/datepicker/datepicker3.css",
        //iCheck
        "plugins/iCheck/all.css",
        //COLOR PICKER
        "plugins/colorpicker/bootstrap-colorpicker.min.css",
        //SELECT 2
        "plugins/select2/select2.css",
        "plugins/select2/select2-bootstrap.css",
        //DATATABLE
        "plugins/datatables/dataTables.bootstrap.css",
        //CROP
        "dist/css/avatar.css",
        "plugins/jquery.cropper/cropper.css",
        //Notofy
        "plugins/jquery.gritter/jquery.gritter.css",
        //SWITCH
        "plugins/bootstrap-switch/bootstrap-switch.css",
        //Tagsinput
        "plugins/bootstrap-tagsinput/bootstrap-tagsinput.css",
    ));
    echo "<!--JAVASCRIPT-->\n";
    \Libs\Helper::LoadMedia("js", Array(
        //JQUERY
        "dist/js/jquery.js",
        //BOOTSTRAP
        "bootstrap/js/bootstrap.min.js",
        //FastClick
        "plugins/fastclick/fastclick.min.js",
        //TEMA
        "dist/js/app.js",
        //SparkLine
        "plugins/sparkline/jquery.sparkline.min.js",
        //Jvectormap
        "plugins/jvectormap/jquery-jvectormap-1.2.2.min.js",
        "plugins/jvectormap/jquery-jvectormap-world-mill-en.js",
        //SlimScroll
        "plugins/slimScroll/jquery.slimscroll.min.js",
        //DATA TABLES
        "plugins/datatables/jquery.dataTables.js",
        "plugins/datatables/dataTables.bootstrap.js",
        //SELECT2
        "plugins/select2.js",
        "plugins/select2_locale_pt-BR.js",
        //InputMask
        "plugins/input-mask/jquery.inputmask.js",
        //DataPicker
        "plugins/daterangepicker/daterangepicker.js",
        "plugins/datepicker/bootstrap-datepicker.js",
        "plugins/timepicker/bootstrap-timepicker.min.js",
        //Color Picker
        "plugins/colorpicker/bootstrap-colorpicker.min.js",
        //BOOTBOX
        "plugins/bootbox.min.js",
        //WYSIWYG
        "markdown/bootstrap-markdown.min.js",
        "plugins/jquery.hotkeys.min.js",
        "plugins/bootstrap-wysiwyg.min.js",
        "plugins/extra-elements.min.js",
        //NESTABLE
        "plugins/jquery.nestable.min.js",
        //CROP
        "plugins/jquery.cropper/cropper.js",
        //SWITCH
        "plugins/bootstrap-switch/bootstrap-switch.min.js",
        //iCheck
        "plugins/iCheck/icheck.min.js",
        //Notofy
        "plugins/jquery.gritter/jquery.gritter.js",
        //Tagsinput
        "plugins/bootstrap-tagsinput/bootstrap-tagsinput.js",

        //DASHBOARD
        "dist/js/pages/dashboard2.js",

        //DEMO
        "dist/js/demo.js",

        //HELPER
        "build/js/helper.js",
        "build/js/pessoa.js",
        "build/js/avatar.js",
        "build/js/functions.js"
    ));?>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <!--<script src="//cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js"></script>
    <script src="//cdn.datatables.net/plug-ins/3cfcc339e89/integration/bootstrap/3/dataTables.bootstrap.js"></script>-->


    <script>
        function showErrorAlert (reason, detail) {
            var msg='';
            if (reason==='unsupported-file-type') { msg = "Unsupported format " +detail; }
            else {
                console.log("error uploading file", reason, detail);
            }
            $('<div class="alert"> <button type="button" class="close" data-dismiss="alert">&times;</button>'+
            '<strong>File upload error</strong> '+msg+' </div>').prependTo('#alerts');
        }
        //Add Image Resize Functionality to Chrome and Safari
        //webkit browsers don't have image resize functionality when content is editable
        //so let's add something using jQuery UI resizable
        //another option would be opening a dialog for user to enter dimensions.
        if ( typeof jQuery.ui !== 'undefined' && /applewebkit/.test(navigator.userAgent.toLowerCase()) ) {
            var lastResizableImg = null;
            function destroyResizable() {
                if(lastResizableImg == null) return;
                lastResizableImg.resizable( "destroy" );
                lastResizableImg.removeData('resizable');
                lastResizableImg = null;
            }
            var enableImageResize = function() {
                $('.wysiwyg-editor')
                    .on('mousedown', function(e) {
                        var target = $(e.target);
                        if( e.target instanceof HTMLImageElement ) {
                            if( !target.data('resizable') ) {
                                target.resizable({
                                    aspectRatio: e.target.width / e.target.height
                                });
                                target.data('resizable', true);
                                if( lastResizableImg != null ) {//disable previous resizable image
                                    lastResizableImg.resizable( "destroy" );
                                    lastResizableImg.removeData('resizable');
                                }
                                lastResizableImg = target;
                            }
                        }
                    })
                    .on('click', function(e) {
                        if( lastResizableImg != null && !(e.target instanceof HTMLImageElement) ) {
                            destroyResizable();
                        }
                    })
                    .on('keydown', function() {
                        destroyResizable();
                    });
            }
            enableImageResize();
            /**
             //or we can load the jQuery UI dynamically only if needed
             if (typeof jQuery.ui !== 'undefined') enableImageResize();
             else {//load jQuery UI if not loaded
			$.getScript($path_assets+"/js/jquery-ui-1.10.3.custom.min.js", function(data, textStatus, jqxhr) {
				if('ontouchend' in document) {//also load touch-punch for touch devices
					$.getScript($path_assets+"/js/jquery.ui.touch-punch.min.js", function(data, textStatus, jqxhr) {
						enableImageResize();
					});
				} else	enableImageResize();
			});
		}
             */
        }
    </script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

</head>
<body class="skin-blue">
<div class="wrapper">
<!-- header logo: style can be found in header.less -->

    <header class="main-header">
        <!-- Logo -->
        <a href="index2.html" class="logo"><b><?=$HUser->Aplicacao->Titulo;?></b></a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Alternar Navegaçao</span>
            </a>
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- Messages: style can be found in dropdown.less-->
                    <li class="dropdown messages-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-envelope-o"></i>
                            <span class="label label-success">4</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">You have 4 messages</li>
                            <li>
                                <!-- inner menu: contains the actual data -->
                                <ul class="menu">
                                    <li><!-- start message -->
                                        <a href="#">
                                            <div class="pull-left">
                                                <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
                                            </div>
                                            <h4>
                                                Support Team
                                                <small><i class="fa fa-clock-o"></i> 5 mins</small>
                                            </h4>
                                            <p>Why not buy a new awesome theme?</p>
                                        </a>
                                    </li><!-- end message -->
                                    <li>
                                        <a href="#">
                                            <div class="pull-left">
                                                <img src="dist/img/user3-128x128.jpg" class="img-circle" alt="user image"/>
                                            </div>
                                            <h4>
                                                AdminLTE Design Team
                                                <small><i class="fa fa-clock-o"></i> 2 hours</small>
                                            </h4>
                                            <p>Why not buy a new awesome theme?</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="pull-left">
                                                <img src="dist/img/user4-128x128.jpg" class="img-circle" alt="user image"/>
                                            </div>
                                            <h4>
                                                Developers
                                                <small><i class="fa fa-clock-o"></i> Today</small>
                                            </h4>
                                            <p>Why not buy a new awesome theme?</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="pull-left">
                                                <img src="dist/img/user3-128x128.jpg" class="img-circle" alt="user image"/>
                                            </div>
                                            <h4>
                                                Sales Department
                                                <small><i class="fa fa-clock-o"></i> Yesterday</small>
                                            </h4>
                                            <p>Why not buy a new awesome theme?</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="pull-left">
                                                <img src="dist/img/user4-128x128.jpg" class="img-circle" alt="user image"/>
                                            </div>
                                            <h4>
                                                Reviewers
                                                <small><i class="fa fa-clock-o"></i> 2 days</small>
                                            </h4>
                                            <p>Why not buy a new awesome theme?</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="footer"><a href="#">See All Messages</a></li>
                        </ul>
                    </li>
                    <!-- Notifications: style can be found in dropdown.less -->
                    <li class="dropdown notifications-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-bell-o"></i>
                            <span class="label label-warning">10</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">You have 10 notifications</li>
                            <li>
                                <!-- inner menu: contains the actual data -->
                                <ul class="menu">
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-users text-aqua"></i> 5 new members joined today
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the page and may cause design problems
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-users text-red"></i> 5 new members joined
                                        </a>
                                    </li>

                                    <li>
                                        <a href="#">
                                            <i class="fa fa-shopping-cart text-green"></i> 25 sales made
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-user text-red"></i> You changed your username
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="footer"><a href="#">View all</a></li>
                        </ul>
                    </li>
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
                            <img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image"/>
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
            <form action="#" method="get" class="sidebar-form">
                <div class="input-group">
                    <input type="text" name="q" class="form-control" placeholder="Search..."/>
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

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1 style="text-transform: capitalize;">
                <?=\Libs\Helper::getController();?>
                <?
                $act = \Libs\Helper::getAction();
                if(strtolower($act) != "index"){ ?>
                    <small><?=\Libs\Helper::getAction();?></small>
                <? } ?>
            </h1>
            <ol class="breadcrumb" style="text-transform: capitalize;">
                <li><a href="<?=URL;?>home/"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active"><a href="<?=URL . \Libs\Helper::getController();?>"><?=\Libs\Helper::getController();?></a></li>
                <? if(strtolower($act) != "index"){ ?>
                    <li class="active"><a href="<?=URL . \Libs\Helper::getController() . "/" . \Libs\Helper::getAction(); ?>"><?=\Libs\Helper::getAction();?></a></li>
                <? } ?>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">