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

        $("#MensagemMain .overlay").show();
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
            $("#MensagensCaixa").show();
            $("#MensagensLer").hide();
            $("#MensagemMain .overlay").hide();
            Count();
        });
    }

    function Ler(id){
        $("#MensagemMain .overlay").show();
        $.get("<?=URL?>mensagem/ler/"+id, function(data){
            $("#MensagensLer").html(data);

            $("#MensagensCaixa").hide();
            $("#MensagensLer").show();
            $("#MensagemMain .overlay").hide();
            Count();
        });
    }

    function Count(){
        console.log("<?=URL?>handler/mensagem/Count/");
          $.get("<?=URL?>handler/mensagem/Count/", function(data){
          $("#linkEntrada").html('<i class="fa fa-inbox"></i> Entrada');
            $("#linkLixeira").html('<i class="fa fa-trash-o"></i> Lixeira');

            if(data.Entrada > 0){
                $("#linkEntrada").append(' <span class="label label-primary pull-right">'+data.Entrada+'</span>');
            }
           if(data.Lixeira.toInt() > 0){
                $("#linkLixeira").append(' <span class="label label-primary pull-right">'+data.Lixeira+'</span>');
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
        $("#MenuMensagem li").removeClass("active");
        $("#MenuMensagem li:eq(0)").addClass("active");
        $(".trDe").html("De");
    }

    function CaixaSaida(){
        $(".EntradaItens").hide();
        $("#BuscaPagina").val(1);
        $("#BuscaSaida").val(1);
        $("#BuscaLixeira").val(0);
        $("#PagTitulo").html("Caixa de Saida");
        GetMensagens();
        $("#MenuMensagem li").removeClass("active");
        $("#MenuMensagem li:eq(1)").addClass("active");
        $(".trDe").html("Para");
    }

    function Lixeira(){
        $(".EntradaItens").hide();
        $("#BuscaPagina").val(1);
        $("#BuscaSaida").val(0);
        $("#BuscaLixeira").val(1);
        $("#PagTitulo").html("Lixeira");
        GetMensagens();
        $("#MenuMensagem li").removeClass("active");
        $("#MenuMensagem li:eq(2)").addClass("active");
        $(".trDe").html("De");
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
                <ul class="nav nav-pills nav-stacked" id="MenuMensagem">
                    <li class="active"><a href="#" onclick="CaixaEntrada()" id="linkEntrada"><i class="fa
                    fa-inbox"></i> Entrada</a></li>
                    <li><a href="#" onclick="CaixaSaida()"><i class="fa fa-envelope-o"></i> Saida</a></li>
                    <li><a href="#" onclick="Lixeira()" id="linkLixeira"><i class="fa fa-trash-o"></i> Lixeira</a></li>
                </ul>
            </div><!-- /.box-body -->
        </div><!-- /. box -->
    </div><!-- /.col -->
    <div class="col-md-9" id="MensagemMain">
        <div class="row">
            <!-- Loading (remove the following to stop the loading)-->
            <div class="overlay text-center">
                <i class="fa fa-refresh fa-spin"></i>
            </div>
            <!-- end loading -->
            <div class="col-md-12" id="MensagensCaixa">
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
                                        <th class="EntradaItens"><input type="checkbox" class="chkDeleteAll chkDelete minimal" /></th>
                                        <th></th>
                                        <th width="50%">Assunto</th>
                                        <th class="trDe">De</th>
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
                                        <th class="trDe">De</th>
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
            <div class="col-md-12" id="MensagensLer" style="display:none;"></div>
        </div>
    </div>
</div><!-- /.row -->