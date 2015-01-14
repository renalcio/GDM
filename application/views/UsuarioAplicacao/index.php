<?
if(is_array($Model->ListUsuario) && count($Model->ListUsuario) > 0)
{?>
<script type="text/javascript">
    $(function() {
        $("#listagem").dataTable({
            "aoColumns": [ null,null,null,<? if(APPID==ROOTAPP) { echo "null, "; } ?> {"bSortable": false}, {"bSortable": false} ]
        });
    });
    function Excluir(Id){
        bootbox.confirm('Deseja realmente excluir este item?', function(result){
            if(result)
                location.href="<?=URL;?>usuarioaplicacao/deletar/"+Id;

        });
    }
</script>
<? } ?>
	<div id="row">
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title">
					Vínculos de Usuários
				</h3>
                <div class="box-tools pull-right">
                    <a href="<?=\Libs\Helper::getUrl("cadastro")?>" class="btn btn-primary btn-sm" style="color:#fff;" ><i class="fa
                    fa-plus"></i> Novo registro</a>
                </div>
			</div>
			<div class="box-body">
                    <table id="listagem" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                        <th>Nome</th>
                            <th>Email</th>
                            <th>Login</th>
                            <? if(APPID == ROOTAPP) {
                                ?><th>Aplicação</th><?
                            } ?>
                            <th width="30px">Nível</th>
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
                            <td><?=$item->Usuario->Pessoa->Nome;?></td>
                            <td><?=$item->Usuario->Pessoa->Email;?></td>
                            <td><?=$item->Usuario->Login;?></td>
                            <? if(APPID == ROOTAPP) {
                                ?><td><?=$item->Aplicacao->Titulo;?></td><?
                            } ?>
                            <td><?=\Libs\Usuario::GetNivel($item->UsuarioId);?></td>

                            <td align="center">

                                <div class="btn-group">
                                    <i class="fa fa-bars" class="dropdown-toggle"
                                       data-toggle="dropdown"></i>
                                    <ul class="dropdown-menu pull-right" role="menu">
                                        <li><a href="<?=\Libs\Helper::getUrl("cadastro", "usuarioaplicacao", $item->UsuarioAplicacaoId)?>"><i class="fa
                                            fa-edit"></i>
                                                Editar</a></li>
                                        <li class="dropdown-danger"><a onclick="Excluir(<?=$item->UsuarioAplicacaoId;?>)"><i
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

