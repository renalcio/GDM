<?
if(is_array($Model->Lista) && count($Model->Lista) > 0)
{
    ?>
    <script type="text/javascript">
        $(function() {
            $("#listagem").dataTable({
                "aoColumns": [ null, null, {"bSortable": false}, {"bSortable": false} ]
            });
        });

        function Excluir(Id){
            bootbox.confirm('Deseja realmente excluir este item?', function(result){
                if(result)
                    location.href="<?=\Libs\Helper::getUrl("deletar")?>/"+Id;

            });
        }
    </script>
<? } ?>

<div class="box box-primary">
    <div class="box-header">
        <h3 class="box-title">Artistas</h3>
        <div class="box-tools pull-right">
            <a href="<?=\Libs\Helper::getUrl("cadastro")?>" class="btn btn-primary btn-sm" style="color:#fff;" ><i class="fa
                    fa-plus"></i> Novo Artista</a>
        </div>
    </div>
    <div class="box-body">
        <table id="listagem" class="table table-bordered table-hover">
            <thead>
            <tr>
                <th>Nome</th>
                <th>Visitas</th>
                <th style="width:32px">Ativo</th>
                <th style="width:18px" align="center"></th>
            </tr>
            </thead>
            <tbody>
            <?
            if(is_array($Model->Lista) && count($Model->Lista) > 0)
            {
                foreach($Model->Lista as $Item)
                {
                    //$Item = new \DAL\Artista();
                    ?>
                    <tr>
                        <td><?=$Item->Titulo;?></td>
                        <td><?=$Item->Visitas;?></td>
                        <th style="width:32px">Ativo</th>
                        <td align="center">

                            <div class="btn-group">
                                <i class="fa fa-bars" class="dropdown-toggle"
                                   data-toggle="dropdown"></i>
                                <ul class="dropdown-menu pull-right" role="menu">
                                    <li><a href="<?=\Libs\Helper::getUrl("cadastro","", $Item->ArtistaId)?>"><i
                                                class="fa fa-edit"></i>
                                            Editar</a></li>
                                    <li><a onclick="Excluir(<?=@$Item->ArtistaId;?>)"><i class="fa fa-trash-o"></i> Excluir</a></li></ul>
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

