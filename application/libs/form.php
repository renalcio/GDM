<?php
namespace Libs;

class Form
{

    public static function Input($Tipo, $Nome="", $Valor="", $htmlAttr = Array())
    {
        $html = "";
        if(strtolower($Tipo) == "textarea")
        {
            $html .= "<textarea ";
            if(!empty($Nome)) $html .= "name='$Nome' id='$Nome' ";

            if(is_array($htmlAttr) && count($htmlAttr) > 0)
            {
                foreach($htmlAttr as $k=>$attr)
                {
                    $html .= "$k='$attr' ";
                }
            }
            $html .= ">";
            if(!empty($Valor)) $html .= $Valor;
            $html .= "</textarea>";
        }
        else
        {
            $html .= "<input ";
            if(!empty($Nome)) $html .= "name='$Nome' id='$Nome' ";
            if(!empty($Tipo)) $html .= "type='$Tipo' ";

            if(is_array($htmlAttr) && count($htmlAttr) > 0)
            {
                foreach($htmlAttr as $k=>$attr)
                {
                    $html .= "$k='$attr' ";
                }
            }

            if(!empty($Valor)) $html .= "value='$Valor' ";;

            $html .= "/>";
        }
        return $html;
    }

    public static function Checkbox($Nome="", $Valor="", $htmlAttr = Array())
    {
        echo Self::Input("checkbox", $Nome, $Valor, $htmlAttr);
    }

    public static function Text($Nome="", $Valor="", $htmlAttr = Array())
    {
        echo Self::Input("text", $Nome, $Valor, $htmlAttr);
    }

    public static function DatePicker($Nome="", $Valor="", $htmlAttr = Array())
    {
        $Valor = Datetime::Formatar($Valor);

        echo '
        <script>
        $(function(){
            $("#'.$Nome.'").datepicker({
                format: "dd/mm/yyyy",
            });
        });
        </script>
        ';

        echo Self::Mask("99/99/9999", $Nome, $Valor, $htmlAttr);
    }

    public static function Mask($Mascara, $Nome="", $Valor="", $htmlAttr = Array())
    {
        if(isset($htmlAttr["placeholder"]) || isset($htmlAttr["Placeholder"])){
            $placeholder = isset($htmlAttr["placeholder"]) ? $htmlAttr["placeholder"] : $htmlAttr["Placeholder"];
            echo '
        <script>
        $(function(){
            $("#'.$Nome.'").mask("'.$Mascara.'", {"placeholder": "'.$placeholder.'"});
        });
        </script>
        ';
        }else{
            echo '
        <script>
        $(function(){
            $("#'.$Nome.'").mask("'.$Mascara.'");
            });
        </script>
        ';
        }

        echo Self::Input("text", $Nome, $Valor, $htmlAttr);
    }


    public static function TextArea($Nome="", $Valor="", $htmlAttr = Array())
    {
        echo Self::Input("textarea", $Nome, $Valor, $htmlAttr);
    }

    public static function DropDown($Nome="", $Valor="", $Opcoes = "", $htmlAttr = Array())
    {
        $html = "<select ";
        if(!empty($Nome)) $html .= "name='$Nome' id='$Nome' ";
        if(is_array($htmlAttr) && count($htmlAttr) > 0)
        {
            foreach($htmlAttr as $k=>$attr)
            {
                $html .= "$k='$attr' ";
            }
        }
        $html .= ">";

        if(!empty($Opcoes) && is_array($Opcoes) && count($Opcoes) > 0)
        {
            foreach($Opcoes as $v=>$txt)
            {
                if($v == $Valor)
                    $html .= "<option value='$v' selected>$txt</option>";
                else
                    $html .= "<option value='$v'>$txt</option>";
            }
        }
        else if(!empty($Opcoes))
            $html .= $Opcoes;


        $html .= "</select>";

        echo $html;
    }

    /**
     * @param string $Nome
     * @param string $Valor
     * @param string $Opcoes
     * @param array $htmlAttr - Para definir uma Url com dados insira DataUrl no Array
     */
    public static function Select2($Nome="", $Valor="", $Opcoes = "", $htmlAttr = Array())
    {
        if(isset($htmlAttr["DataUrl"]) && !empty($htmlAttr["DataUrl"])) {
            echo '<script>
               $(function(){
                   $.get("'.$htmlAttr["DataUrl"].'", function(data){
                        $("#' . $Nome . '").html(data);
                        $("#' . $Nome . '").val("'.$Valor.'").change();
                   });
               });
             </script>';
        }
        echo '<script>
                $(function(){
                     $("#'.$Nome.'").select2();
                });
             </script>';

        Self::DropDown($Nome, $Valor, $Opcoes, $htmlAttr);
    }


    public static function Password($Nome="", $Valor="", $htmlAttr = Array())
    {
        echo Self::Input("password", $Nome, $Valor, $htmlAttr);
    }

    public static function Email($Nome="", $Valor="", $htmlAttr = Array())
    {
        echo Self::Input("email", $Nome, $Valor, $htmlAttr);
    }

    public static function Range($Nome="", $Valor="", $htmlAttr = Array())
    {
        echo Self::Input("range", $Nome, $Valor, $htmlAttr);
    }

    public static function Number($Nome="", $Valor="", $htmlAttr = Array())
    {
        echo Self::Input("number", $Nome, $Valor, $htmlAttr);
    }

    public static function Hidden($Nome="", $Valor="", $htmlAttr = Array())
    {
        echo Self::Input("hidden", $Nome, $Valor, $htmlAttr);
    }

    public static function Wysiwyg($Nome="", $Valor="", $htmlAttr = Array())
    {
        Self::Hidden($Nome, $Valor);
        echo "
                <script type='text/javascript'>
                    jQuery(function($){
                        //but we want to change a few buttons colors for the third style
                        $('#".$Nome."wysiwyg').ace_wysiwyg({
                            toolbar:
                                [
                                    {name:'font', className:'btn-default'},
                                    null,
                                    {name:'fontSize', className:'btn-default'},
                                    null,
                                    {name:'bold', className:'btn-default'},
                                    {name:'italic', className:'btn-default'},
                                    {name:'strikethrough', className:'btn-default'},
                                    {name:'underline', className:'btn-default'},
                                    null,
                                    {name:'insertunorderedlist', className:'btn-primary'},
                                    {name:'insertorderedlist', className:'btn-primary'},
                                    {name:'outdent', className:'btn-primary'},
                                    {name:'indent', className:'btn-primary'},
                                    null,
                                    {name:'justifyleft', className:'btn-primary'},
                                    {name:'justifycenter', className:'btn-primary'},
                                    {name:'justifyright', className:'btn-primary'},
                                    {name:'justifyfull', className:'btn-primary'},
                                    null,
                                    {name:'unlink', className:'btn-primary'},
                                    null,
                                    {name:'createLink', className:'btn-primary'},
                                    null,
                                    {name:'insertImage', className:'btn-success'},
                                    null,
                                    {name:'foreColor', className:'btn-default'},
                                    null,
                                    {name:'undo', className:'btn-grey'},
                                    {name:'redo', className:'btn-grey'}
                                ],
                            'wysiwyg': {
                        fileUploadError: showErrorAlert
                            }
                        });
                        $('#".$Nome."wysiwyg').on('keyup blur', function(){
                            $('#".$Nome."').val($(this).html());
                        });
                });
                </script>
                <div id='".$Nome."wysiwyg' class='wysiwyg-editor'></div>
                ";
    }
}