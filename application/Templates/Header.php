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
        "dist/css/theme.css",
        "dist/css/ui.css",
        "dist/css/layout.css",
        "dist/css/avatar.css",
    ));
    echo "<!--JAVASCRIPT-->\n";
    \Libs\Helper::LoadMedia("js", Array(
        //JQUERY
        "dist/js/jquery.js",
        //BOOTSTRAP
        "bootstrap/js/bootstrap.min.js",
        //FastClick
        "assets/fastclick/fastclick.js",
        //TEMA
        "dist/js/functions.js"


    ));

    echo "\n<!--ASSETS-->\n";
    $this->AddAsset(["jquery.cookie","mcustom-scrollbar","bootstrap-switch", "datatables", "select2", "jquery.maskedinput", "datepicker", "jquery.gritter", "bootbox", "slimScroll", "timepicker"]);
    $this->PrintAssets();

    echo "\n<!--/ASSETS-->\n";

    echo "\n<!--JAVASCRIPT-->\n";
    \Libs\Helper::LoadMedia("js", Array(
        //HELPER
        "dist/js/helper.js",
        "dist/js/pessoa.js",
        "dist/js/avatar.js",
        "dist/js/functions.js",
    ));
    ?>

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
</head>
<body class="fixed-topbar fixed-sidebar theme-sdtl color-default">

<!--[if lt IE 7]>
<p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->
<section>
<!-- BEGIN SIDEBAR -->
<div class="sidebar">
    <div class="logopanel">
        <h1>
            <a href="<?=URL?>"><?=$HUser->Aplicacao->Titulo;?></a>
        </h1>
    </div>
    <div class="sidebar-inner">
        <div class="sidebar-top">
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
            <form id="BuscaSidebarForm" method="post" class="searchform" id="search-results">
                <input id="BuscaSidebar" type="text" class="form-control" name="keyword" placeholder="Pesquisar...">
            </form>
            <div class="userlogged clearfix">
                <i class="icon icons-faces-users-01"></i>
                <div class="user-details">
                    <h4><?=Helper::Abreviar($HUser->Usuario->Pessoa->Nome);?></h4>
                    <div class="dropdown user-login">
                        <button class="btn btn-xs dropdown-toggle btn-rounded" type="button" data-toggle="dropdown" data-hover="dropdown" data-close-others="true" data-delay="300">
                            <i class="online"></i><span>Available</span><i class="fa fa-angle-down"></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href="#"><i class="busy"></i><span>Busy</span></a></li>
                            <li><a  href="#"><i class="turquoise"></i><span>Invisible</span></a></li>
                            <li><a href="#"><i class="away"></i><span>Away</span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="menu-title">
            Navegação
            <div class="pull-right menu-settings">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true" data-delay="300">
                    <i class="icon-settings"></i>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="#" id="reorder-menu" class="reorder-menu">Reorder menu</a></li>
                    <li><a href="#" id="remove-menu" class="remove-menu">Remove elements</a></li>
                    <li><a href="#" id="hide-top-sidebar" class="hide-top-sidebar">Hide user &amp; search</a></li>
                </ul>
            </div>
        </div>

        <!-- MENU -->
        <?php \Libs\Helper::LoadView("menu","menu"); ?>
        <!-- END MENU --->

        <!-- SIDEBAR WIDGET FOLDERS -->

        <div class="sidebar-footer clearfix">
            <a class="pull-left footer-settings" href="#" data-rel="tooltip" data-placement="top" data-original-title="Settings">
                <i class="icon-settings"></i></a>
            <a class="pull-left toggle_fullscreen" href="#" data-rel="tooltip" data-placement="top" data-original-title="Fullscreen">
                <i class="icon-size-fullscreen"></i></a>
            <a class="pull-left" href="user-lockscreen.html" data-rel="tooltip" data-placement="top" data-original-title="Lockscreen">
                <i class="icon-lock"></i></a>
            <a class="pull-left btn-effect" href="user-login-v1.html" data-modal="modal-1" data-rel="tooltip" data-placement="top" data-original-title="Logout">
                <i class="icon-power"></i></a>
        </div>
    </div>
