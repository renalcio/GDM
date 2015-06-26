<?
if(is_array($Model->ListUsuario) && count($Model->ListUsuario) > 0)
{?>
    <script type="text/javascript">
        $(function() {

            $(".switch").on('switchChange.bootstrapSwitch', function(event, state) {
                var ref = $(this).attr("ref"); // true | false
                $.getJSON("<?=URL;?>handler/usuario/MudaStatus/"+ref+"/"+state, function(data){
                    //console.log(data);
                });
            });

            $("#listagem").dataTable({
                "aoColumns": [ null,null,null,<? if(APPID!=ROOTAPP) { echo 'null,  {"bSortable": false}, '; } ?> {"bSortable": false} ]
            });
        });
        function Excluir(Id){
            bootbox.confirm('Deseja realmente excluir este item?', function(result){
                if(result)
                    location.href="<?=URL;?>usuario/deletar/"+Id;

            });
        }
    </script>
<? } ?>
<div class="row">
    <a href="<?=URL?>usuario/cadastro" class="btn btn-primary pull-right" style="color:#fff;" >Novo registro</a>
</div>
<div class="row">
    <div class="panel panel-primary">
        <div class="panel-header">
            <h3 class="panel-title">
                Usuários
            </h3>
        </div>
        <div class="panel-content pagination2">
            <table id="listagem" class="table table-hover">
                <thead>
                <tr>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Login</th>
                    <? if(APPID != ROOTAPP){ ?>
                        <th width="30px">Nível</th>
                        <th width="30px">Ativo</th>
                    <? } ?>
                    <th style="width:18px"></th>
                </tr>
                </thead>
                <tbody>
                <?
                if(is_array($Model->ListUsuario) && count($Model->ListUsuario) > 0)
                {
                    foreach($Model->ListUsuario as $item)
                    {
                        ?>
                        <tr>
                            <td><?=$item->Pessoa->Nome;?></td>
                            <td><?=$item->Pessoa->Email;?></td>
                            <td><?=$item->Login;?></td>
                            <? if(APPID != ROOTAPP){ ?>
                                <td><?=\Libs\UsuarioHelper::GetNivel($item->UsuarioId);?></td>
                                <td>
                                    <input type="checkpanel" ref="<?=@$item->UsuarioId;?>" name="my-checkpanel" class="switch" <? if($item->Ativo == 1) echo "checked";?> data-size="mini" data-off-color="danger" data-on-text="Sim" data-off-text="Não">
                                </td>
                            <? } ?>
                            <td align="center">

                                <div class="btn-group">
                                    <i class="fa fa-bars" class="dropdown-toggle"
                                       data-toggle="dropdown"></i>
                                    <ul class="dropdown-menu pull-right" role="menu">
                                        <li><a href="<?=URL;
                                            ?>usuario/cadastro/<?=$item->UsuarioId;?>"><i class="fa fa-edit"></i>
                                                Editar</a></li>
                                        <li class="dropdown-danger"><a onclick="Excluir(<?=$item->UsuarioId;?>)"><i
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

