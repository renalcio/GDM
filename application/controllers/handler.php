<?php
namespace Controllers;
use Core\Controller;
use Classe\Database;
class Handler extends Controller
{
    function index($Handler, $Funcao){
        if (isset($Handler) && !empty($Handler) && isset($Funcao) && !empty($Funcao))
        {
            if(file_exists(ROOT."public/handler/".$Handler.".php")){
                try{
                    require_once ROOT."public/handler/".$Handler.".php";
                    $Funcao();
                }catch (\Exception $e){

                }
            }
        }
    }
}

