<?php
namespace Controllers;
use Core\Controller;
use Libs\Database;
class Handler extends Controller
{
    function index($Handler, $Funcao){
        if (isset($Handler) && !empty($Handler) && isset($Funcao) && !empty($Funcao))
        {
            if(file_exists(ROOT."public/Handler/".$Handler.".php")){
                try{
                    require_once ROOT."public/Handler/".$Handler.".php";
                    $Funcao();
                }catch (\Exception $e){

                }
            }
        }
    }
}

