<?
//var_dump($Model);
if($Model->Lista->Count() > 0)
{
    ?>
    <script type="text/javascript">
        $(function() {
            $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
                checkboxClass: 'icheckbox_square',
                radioClass: 'icheckbox_square'
            });

            $(".chkDeleteAll").on('ifChecked', function(event){
                $(".chkDelete").iCheck('check');
            });

            $(".chkDeleteAll").on('ifUnchecked', function(event){
                $(".chkDelete").iCheck('uncheck');
            });
        });

        function Excluir(Id){
            bootbox.confirm('Deseja realmente excluir este item?', function(result){
                if(result)
                    location.href="<?=\Libs\Helper::getUrl("deletar")?>"+Id;

            });
        }
    </script>
<? } ?>
<form method="post" action="<?=\Libs\Helper::getUrl("deletar");?>">

    <div class="row">
        <div class="col-md-12">
            <label>
                <input type="checkbox" data-toggle="tooltip" data-placement="top" title="Selecionar todos"
                       class="chkDeleteAll chkDelete
                minimal" /> Selecionar tudo
            </label>
            <div class="pull-right">
                <button type="submit" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
                <a href="<?=\Libs\Helper::getUrl("Cadastro")?>" class="btn btn-primary btn-md" style="color:#fff;" ><i class="fa
                    fa-plus"></i></a>

            </div>
        </div>
    </div><br>
    <div class="clearfix"></div>

    <div id="grid" class="row">
        <div class="col-md-4">
        <?
        if($Model->Lista->Count() > 0)
        {
            $Model->Lista->For_Each(function ($Item, $i){
                if($i > 0 AND $i % 3 == 0){
                    echo ' </div><div class="col-md-4">';
                }
                $bgbox = "aqua";
                switch($Item->Tipo) {
                    case "success":
                        $bgbox = "green";
                        break;
                    case "danger":
                        $bgbox = "red";
                        break;
                    case "warning":
                        $bgbox = "yellow";
                        break;
                    default:
                        $bgbox = "aqua";
                        break;
                }
                ?>
                <div class="small-box bg-<?=$bgbox;?>">
                    <div class="inner" style="word-wrap:break-word;">
                        <span class="pull-right">
                            <input type="checkbox" class="chkDelete minimal" name="DeleteItems[<?= $i ?>]" value="<?= $Item->AvisoId ?>" />  </span>
                        <h4><?=$Item->Titulo;?></h4>
                        <p><?=nl2br($Item->Descricao);?></p>
                    </div>
                    <a href="<?=\Libs\Helper::getUrl("cadastro", "aviso", $Item->AvisoId);?>" class="small-box-footer">
                        Editar <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>


            <?
            });
        }else
        {
            echo "<div class='well'>Nenhum aviso</div>";
        }
        ?>
        </div>
    </div>
    <? if($Model->Lista->Count() > 0) { ?>

<script>
    $(function(){

    });
</script>
    <? } ?>
</form>

