<?
if(is_array($Model->ListApps) && count($Model->ListApps) > 0)
{
    ?>
    <script type="text/javascript">
        $(function() {
            $("#listagem").dataTable({
                "aoColumns": [ null, {"bSortable": false} ]
            });
        });

        function Excluir(Id){
            bootbox.confirm('Deseja realmente excluir este item?', function(result){
                if(result)
                    location.href="<?=URL;?>Aplicacao/deletar/"+Id;

            });
        }
    </script>
<? } ?>

<div class="row">
        <a href="<?=URL?>Aplicacao/cadastro" class="btn btn-primary pull-right" style="color:#fff;" >Nova
            Aplicação</a>
</div>

<div class="row">
    <div class="panel">
        <div class="panel-header">
            <h3 class="box-title">
                <i class="fa fa-table"></i> Aplicações
            </h3>
            <div class="control-btn">
                <a href="#" class="panel-toggle"><i class="fa fa-angle-down"></i></a>
                <a href="#" class="panel-close"><i class="icon-trash"></i></a>
                <a href="#" class="panel-maximize hidden"><i class="icon-size-fullscreen"></i></a>
            </div>
        </div>
        <div class="panel-content pagination2">

            <table id="listagem" class="table table-hover">
                <thead>
                <tr>
                    <th>Aplicação</th>
                    <th style="width:18px" align="center"></th>
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
                            <td align="center">

                                <div class="btn-group">
                                    <i class="fa fa-bars" class="dropdown-toggle"
                                       data-toggle="dropdown"></i>
                                    <ul class="dropdown-menu pull-right" role="menu">
                                        <li><a href="<?=URL;
                                            ?>Aplicacao/cadastro/<?=$App->AplicacaoId;?>"><i class="fa fa-edit"></i>
                                                Editar</a></li>
                                        <li><a onclick="Excluir(<?=$App->AplicacaoId;?>)"><i
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

