<script type="text/javascript">
    $(function() {
        $("#listagem").dataTable({
            "aoColumns": [ null, {"bSortable": false} ]
        });
    });
</script>

<div class="panel panel-primary">
    <div class="panel-header">
        <h3 class="panel-title">
            Aplicações
        </h3>
    </div>
    <div class="panel-content pagination2">
        <table id="listagem" class="table table-hover">
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
                        <td><?=$App->Titulo;?></td>
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
</div>
</div>
<!-- /.panel-body -->

