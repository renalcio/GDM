﻿<?
if(is_array($Model->ListUsuario) && count($Model->ListUsuario) > 0)
{?>
<script type="text/javascript">
    $(function() {
        $("#listagem").dataTable({
            "aoColumns": [ null,null,null, {"bSortable": false} ]
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
	<div id="row">
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title">
					Usuários
				</h3>
                <div class="box-tools pull-right">
                    <a href="<?=URL?>usuario/cadastro" class="btn btn-primary btn-sm" style="color:#fff;" ><i class="fa
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
                            <td align="center">

                                <div class="btn-group">
                                    <i class="fa fa-bars" class="dropdown-toggle"
                                       data-toggle="dropdown"></i>
                                    <ul class="dropdown-menu pull-right" role="menu">
                                        <li><a href="<?=URL;
                                            ?>usuario/cadastro/<?=$item->UsuarioId;?>"><i class="fa fa-edit"></i>
                                                Editar</a></li>
                                        <li><a onclick="Excluir(<?=$item->UsuarioId;?>)"><i
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

