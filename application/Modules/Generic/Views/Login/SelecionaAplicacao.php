<div class="container" id="login-block">
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4">
    <h2 class="c-white"><b>Selecionar</b> Aplicação</h2>
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
    </div>
</div>