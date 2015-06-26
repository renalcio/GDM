<div class="container" id="login-block">
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4">
            <div class="account-wall" style="background-color: rgb(255, 255, 255);">
                <i class="user-img icons-faces-users-03"></i>
                <div id="erros" style="display: none;">
                    <div class="alert alert-danger alert-dismissable">
                        <i class="fa fa-ban"></i>
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    </div>
                </div>
                <form class="form-signin" id="loginForm" role="form">
                    <div class="append-icon">
                        <input type="text" name="Login" id="Login" class="form-control form-white username" placeholder="Usuario ou Email" required="">
                        <i class="icon-user"></i>
                    </div>
                    <div class="append-icon m-b-20">
                        <input type="password" name="Senha" class="form-control form-white password" placeholder="••••••" required="">
                        <i class="icon-lock"></i>
                    </div>
                    <button type="submit" id="submit-form" class="btn btn-lg btn-danger btn-square btn-block ladda-button" data-style="expand-left">Entrar</button>
                    <div class="clearfix">
                        <p class="pull-left m-t-20"><a id="password" href="#">Esqueceu a senha?</a></p>
                        <p class="pull-right m-t-20"><a href="user-signup-v1.html">Registrar-se</a></p>
                    </div>
                </form>
                <form class="form-password" role="form">
                    <div class="append-icon m-b-20">
                        <input type="password" name="password" class="form-control form-white password" placeholder="Password" required="">
                        <i class="icon-lock"></i>
                    </div>
                    <button type="submit" id="submit-password" class="btn btn-lg btn-danger btn-block ladda-button" data-style="expand-left">Enviar link para resetar a senha</button>
                    <div class="clearfix">
                        <p class="pull-left m-t-20"><a id="login" href="#">Entrar</a></p>
                        <p class="pull-right m-t-20"><a href="user-signup-v1.html">Registrar-se</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <p class="account-copyright" style="position: relative; margin-top: 40px;">
        <span>Copyright © <?=date("Y");?> </span><span>GDM</span>.<span>Todos os direitos reservados.</span>
    </p>
</div>

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