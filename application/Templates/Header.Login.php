<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Entrar</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="../../dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="../../plugins/iCheck/square/blue.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <?
    echo "<!--CSS-->\n";
    \Libs\Helper::LoadMedia("css", [
        "bootstrap/css/bootstrap.min.css",
        "dist/css/style.css",
        "dist/css/theme.css",
        "dist/css/ui.css",
        "dist/css/layout.css",
        "dist/css/avatar.css",
    ]);
    echo "\n<!--JAVASCRIPT-->\n";
    \Libs\Helper::LoadMedia("js", [
        //JQUERY
        "dist/js/jquery.js",
        //BOOTSTRAP
        "bootstrap/js/bootstrap.min.js"
        //"dist/js/pages/login-v1.js"
    ]);


    echo "\n<!--ASSETS-->\n";
    $this->AddAsset(["backstretch","bootstrap-loading"]);
    $this->PrintAssets();

    echo "\n<!--/ASSETS-->\n";
    ?>
</head>
<body class="account separate-inputs boxed no-social" data-page="login">
    