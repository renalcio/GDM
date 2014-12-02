<script type="text/javascript">
    $(function() {
        $("#listagem").dataTable({
            "aoColumns": [ null, {"bSortable": false} ]
        });
    });
</script>
	<div id="row">
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title">
					Aplicações
				</h3>
                <div class="box-tools pull-right">
                    <a href="<?=URL?>apps/cadastro" class="btn btn-primary btn-sm" style="color:#fff;" ><i class="fa
                    fa-plus"></i> Nova
                        Aplicação</a>
                </div>
			</div>
			<div class="box-body">
                    <table id="listagem" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                        <th>Aplicação</th>
                        <td width="50px"></td>
                        </tr>
                        </thead>
                        <tbody>
                        <?
                            if(is_array($Model->ListApps) && count($Model->ListApps) > 0)
                            {
                                foreach($Model->ListApps as $App)
                                {
                                    ?>
                        <tr>
                            <td><?=$App->Descricao;?></td>
                            <td>
                                <a href="<?=URL;?>apps/cadastro/<?=$App->AplicacaoId;?>" class="btn btn-xs btn-primary
btn-flat">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="<?=URL;?>apps/deletar/<?=$App->AplicacaoId;?>" class="btn btn-xs btn-danger
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

