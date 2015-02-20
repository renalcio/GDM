<?php

include_once("array.class.php");
class LastFM
{
    // Coloque aqui as Informações do Banco de Dados
    var $json;
    private $api_key = "53b09495de54c998614b6d350a5c2d3e"; #Tipo de dado requisitado
    private $urlBase =  "http://ws.audioscrobbler.com/2.0/?";
    
    private static $sapi_key = "53b09495de54c998614b6d350a5c2d3e"; #Tipo de dado requisitado
    private static $surlBase =  "http://ws.audioscrobbler.com/2.0/?";
    
    var $urlBusca;
    
    public static function getUrl($termo,$metodo,$parametro,$lang = false,$formato="json")
    {
        $idioma = $lang = true ? "&lang=pt" : "";
        return self::$surlBase."method=$metodo$idioma&format=$formato&api_key=".self::$sapi_key."&$parametro=$termo";
    }
    public static function getUrlSemTermo($metodo,$parametro,$lang = false,$formato="json")
    {
        $idioma = $lang = true ? "&lang=pt" : "";
        return self::$surlBase."method=$metodo$idioma&format=$formato&api_key=".self::$sapi_key."&$parametro=";
    }
}

?>