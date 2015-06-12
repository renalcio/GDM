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
        "dist/css/AdminLTE.css",
        "dist/css/skins/_all-skins.css",
        "dist/css/avatar.css",
        //DATEPICKER
        /*"plugins/daterangepicker/daterangepicker-bs3.css",
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
        "plugins/jquery.cropper/cropper.css",
        //Notofy
        "plugins/jquery.gritter/jquery.gritter.css",
        //SWITCH
        "plugins/bootstrap-switch/bootstrap-switch.css",
        //Tagsinput
        "plugins/bootstrap-tagsinput/bootstrap-tagsinput.css",*/
    ));
    echo "<!--JAVASCRIPT-->\n";
    \Libs\Helper::LoadMedia("js", Array(
        //JQUERY
        "dist/js/jquery.js",
        //BOOTSTRAP
        "bootstrap/js/bootstrap.min.js",
        //FastClick
        "plugins/fastclick/fastclick.js",
        //TEMA
        "dist/js/app.js",
        //SparkLine
        /*"plugins/sparkline/jquery.sparkline.min.js",
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
        "plugins/bootstrap-tagsinput/bootstrap-tagsinput.js",*/

        //DASHBOARD
        //"dist/js/pages/dashboard2.js",

        //DEMO
        //"dist/js/demo.js"

    ));

    echo "\n<!--ASSETS-->\n";
    $this->AddAsset(["bootstrap-switch", "datatables", "select2", "jquery.maskedinput", "datepicker", "jquery.gritter", "bootbox", "slimScroll", "timepicker"]);
    $this->PrintAssets();

    echo "\n<!--/ASSETS-->\n";

    echo "\n<!--JAVASCRIPT-->\n";
    \Libs\Helper::LoadMedia("js", Array(
        //HELPER
        "dist/js/helper.js",
        "dist/js/pessoa.js",
        "dist/js/avatar.js",
        "dist/js/functions.js",
        "dist/js/pages/header.js"
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

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

</head>
<body class="skin-blue">


        <!-- Main content -->
        <section class="content">