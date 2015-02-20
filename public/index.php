<?php
session_start();
/**
 * MINI - an extremely simple naked PHP application
 *
 * @package mini
 * @author Panique
 * @link http://www.php-mini.com
 * @link https://github.com/panique/mini/
 * @license http://opensource.org/licenses/MIT MIT License
 */

//header ('Content-type: text/html; charset=UTF-8');
#header('Content-type: text/html; charset=ISO-8859-1');
// TODO get rid of this and work with namespaces + composer's autoloader

// set a constant that holds the project's folder path, like "/var/www/".
// DIRECTORY_SEPARATOR adds a slash to the end of the path
define('ROOT', dirname(__DIR__) . DIRECTORY_SEPARATOR);
// set a constant that holds the project's "application" folder, like "/var/www/application".
define('APP', ROOT . 'application' . DIRECTORY_SEPARATOR);


// This is the (totally optional) auto-loader for Composer-dependencies (to load tools into your project).
// If you have no idea what this means: Don't worry, you don't need it, simply leave it like it is.
if (file_exists(ROOT .'vendor'. DIRECTORY_SEPARATOR . 'autoload.php')) {
    require ROOT . 'vendor'. DIRECTORY_SEPARATOR . 'autoload.php';
}

// load application config (error reporting etc.)
require APP . 'Config'. DIRECTORY_SEPARATOR . 'Config.php';

// FOR DEVELOPMENT: this loads PDO-debug, a simple function that shows the SQL query (when using PDO).
// If you want to load pdoDebug via Composer, then have a look here: https://github.com/panique/pdo-debug
require APP . 'Libs'. DIRECTORY_SEPARATOR . 'Helper.php';

// load application class

//require APP . '/core/application.php';
//require APP . '/core/controller.php';

//CLASSES BY RENALCIO
//require APP . '/classe/Database.php';
//LOADERS BY RENALCIO
//$pdo = new Libs\Database(DB_TYPE, DB_HOST, DB_NAME, DB_USER, DB_PASS);

// start the application
$app = new Core\Application();