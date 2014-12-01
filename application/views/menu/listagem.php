<script type="text/javascript">
    $(function() {
        $("#listagem").dataTable({
            "aoColumns": [ null, {"bSortable": false} ]
        });
    });
</script>
z

    <div id="row">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Filtros</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse"><i class="fa fa-minus"></i></button>
               </div>
        </div>
        <div class="box-body" style="display: block;">

        </div><!-- /.box-body -->
        <div class="box-footer" style="display: block;">
            <div class="row">
                <button type="button" id="addMenuItem" class="btn btn-primary" style="float: right; margin-right: 15px;">
                    Concluido
                </button>
            </div>
        </div><!-- /.box-footer-->
    </div>
        </div>

	<div id="row">
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title">
					Aplicações
				</h3>
			</div>
			<div class="box-body">
                    <table id="listagem" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                        <th>Aplicação</th>
                        <td width="26px"></td>
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
                            <td><a href="<?=URL;?>menu/cadastro/<?=$App->AplicacaoId;?>" class="btn btn-xs btn-primary
btn-flat"><i
                            class="fa
fa-edit"></i></a></td>
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
			<div class="box-footer">
				<div class="row">
					<button type="button" id="btnSalvar" class="btn btn-primary" style="float: right; margin-right: 15px;">
                        Salvar
                    </button>
				</div>
			</div>
    </div>
		</div>
		<!-- /.box-body -->