</div>
<!-- END SIDEBAR -->
<div class="main-content">
<!-- BEGIN TOPBAR -->
<div class="topbar">
<div class="header-left">
    <div class="topnav">
        <a class="menutoggle" href="#" data-toggle="sidebar-collapsed"><span class="menu__handle"><span>Menu</span></span></a>
        <ul class="nav nav-icons">
            <li><a href="#" class="toggle-sidebar-top"><span class="icon-user-following"></span></a></li>
            <li><a href="mailbox.html"><span class="octicon octicon-mail-read"></span></a></li>
            <li><a href="#"><span class="octicon octicon-flame"></span></a></li>
            <li><a href="builder-page.html"><span class="octicon octicon-rocket"></span></a></li>
        </ul>
    </div>
</div>
<div class="header-right">
<ul class="header-menu nav navbar-nav">
<!-- BEGIN USER DROPDOWN -->
<li class="dropdown" id="language-header">
    <a href="#" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
        <i class="icon-globe"></i>
        <span>Language</span>
    </a>
    <ul class="dropdown-menu">
        <li>
            <a href="#" data-lang="en"><img src="../assets/global/images/flags/usa.png" alt="flag-english"> <span>English</span></a>
        </li>
        <li>
            <a href="#" data-lang="es"><img src="../assets/global/images/flags/spanish.png" alt="flag-english"> <span>Español</span></a>
        </li>
        <li>
            <a href="#" data-lang="fr"><img src="../assets/global/images/flags/french.png" alt="flag-english"> <span>Français</span></a>
        </li>
    </ul>
</li>
<!-- END USER DROPDOWN -->
<!-- BEGIN NOTIFICATION DROPDOWN -->
<li class="dropdown" id="notifications-header">
    <a href="#" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
        <i class="icon-bell"></i>
        <span class="badge badge-danger badge-header">6</span>
    </a>
    <ul class="dropdown-menu">
        <li class="dropdown-header clearfix">
            <p class="pull-left">12 Pending Notifications</p>
        </li>
        <li>
            <ul class="dropdown-menu-list withScroll" data-height="220">
                <li>
                    <a href="#">
                        <i class="fa fa-star p-r-10 f-18 c-orange"></i>
                        Steve have rated your photo
                        <span class="dropdown-time">Just now</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fa fa-heart p-r-10 f-18 c-red"></i>
                        John added you to his favs
                        <span class="dropdown-time">15 mins</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fa fa-file-text p-r-10 f-18"></i>
                        New document available
                        <span class="dropdown-time">22 mins</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fa fa-picture-o p-r-10 f-18 c-blue"></i>
                        New picture added
                        <span class="dropdown-time">40 mins</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fa fa-bell p-r-10 f-18 c-orange"></i>
                        Meeting in 1 hour
                        <span class="dropdown-time">1 hour</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fa fa-bell p-r-10 f-18"></i>
                        Server 5 overloaded
                        <span class="dropdown-time">2 hours</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fa fa-comment p-r-10 f-18 c-gray"></i>
                        Bill comment your post
                        <span class="dropdown-time">3 hours</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fa fa-picture-o p-r-10 f-18 c-blue"></i>
                        New picture added
                        <span class="dropdown-time">2 days</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="dropdown-footer clearfix">
            <a href="#" class="pull-left">See all notifications</a>
            <a href="#" class="pull-right">
                <i class="icon-settings"></i>
            </a>
        </li>
    </ul>
