<div class="login-box">
    <div class="login-box-body">
        <form method="post" id="loginForm">
            <div id="erros" style="display: none;">
                <div class="alert alert-danger alert-dismissable">
                    <i class="fa fa-ban"></i>
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                </div>
            </div>
            <div class="form-group has-feedback">
                <input type="text" name="Login" class="form-control" placeholder="Usuario ou Email"/>
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" name="Senha" class="form-control" placeholder="Senha"/>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-4 pull-right">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Entrar</button>
                </div><!-- /.col -->
            </div>
        </form>

        <a href="#">Esqueci Minha Senha</a><br>
        <a href="register.html" class="text-center">Registrar-se</a>

    </div><!-- /.login-box-body -->
</div><!-- /.login-box -->

<script>

    $(function(){
        $("#loginForm").submit(function(){
            var dados = $("#loginForm").serialize();

            $.ajax({
                type: "POST",
                url: "<?=URL?>login/auth",
                data: dados,
                success: function( data )
                {
                    console.log(data);
                    //data = JSON.parse(JSON.stringify(data));
                    if(data.Erros.length > 0){
                        // Logou com sucesso
                        $("#erros").show();
                        $("#erros").html("");
                        $.each(data.Erros, function(i, item){
                            $("#erros").append('<div class="alert alert-danger alert-dismissable">\
                             '+item+'\
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;\
                            </button>\
                            </div>');
                        });
                    }else{
                        // Erro ao efetuar o login
                        if((isNaN(data.Usuario.AplicacaoId) && data.Usuario.AplicacaoId.toInt() > 0) || data.Usuario.AplicacaoId > 0) {
                            $("#erros").hide();
                            location.href = "<?=URL?>home/";
                        }else{
                            $("#erros").hide();
                            location.href = "<?=URL?>login/selecionaAplicacao";
                        }
                    }
                }
            });
            return false;
        });
    });

</script>