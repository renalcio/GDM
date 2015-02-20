<?
include_once("Database.php");
class Bootstrap {

	public static function SlideArtista($query, $id, $height = 400, $intervalo = 5000){
		$pdof = new Database;
		$sqlTop = $pdof->select($query);
		$html = '
			<div id="'.$id.'" class="carousel slide" data-ride="carousel" data-interval="'.$intervalo.'">
			<!-- Indicators -->
			<ol class="carousel-indicators">
		';
		$i = 0;
		foreach($sqlTop as $item){
			
			$html .= '
			<li data-target="#'.$id.'" data-slide-to="'.$i.'" ';
			if($i == 0) $html .= 'class="active"';
			$html .= '></li>
			';
			
			$i++;
		}
		$html .= '
			</ol>
			<!-- Wrapper for slides -->
			<div class="carousel-inner">
		';
		$i = 0;
		foreach($sqlTop as $item){
			$html .= '<div class="item';
			if($i == 0) $html .= " active"; 
			$html .= '">
				<a href="javascript:void()" onclick="enviaForm(\''.$item->Titulo.'\')">
				<img src="'.$item->Imagem.'" alt="'.$item->Titulo.'" style="width:100%; height: '.$height.'px;"></a>
				<div class="carousel-caption">
				<h3>'.$item->Titulo.'</h3>
				<p>'.limitar($item->Descricao, 150).'</p>
				</div>
				</div>
				';
			$i++;
		}
		$html .= '
				</div>
					<!-- Controls -->
					<a class="left carousel-control" href="#'.$id.'" role="button" data-slide="prev">
						<span class="glyphicon glyphicon-chevron-left"></span>
					</a>
					<a class="right carousel-control" href="#'.$id.'" role="button" data-slide="next">
						<span class="glyphicon glyphicon-chevron-right"></span>
					</a>
				</div>
			';
		return $html;
	}
}
?>
