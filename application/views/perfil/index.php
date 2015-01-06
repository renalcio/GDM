<?
if(is_array($Model) && count($Model) > 0)
{
    ?>
    <script type="text/javascript">
        $(function() {
            $(".switch").on('switchChange.bootstrapSwitch', function(event, state) {
                var ref = $(this).attr("ref"); // true | false
                $.getJSON("<?=URL;?>handler/perfil/MudaStatus/"+ref+"/"+state, function(data){
                    //console.log(data);
                });
            });

            $("#listagem").dataTable({
                "aoColumns": [ null,null, {"bSortable": false}, {"bSortable": false} ]
            });
        });

        function Excluir(Id){
            bootbox.confirm('Deseja realmente excluir este item?', function(result){
                if(result)
                    location.href="<?=\Libs\Helper::getUrl("deletar");?>"+Id;

            });
        }
    </script>
<? } ?>
<div id="row">
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">
                Perfis
            </h3>
            <div class="box-tools pull-right">
                <a href="<?=\Libs\Helper::getUrl("cadastro")?>" class="btn btn-primary btn-sm" style="color:#fff;" ><i class="fa
                    fa-plus"></i> Novo Perfil</a>
            </div>
        </div>
        <div class="box-body">
            <table id="listagem" class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>Título</th>
                    <? if(APPID == ROOTAPP) { ?>
                        <th>Aplicação</th>
                    <?}?>
                    <th width="30px">Ativo</th>
                    <th style="width:18px" align="center"></th>
                </tr>
                </thead>
                <tbody>
                <?
                if(is_array($Model) && count($Model) > 0)
                {
                    foreach($Model as $item)
                    {
                        ?>
                        <tr>
                            <td><?=$item->Titulo;?></td>
                            <? if(APPID == ROOTAPP) { ?>
                                <td><?=$item->Aplicacao->Titulo;?></td>
                            <?}?>

                            <td>

                                <input type="checkbox" ref="<?=@$item->PerfilId;?>" name="my-checkbox" class="switch" <? if($item->Ativo == 1) echo "checked";?> data-size="mini" data-off-color="danger" data-on-text="Sim" data-off-text="Não">
                            </td>
                            <td align="center">

                                <div class="btn-group">
                                    <i class="fa fa-bars" class="dropdown-toggle"
                                       data-toggle="dropdown"></i>
                                    <ul class="dropdown-menu pull-right" role="menu">
                                        <li><a href="<?=\Libs\Helper::getUrl("cadastro","",@$item->PerfilId);?>"><i class="fa fa-edit"></i>
                                                Editar</a></li>
                                        <li><a onclick="Excluir(<?=@$item->PerfilId;?>)"><i
                                                    class="fa
                                        fa-trash-o"></i> Excluir</a></li>

                                    </ul>


                                </div>

                            </td>
                        </tr>
                    <?
                    }
                }else
                {
                    echo "<tr><td colspan='2'>Nenhum Registro</td></tr>";
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

