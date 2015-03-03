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
    <title>MediaSpot</title>
    <meta name="description" content="Ouvir Musica Online, Videos e Imagens.">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

    <!-- JS -->
    <!-- please note: The JavaScript files are loaded in the footer to speed up page construction -->
    <!-- See more here: http://stackoverflow.com/q/2105327/1114320 -->


    <!-- CSS -->
    <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="http://code.ionicframework.com/ionicons/1.5.2/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <script>
        var SiteURL = "<?=URL?>";
    </script>

    <!--CSS-->
    <? \Libs\Helper::LoadMedia("css", Array(
        "bootstrap.min.css",
        "style.css",
        "AdminLTE.css",
        //DATEPICKER
        "daterangepicker/daterangepicker-bs3.css",
        "timepicker/bootstrap-timepicker.min.css",
        "css/datepicker/datepicker3.css",
        //iCheck
        "iCheck/all.css",
        //COLOR PICKER
        "colorpicker/bootstrap-colorpicker.min.css",
        //SELECT 2
        "select2.css",
        "select2-bootstrap.css",
        //DATATABLE
        "datatables/dataTables.bootstrap.css",
        //CROP
        "avatar.css",
        "cropper.css",
        //Notofy
        "jquery.gritter.css",
        //SWITCH
        "bootstrap-switch.css",
        //Tagsinput
        "bootstrap-tagsinput.css",
        //IonSlide
        "ionslider/ion.rangeSlider.css",
        "ionslider/ion.rangeSlider.skinNice.css"
    ));
    echo "<!--JAVASCRIPT-->\n";
    \Libs\Helper::LoadMedia("js", Array(
        //JQUERY
        "jquery.js",
        //BOOTSTRAP
        "bootstrap.min.js",
        //TEMA
        "AdminLTE/app.js",
        //DATA TABLES
        "plugins/datatables/jquery.dataTables.js",
        "plugins/datatables/dataTables.bootstrap.js",
        //SELECT2
        "plugins/select2.js",
        "plugins/select2_locale_pt-BR.js",
        //InputMask
        "plugins/jquery.maskedinput.min.js",
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
        "plugins/cropper.js",
        //SWITCH
        "plugins/bootstrap-switch.min.js",
        //iCheck
        "plugins/iCheck/icheck.min.js",
        //Notofy
        "plugins/jquery.gritter.js",
        //Tagsinput
        "plugins/bootstrap-tagsinput.js",
        //ISONSLIDE
        "plugins/moment.js",
        "plugins/ionslider/ion.rangeSlider.js",

        //HELPER
        "helper.js",
        "pessoa.js",
        "avatar.js",
        "functions.js"
    ));?>


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
<!-- header logo: style can be found in header.less -->
<header class="header">
    <a href="index.html" class="logo">
        <!-- Add the class icon to your logo image or logo icon to add the margining -->
        MediaSpot
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <div class="navbar-right">
            <ul class="nav navbar-nav">
                <!-- Messages: style can be found in dropdown.less-->
                <li class="dropdown messages-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        Músicas
                    </a>
                </li>
                <!-- Notifications: style can be found in dropdown.less -->
                <li class="dropdown notifications-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        Vídeos
                    </a>
                </li>
                <!-- Tasks: style can be found in dropdown.less -->
                <li class="dropdown tasks-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        Imagens
                    </a>
                </li>
                <!-- User Account: style can be found in dropdown.less -->
                <?
                if(isset($HUser) && !empty($HUser)) {
                    ?>
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="glyphicon glyphicon-user"></i>
                            <span><?= Helper::Abreviar($HUser->Usuario->Pessoa->Nome); ?> <i class="caret"></i></span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header bg-light-blue">
                                <img src="<?= $HUser->Usuario->Avatar; ?>" class="img-circle" alt="User Image"/>

                                <p>
                                    <?= Helper::Abreviar($HUser->Usuario->Pessoa->Nome); ?> - Web Developer
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
                                    <a href="<?= Helper::getUrl("selecionaAplicacao", "login"); ?>"
                                       class="btn btn-default btn-flat">Selecionar Aplicaçao</a>
                                </div>
                                <div class="pull-right">
                                    <a href="<?= Helper::getUrl("logout", "login"); ?>" class="btn btn-default btn-flat">Sair</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                <?
                }
                ?>
            </ul>
        </div>
    </nav>
</header>
<div class="wrapper row-offcanvas row-offcanvas-left">
    <!-- Left side column. contains the logo and sidebar -->
    <!-- Right side column. Contains the navbar and content of the page -->
    <aside class="right-side" style="margin-left: 0px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="row">
                <div class="col-lg-offset-1 col-lg-10">
                    <form class="search-form" method="post" action="<?=\Libs\Helper::getUrl("Index","Busca");?>">
                        <div class="input-group">
                            <input type="text" name="q" class="form-control" placeholder="Pesquisar">
                            <div class="input-group-btn">
                                <button type="submit" name="submit" class="btn btn-primary"><i class="fa
                                fa-search"></i></button>
                            </div>
                        </div><!-- /.input-group -->
                    </form>
                </div>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">