</li>
<!-- END NOTIFICATION DROPDOWN -->
<!-- BEGIN MESSAGES DROPDOWN -->
<li class="dropdown" id="messages-header">
    <a href="#" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
        <i class="icon-paper-plane"></i>
                <span class="badge badge-primary badge-header">
                8
                </span>
    </a>
    <ul class="dropdown-menu">
        <li class="dropdown-header clearfix">
            <p class="pull-left">
                You have 8 Messages
            </p>
        </li>
        <li class="dropdown-body">
            <ul class="dropdown-menu-list withScroll" data-height="220">
                <li class="clearfix">
                        <span class="pull-left p-r-5">
                        <img src="../assets/global/images/avatars/avatar3.png" alt="avatar 3">
                        </span>
                    <div class="clearfix">
                        <div>
                            <strong>Alexa Johnson</strong>
                            <small class="pull-right text-muted">
                                <span class="glyphicon glyphicon-time p-r-5"></span>12 mins ago
                            </small>
                        </div>
                        <p>Lorem ipsum dolor sit amet, consectetur...</p>
                    </div>
                </li>
                <li class="clearfix">
                        <span class="pull-left p-r-5">
                        <img src="../assets/global/images/avatars/avatar4.png" alt="avatar 4">
                        </span>
                    <div class="clearfix">
                        <div>
                            <strong>John Smith</strong>
                            <small class="pull-right text-muted">
                                <span class="glyphicon glyphicon-time p-r-5"></span>47 mins ago
                            </small>
                        </div>
                        <p>Lorem ipsum dolor sit amet, consectetur...</p>
                    </div>
                </li>
                <li class="clearfix">
                        <span class="pull-left p-r-5">
                        <img src="../assets/global/images/avatars/avatar5.png" alt="avatar 5">
                        </span>
                    <div class="clearfix">
                        <div>
                            <strong>Bobby Brown</strong>
                            <small class="pull-right text-muted">
                                <span class="glyphicon glyphicon-time p-r-5"></span>1 hour ago
                            </small>
                        </div>
                        <p>Lorem ipsum dolor sit amet, consectetur...</p>
                    </div>
                </li>
                <li class="clearfix">
                        <span class="pull-left p-r-5">
                        <img src="../assets/global/images/avatars/avatar6.png" alt="avatar 6">
                        </span>
                    <div class="clearfix">
                        <div>
                            <strong>James Miller</strong>
                            <small class="pull-right text-muted">
                                <span class="glyphicon glyphicon-time p-r-5"></span>2 days ago
                            </small>
                        </div>
                        <p>Lorem ipsum dolor sit amet, consectetur...</p>
                    </div>
                </li>
            </ul>
        </li>
        <li class="dropdown-footer clearfix">
            <a href="mailbox.html" class="pull-left">See all messages</a>
            <a href="#" class="pull-right">
                <i class="icon-settings"></i>
            </a>
        </li>
    </ul>
</li>
<!-- END MESSAGES DROPDOWN -->
<!-- BEGIN USER DROPDOWN -->
<li class="dropdown" id="user-header">
    <a href="#" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
        <img src="<?=$HUser->Usuario->Avatar;?>" alt="user image">
        <span class="username"><?=Helper::Abreviar($HUser->Usuario->Pessoa->Nome);?></span>
    </a>
    <ul class="dropdown-menu">
        <li>
            <a href="#"><i class="icon-user"></i><span>My Profile</span></a>
        </li>
        <li>
            <a href="#"><i class="icon-calendar"></i><span>My Calendar</span></a>
        </li>
        <li>
            <a href="<?=Helper::getUrl("selecionaAplicacao", "login");?>"><i class="icon-settings"></i><span>Selecionar Aplicação</span></a>
        </li>
        <li>
            <a href="<?=Helper::getUrl("logout", "login");?>"><i class="icon-logout"></i><span>Sair</span></a>
        </li>
    </ul>
</li>
<!-- END USER DROPDOWN -->
<!-- CHAT BAR ICON -->
<li id="quickview-toggle"><a href="#"><i class="icon-bubbles"></i></a></li>
</ul>
</div>
<!-- header-right -->
</div>
<!-- END TOPBAR -->

<!-- BEGIN PAGE CONTENT -->
<div class="page-content">
    <div class="header">
        <h2 style="text-transform: uppercase;"><strong>
                <?
                $Tctrl = $this->GetControllerTitle();
                echo $Tctrl;
                $Tact = $this->GetActionTitle();
                ?></strong>
            <small><?=$Tact;?></small>
        </h2>
        <div class="breadcrumb-wrapper">
            <ol class="breadcrumb">
                <li><a href="<?=URL;?>">Home</a>
                </li>
                <li><a href="<?=URL . \Libs\Helper::getController();?>"><?=$Tctrl;?></a>
                </li>
                <li class="active"><?=$Tact;?></li>
            </ol>
        </div>
    </div>

