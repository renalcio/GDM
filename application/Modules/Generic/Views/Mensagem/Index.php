<script>
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

    function GetMensagens(){
        var termo = $("#BuscaTermo").val(),
            pagina = $("#BuscaPagina").val().toInt(),
            saida = $("#BuscaSaida").val(),
            lixeira = $("#BuscaLixeira").val();
        $("#tbMailBox tbody").html("");

        $.get("<?=URL?>handler/mensagem/GetTable/"+pagina+"/"+saida+"/"+lixeira+"/"+termo, function(data){
            $("#tbMailBox tbody").html(data);
            iChecks();

            var totalItens = $("#tbMailBox tbody tr.trMsgitem").size();
            if(totalItens > 0) {
                var startItem = (50 * (pagina - 1)) + 1;
                var enditem = (startItem - 1) + totalItens;
                $(".pagNumbers").html(startItem + "-" + enditem);
            }else
            {
                $(".pagNumbers").html("");
            }
        });
    }

    function ProxPag(){
        //console.log(pagina);
        pagina = $("#BuscaPagina").val().toInt();
        $("#BuscaPagina").val(pagina + 1);
        GetMensagens();
    }
    function AntPag(){
        pagina = $("#BuscaPagina").val().toInt();
        if(pagina > 1) {
            $("#BuscaPagina").val(pagina - 1);
            GetMensagens();
        }
    }

    function CaixaEntrada(){
        $(".EntradaItens").show();
        $("#BuscaPagina").val(1);
        $("#BuscaSaida").val(0);
        $("#BuscaLixeira").val(0);
        $("#PagTitulo").html("Caixa de Entrada");
        GetMensagens();
    }

    function CaixaSaida(){
        $(".EntradaItens").hide();
        $("#BuscaPagina").val(1);
        $("#BuscaSaida").val(1);
        $("#BuscaLixeira").val(0);
        $("#PagTitulo").html("Caixa de Saida");
        GetMensagens();
    }

    function Lixeira(){
        $(".EntradaItens").hide();
        $("#BuscaPagina").val(1);
        $("#BuscaSaida").val(0);
        $("#BuscaLixeira").val(1);
        $("#PagTitulo").html("Lixeira");
        GetMensagens();
    }

    $(function(){
        iChecks();
        GetMensagens();
        $("#BuscaForm").on("submit", function(){
            GetMensagens();
            return false;
        });
    });

</script>
<div class="row">
    <div class="col-md-3">
        <a href="<?=\Libs\Helper::getUrl("escrever")?>" class="btn btn-primary btn-block margin-bottom">Escrever</a>
        <div class="box box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Pastas</h3>
            </div>
            <div class="box-body no-padding">
                <ul class="nav nav-pills nav-stacked">
                    <li class="active"><a href="#" onclick="CaixaEntrada()"><i class="fa fa-inbox"></i> Entrada <span class="label label-primary pull-right">12</span></a></li>
                    <li><a href="#" onclick="CaixaSaida()"><i class="fa fa-envelope-o"></i> Saida</a></li>
                    <li><a href="#" onclick="Lixeira()"><i class="fa fa-trash-o"></i> Lixeira</a></li>
                </ul>
            </div><!-- /.box-body -->
        </div><!-- /. box -->
    </div><!-- /.col -->
    <div class="col-md-9">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title" id="PagTitulo">Caixa de Entrada</h3>
                <div class="box-tools pull-right" style="width: 40%;">
                    <div class="has-feedback">
                        <form id="BuscaForm">
                            <input type="text" id="BuscaTermo" class="form-control input-sm" placeholder="Digite e pressione enter..."/>
                            <input type="hidden" id="BuscaPagina" value="1"/>
                            <input type="hidden" id="BuscaSaida" value="0"/>
                            <input type="hidden" id="BuscaLixeira"  value="0"/>
                        </form>
                        <span class="glyphicon glyphicon-search form-control-feedback"></span>
                    </div>
                </div><!-- /.box-tools -->
            </div><!-- /.box-header -->
            <form method="post" action="<?=\Libs\Helper::getUrl("deletar");?>">
                <div class="box-body no-padding">

                    <div class="mailbox-controls">
                        <!-- Check all button -->
                        <div class="btn-group">
                            <button type="submit" class="btn btn-default btn-sm EntradaItens"><i class="fa fa-trash-o"></i></button>
                            <button type="button" class="btn btn-default btn-sm EntradaItens"><i class="fa fa-reply"></i></button>
                            <button type="button" class="btn btn-default btn-sm"><i class="fa fa-share"></i></button>
                        </div><!-- /.btn-group -->
                        <button type="button" class="btn btn-default btn-sm" onclick="GetMensagens()"><i class="fa fa-refresh"></i></button>
                        <div class="pull-right">
                            <span class="pagNumbers"></span>
                            <div class="btn-group">
                                <button type="button" class="btn btn-default btn-sm" onclick="AntPag()"><i class="fa
                            fa-chevron-left"></i></button>
                                <button type="button" class="btn btn-default btn-sm" onclick="ProxPag()"><i class="fa fa-chevron-right"></i></button>
                            </div><!-- /.btn-group -->
                        </div><!-- /.pull-right -->
                    </div>
                    <div class="table-responsive mailbox-messages">
                        <table class="table table-hover table-striped" id="tbMailBox">
                            <thead>
                            <tr>
                                <th class="EntradaItens"><input type="checkbox" class="chkDeleteAll chkDelete minimal"
                                        /></th>
                                <th></th>
                                <th width="50%">Assunto</th>
                                <th>De</th>
                                <th>Data</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                            <tfoot>
                            <tr>
                                <th class="EntradaItens"><input type="checkbox" class="chkDeleteAll chkDelete minimal" /></th>
                                <th></th>
                                <th>Assunto</th>
                                <th>De</th>
                                <th>Data</th>
                            </tr>
                            </tfoot>
                        </table><!-- /.table -->
                    </div><!-- /.mail-box-messages -->
                </div><!-- /.box-body -->
                <div class="box-footer no-padding">
                    <div class="mailbox-controls">
                        <!-- Check all button -->

                        <div class="btn-group">
                            <button type="submit" class="btn btn-default btn-sm EntradaItens"><i class="fa fa-trash-o"></i></button>
                            <button type="button" class="btn btn-default btn-sm EntradaItens"><i class="fa fa-reply"></i></button>
                            <button type="button" class="btn btn-default btn-sm"><i class="fa fa-share"></i></button>
                        </div><!-- /.btn-group -->
                        <button type="button" class="btn btn-default btn-sm" onclick="GetMensagens()"><i class="fa fa-refresh"></i></button>
                        <div class="pull-right">
                            <span class="pagNumbers"></span>
                            <div class="btn-group">
                                <button type="button" class="btn btn-default btn-sm" onclick="AntPag()"><i class="fa fa-chevron-left"></i></button>
                                <button type="button" class="btn btn-default btn-sm" onclick="ProxPag()"><i class="fa fa-chevron-right"></i></button>
                            </div><!-- /.btn-group -->
                        </div><!-- /.pull-right -->
                    </div>
                </div>
            </form>
        </div><!-- /. box -->
    </div><!-- /.col -->
</div><!-- /.row -->