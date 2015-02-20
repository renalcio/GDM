
<div class="alert alert-dismissable alert-warning" style="display: none;" id="noNotify">
<button type="button" class="close" data-dismiss="alert">×</button>
<h4>Atenção!</h4>
<span></span>
</div>



<div class="container-fluid">
	<div class="row">
		<div class="col-md-8">
          <div class="bs-component">
                <div class="panel panel">
			<?=Bootstrap::SlideArtista("SELECT * FROM Artista ORDER BY Visitas DESC LIMIT 10", "slideMaisVistos", 420);?>
            </div>
		</div>
        </div>
		<div class="col-md-4">
				<div class="panel-default">
        <div class="list-group">
        <?
        $sqlMusicas = $pdo->select("
        SELECT DISTINCT(m.ArtistaId), m.Titulo, a.Titulo as Artista 
        FROM Musica as m, Artista as a 
        WHERE a.ArtistaId = m.ArtistaId
        GROUP BY (m.ArtistaId)
        ORDER BY m.ArtistaId DESC
        LIMIT 10 ");
        foreach($sqlMusicas as $musica){
        ?>
          <a href="#" class="list-group-item" style="text-transform: capitalize;">
            <?=$musica->Artista;?> - <i><?=$musica->Titulo;?></i>
          </a>
          <? } ?>
        </div>
				</div>
			
		</div>
	</div>
</div>

<script>
$(function(){
	notificar({mensagem:"Seja bem-vindo ao MediaSpot!", tempo: 5000, imagem: "http://mediaspot.moveware.com.br/media/img/iconeazulbranco.png"});
});
</script>

