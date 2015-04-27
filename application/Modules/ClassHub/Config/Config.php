<?php
$appsess = new \Libs\SessionHelper("GDMAuth"); #Session

$escola = $appsess->Ver("EscolaId");
if(!empty($escola)) {
    define('ESCOLA', $escola); #Pasta da Aplicacao
}else{
    define('ESCOLA', 0); #Pasta da Aplicacao
}