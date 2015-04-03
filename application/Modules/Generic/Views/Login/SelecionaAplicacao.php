<div class="login-box">
    <div class="login-logo">
        <a href="../../index2.html"><b>Selecionar</b> Aplicação</a>
    </div><!-- /.login-logo -->
    <div class="login-box-body">

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

</div>