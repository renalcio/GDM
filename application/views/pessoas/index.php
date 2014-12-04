<?
if(is_array($Model->ListPessoa) && count($Model->ListPessoa) > 0)
{?>
<script type="text/javascript">
    $(function() {
        $("#listagem").dataTable({
            "aoColumns": [ null,null,null,null, {"bSortable": false} ]
        });
    });
</script>
<? } ?>
	<div id="row">
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title">
					Pessoas
				</h3>
                <div class="box-tools pull-right">
                    <a href="<?=URL?>pessoas/cadastro" class="btn btn-primary btn-sm" style="color:#fff;" ><i class="fa
                    fa-plus"></i> Novo registro</a>
                </div>
			</div>
			<div class="box-body">
                    <table id="listagem" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                        <th>Nome</th>
                            <th>Email</th>
                            <th>Telefone</th>
                            <th>Celular</th>
                        <td width="50px"></td>
                        </tr>
                        </thead>
                        <tbody>
                        <?
                            if(is_array($Model->ListPessoa) && count($Model->ListPessoa) > 0)
                            {
                                foreach($Model->ListPessoa as $Pessoa)
                                {
                                    ?>
                        <tr>
                            <td><?=$Pessoa->Nome;?></td>
                            <td><?=$Pessoa->Email;?></td>
                            <td><?=$Pessoa->Telefone;?></td>
                            <td><?=$Pessoa->Celular;?></td>
                            <td>
                                <a href="<?=URL;?>apps/cadastro/<?=$Pessoa->PessoaId;?>" class="btn btn-xs btn-primary
btn-flat">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="<?=URL;?>apps/deletar/<?=$Pessoa->PessoaId;?>" class="btn btn-xs btn-danger
btn-flat">
                                    <i class="fa fa-trash-o"></i>
                                </a>
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

