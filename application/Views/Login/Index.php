<div class="form-box" id="login-box">
	<div class="header">
		Entrar
	</div>
	<form method="post" id="loginForm">
		<div class="body bg-gray">
        <div id="erros" style="display: none;">
        <div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-ban"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <ul id="errosul"></ul>
                                    </div>
                                    </div>
			<div class="form-group">
				<input type="text" name="Login" class="form-control" placeholder="Usuario ou Email"/>
			</div>
			<div class="form-group">
				<input type="password" name="Senha" class="form-control" placeholder="Senha"/>
			</div>
			<div class="form-group">
				<input type="checkbox" name="remember_me"/>
				Lembrar-me
			</div>
		</div>
		<div class="footer">
			<button type="submit" class="btn bg-olive btn-block">
				Entrar
			</button>
			<p>
				<a href="#">Esqueci minha senha</a>
			</p>
		</div>
	</form>
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
                                        $("#errosul").html("");
                                        $.each(data.Erros, function(i, item){
                                           $("#errosul").append("<li>"+item+"</li>"); 
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
</div>