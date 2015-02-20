<?
session_start();
setlocale(LC_ALL, 'ptb', 'portuguese-brazil', 'pt-br', 'bra', 'brazil');
date_default_timezone_set('America/Sao_Paulo');

include_once ("inc/functions.php");

//Classes
include_once ("inc/class/dom.class.php");
include_once ("inc/class/getid3/getid3.php");
include_once ("inc/class/getid3/getid3.lib.php");
include_once ("inc/class/array.class.php");
include_once ("inc/class/mp3.class.php");
//include_once ("inc/class/cache.class.php");
include_once ("inc/class/session.class.php");
include_once ("inc/class/lastfm.class.php");
include_once ("inc/class/mysql.class.php");
include_once ("inc/class/Database.php");
include_once ("inc/class/bootstrap.class.php");
include_once ("inc/class/erro.class.php");
include_once ("base64.php");
//error_reporting(0);

//Instance
//$cachse = new Cache;
$session = new SessionHelper;
$lastfm = new LastFM;
$base64 = new Base64;
$mysql = new MysqlHelper;
$pdo = new Database();

function consolelog( $data ) {

    if ( is_array( $data ) )
        $output = "<script>console.log( 'Debug PHP: " . implode( ',', $data) . "' );</script>";
    else if(is_object($data)){
        $output = "
        <script>
        var strObject = " . json_encode($data) . ";
        console.log('PHP Debug: ');
        console.log(strObject);
        </script>";
        }
    else
        $output = "<script>console.log( 'Debug PHP: " . $data . "' );</script>";

    echo $output;
}