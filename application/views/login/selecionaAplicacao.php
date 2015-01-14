<div class="form-box" id="login-box">
	<div class="header">
		Selecionar Aplicação
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

			<div class="list-group">
				<?
				if(count(@$Model) > 0){
					foreach(@$Model as $item){
						?>
						<a href="<?=\Libs\Helper::getUrl("selecionaAplicacao", "login", $item->Aplicacao->AplicacaoId)
						;?>"
						   class="list-group-item">
							<table width="100%">
								<tr>
									<td valign="middle"><?=$item->Aplicacao->Titulo;?></td>
									<td valign="middle" align="right" width="24px">
										<i class="glyphicon glyphicon-chevron-right text-green"></i>
									</td>
								</tr>
							</table>
						</a>
						<?
					}
				}
				?>

			</div>
		</div>
		<div class="footer">
			<a href="<?=\Libs\Helper::getUrl("logout");?>" class="btn bg-red btn-block">
				Sair
			</a>
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