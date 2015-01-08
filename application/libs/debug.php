<?php
namespace Libs;
class Debug
{

    public static function ConsoleLog($Mensagem){

        if(is_array($Mensagem)){
            foreach($Mensagem as $msg){
                echo "<script>
                        console.log('".$msg."');
                    </script>
                    ";
            }
        }else{
            echo "<script>
                        console.log('".$Mensagem."');
                    </script>
                    ";
        }
    }
}