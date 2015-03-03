﻿<?php
/**
 * Configuration
 *
 * For more info about constants please @see http://php.net/manual/en/function.define.php
 */

/**
 * Configuration for: Error reporting
 * Useful to show every little problem during development, but only show hard errors in production
 */
error_reporting(E_ALL);
ini_set("display_errors", 1);

/**
 * Configuration for: URL
 * Here we auto-detect your applications URL and the potential sub-folder. Works perfectly on most servers and in local
 * development environments (like WAMP, MAMP, etc.). Don't touch this unless you know what you do.
 *
 * URL_PUBLIC_FOLDER:
 * The folder that is visible to public, users will only have access to that folder so nobody can have a look into
 * "/application" or other folder inside your application or call any other .php file than index.php inside "/public".
 *
 * URL_PROTOCOL:
 * The protocol. Don't change unless you know exactly what you do.
 *
 * URL_DOMAIN:
 * The domain. Don't change unless you know exactly what you do.
 *
 * URL_SUB_FOLDER:
 * The sub-folder. Leave it like it is, even if you don't use a sub-folder (then this will be just "/").
 *
 * URL:
 * The final, auto-detected URL (build via the segments above). If you don't want to use auto-detection,
 * then replace this line with full URL (and sub-folder) and a trailing slash.
 */

define('URL_PUBLIC_FOLDER', 'public');
define('URL_PROTOCOL', 'http://');
define('URL_DOMAIN', $_SERVER['HTTP_HOST']);
define('URL_SUB_FOLDER', str_replace(URL_PUBLIC_FOLDER, '', dirname($_SERVER['SCRIPT_NAME'])));
define('URL', URL_PROTOCOL . URL_DOMAIN . URL_SUB_FOLDER);

/**
 * Configuration for: Database
 * This is the place where you define your database credentials, database type etc.
 */

define("ROOTAPP", 1); #AplicacaoId GDM
define("ROOTDB", "GDM"); #banco Principal


define('DB_PREFIX', '');
define('DB_TYPE', 'mysql');
define('DB_HOST', 'localhost');
define('DB_NAME', DB_PREFIX.ROOTDB);
define('DB_USER', 'root');
define('DB_PASS', '');



define("MODULES", "Modules" . DIRECTORY_SEPARATOR); #Pasta de Aplicações

$appsess = new \Libs\SessionHelper("GDMAuth"); #Session


$appid = $appsess->Ver("AplicacaoId");
if(!empty($appid)){
    define('APPID', 3); #AplicacaoId
    define('APP_ID', 3); #AplicacaoId
}else {
    define('APPID', 3); #AplicacaoId
    define('APP_ID', 3); #AplicacaoId
}
$pasta = $appsess->Ver("Pasta");
if(!empty($pasta)) {
    define('PASTA', $pasta . DIRECTORY_SEPARATOR); #Pasta da Aplicacao
}else{
    define('PASTA', 'MediaSpot'. DIRECTORY_SEPARATOR); #Pasta da Aplicacao
}