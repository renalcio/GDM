<?
//var_dump($Model);
if($Model->Lista->Count() > 0)
{
    ?>
    <script type="text/javascript">
        $(function() {
            $("#listagem").dataTable({
                "aoColumns": [ {"bSortable": false}, null, null, null, null, null, null, null, null, {"bSortable": false} ],
                "fnDrawCallback" : function() {
                    iChecks();
                },
                "order": [[ 1, "asc" ]]
            });
        });

        function iChecks(){
            $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck('destroy');
            $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
                checkboxClass: 'icheckbox_minimal-blue',
                radioClass: 'iradio_minimal-blue'
            });

            $(".chkDeleteAll").on('ifChecked', function(event){
                $(".chkDelete").iCheck('check');
            });

            $(".chkDeleteAll").on('ifUnchecked', function(event){
                $(".chkDelete").iCheck('uncheck');
            });
        }
        function Excluir(Id){
            bootpanel.confirm('Deseja realmente excluir este item?', function(result){
                if(result)
                    location.href="<?=\Libs\Helper::getUrl("deletar")?>"+Id;

            });
        }
    </script>
<? } ?>
<div class="row">
    <a href="<?=\Libs\Helper::getUrl("Cadastro")?>" class="btn btn-primary pull-right" style="color:#fff;" >Nova
        Aula</a>
</div>
<div class="row">
    <form method="post" action="<?=\Libs\Helper::getUrl("deletar");?>">
        <div class="panel panel-primary">
            <div class="panel-header">
                <h3>Aula</h3>

            </div>
            <div class="panel-content pagination2">
                <table id="listagem" class="table table-hover">
                    <thead>
                    <tr>
                        <th style="width:18px"><input type="checkbox" class="chkDeleteAll chkDelete minimal" /></th>
                        <th>Escola</th>
                        <th>Materia</th>
                        <th>Turma</th>
                        <th>Professor</th>
                        <th>Autor</th>
                        <th>Data</th>
                        <th>De</th>
                        <th>Até</th>
                        <th style="width:18px" align="center"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?
                    if($Model->Lista->Count() > 0)
                    {
                        $Model->Lista->For_Each(function ($Item, $i){
                            ?>
                            <tr>
                                <td><input type="checkbox" class="chkDelete minimal" name="DeleteItems[<?= $i ?>]"
                                           value="<?= $Item->AulaId ?>"/></td>
                                <td><?=$Item->Escola->Nome;?></td>
                                <td><?=$Item->Materia->Titulo;?></td>
                                <td><?=$Item->Turma->Semestre."S ".$Item->Turma->Ano." - ".$Item->Turma->Turno." - ".$Item->Turma->Curso->Titulo;?></td>
                                <td><?=$Item->Professor->Pessoa->Nome;?></td>
                                <td><?=$Item->Aluno->Pessoa->Nome;?></td>
                                <td><?=$Item->Data;?></td>
                                <td><?=$Item->HoraDe;?></td>
                                <td><?=$Item->HoraAte;?></td>
                                <td align="center">
                                    <div class="btn-group">
                                        <i class="fa fa-bars" class="dropdown-toggle"
                                           data-toggle="dropdown"></i>
                                        <ul class="dropdown-menu pull-right" role="menu">
                                            <li><a href="<?=\Libs\Helper::getUrl("cadastro","", $Item->AulaId)?>"><i class="fa fa-edit"></i>Editar</a></li>
                                            <li><a onclick="Excluir(<?=@$Item->AulaId;?>)"><i class="fa fa-trash-o"></i> Excluir</a></li></ul>
                                    </div>

                                </td>
                            </tr>
                        <?
                        });
                    }else
                    {
                        echo "<tr><td colspan='10'>Nenhum Registro</td></tr>";
                    }
                    ?>
                    </tbody>
                </table>
            </div>
            <div class="panel-footer">
                <button type="submit" class="btn btn-default"><i class="fa fa-trash-o"></i> Apagar</button>
            </div>
        </div>
    </form>
</div>
