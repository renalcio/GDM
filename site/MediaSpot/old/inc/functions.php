<?
#Tratamento de Titulo
function FormataTexto($texto){
    $este = Array("´"); 
    $por = Array("'"); 
    return str_replace( $este, $por, $texto); 
}

#Separa nome
function nome($nome, $numero_de_partes=2, $abreviar=false, $qtdabrv="1"){
    $numero_de_partes = $numero_de_partes-1;
	$nomea = explode(" ", $nome);
    $in = 0;
    $nomefinal ="";
    foreach($nomea as $nomeparte){
        if($abreviar==false){
       if($in<=$numero_de_partes){
        $nomefinal .= $nomeparte." ";
       }
       }else{
        if($in<$numero_de_partes){
        $nomefinal .= $nomeparte." ";
       }
       if($in==$numero_de_partes){
        $abreviacao = substr($nomeparte,0,$qtdabrv).".";
        $nomefinal = $nomefinal.$abreviacao;
       }
       }
       $in++;
    }
	return $nomefinal;
}

#Calcula data comparanda com ontem e hoje para exibir o texto
function datas($data) { 
$data_do_bd = date("d/m/Y",$data); 

$a_data_d = date("d"); 
$a_data_m = date("m"); 
$a_data_a = date("Y"); 

$a_data_ontem_d = date('d', strtotime('-1 day')); 
$a_data_ontem_m = date('m', strtotime('-1 day')); 
$a_data_ontem_a = date('Y', strtotime('-1 day')); 

if(strstr($data_do_bd, $a_data_d)==TRUE && 
strstr($data_do_bd, $a_data_m)==TRUE && 
strstr($data_do_bd, $a_data_a)==TRUE) { 
echo "Hoje"; 
} elseif(strstr($data_do_bd, $a_data_ontem_d)==TRUE && 
strstr($data_do_bd, $a_data_ontem_m)==TRUE && 
strstr($data_do_bd, $a_data_ontem_a)==TRUE) { 
echo "Ontem"; 
} else { 
return "$data_do_bd"; 
} 
} 

#DIA DA SEMANA DE ACORDO COM O NUMERO (1 a 7)
function dia($dnumero){
	switch($dnumero){
		case 1:
		$dia = "Domingo";
		break;
		case 2:
		$dia = "Segunda-feira";
		break;
		case 3:
		$dia = "Terça-feira";
		break;
		case 4:
		$dia = "Quarta-feira";
		break;
		case 5:
		$dia = "Quinta-feira";
		break;
		case 6:
		$dia = "Sexta-feira";
		break;
		case 7:
		$dia = "Sabado";
		break;
	}
	return $dia;
}
	

#SOCIALBAR
# Autor: Renalcio Carlos
#  Data: 14/04/2013
function social(){
		echo '
	<!-- AddThis Button BEGIN -->
<div class="addthis_toolbox addthis_default_style addthis_32x32_style">
<a class="addthis_button_facebook"></a>
<a class="addthis_button_twitter"></a>
<a class="addthis_button_google_plusone_share"></a>
</div>
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=undefined"></script>
<!-- AddThis Button END -->
';	
}

##########################
# ENCURTADOR DE URL      #
# Autor: Renalcio Carlos #
# Data: 15/05/2012       #
# API: Migre.me          #
##########################
function short($urlf){
	
$url = file_get_contents("http://migre.me/api.txt?url=$urlf");
echo $url;
}
function atualshort(){
	$server = $_SERVER['SERVER_NAME']; 
$endereco = $_SERVER ['REQUEST_URI'];
$urlf = "http://".$server."".$endereco."";
$url = file_get_contents("http://migre.me/api.txt?url=$urlf");
return $url;
}


# Tratamento de STRINGS
# Data: 11/03/2013
# APIS: Texto para URL / Remover espaço/ Transformar em minuscula / Limpar String / Limitar caracteres em X / Remover acentos / Remover Determinada TAG
function clean($str)
{
$cleaned = addslashes(stripslashes( $str ));
return $cleaned;
}
function acentos($texto) 
{ 
$array1 = array( "á", "à", "â", "ã", "ä", "é", "è", "ê", "ë", "í", "ì", "î", "ï", "ó", "ò", "ô", "õ", "ö", "ú", "ù", "û", "ü", "ç" 
, "Á", "À", "Â", "Ã", "Ä", "É", "È", "Ê", "Ë", "Í", "Ì", "Î", "Ï", "Ó", "Ò", "Ô", "Õ", "Ö", "Ú", "Ù", "Û", "Ü", "Ç" ); 
$array2 = array( "a", "a", "a", "a", "a", "e", "e", "e", "e", "i", "i", "i", "i", "o", "o", "o", "o", "o", "u", "u", "u", "u", "c" 
, "A", "A", "A", "A", "A", "E", "E", "E", "E", "I", "I", "I", "I", "O", "O", "O", "O", "O", "U", "U", "U", "U", "C" ); 
return str_replace( $array1, $array2, $texto); 
}
function removetag($texto,$tag){
$array1 = array( "<".$tag.">", "</".$tag.">"); 
$array2 = array( "", "");
$texto = preg_replace("/[^a-zA-Z0-9\s]/", "", $texto); 
return str_replace( $array1, $array2, $texto);
}
function limitar($string, $tamanho, $final='...', $encode = 'UTF-8') {
	$num = strlen($final);
    if( strlen($string) > $tamanho )
        $string = mb_substr($string, 0, $tamanho - $num, $encode) . $final;
    else
        $string = mb_substr($string, 0, $tamanho, $encode);
 
    return $string;
}
function txt2url($texto){
 $texto = preg_replace("/[^a-zA-Z0-9]/", "-", $texto);
 $texto = strtolower($texto);
 return $texto;
}
function minuscula($texto) 
{
return strtolower($texto);
} 
function espaco($texto) 
{ 
$este = " "; 
$por = "-"; 
return str_replace( $este, $por, $texto); 
} 
# Barra Lateral
# Data: 11/03
function sidebar(){
	global $sidebar;
	$sidebar = "off";
	return $sidebar;
}

# Upload de imagens 
# Data: 11/03/2013
# Parâmetros: ( largunra, altura, url de retorno)
function uploadimg($width="",$height="",$return=""){
	echo '
 <center><!-- image preview area-->
	<img id="uploadPreview" style="display:none;"/>
	
	<!-- image uploading form -->
	<form action="upload/upload.php?w='.$width.'&h='.$height.'" method="post" enctype="multipart/form-data">
		<input id="uploadImage" type="file" accept="image/jpeg,image/gif,image/png" name="image" />
		<input type="submit" value="Enviar" class="botao azulb">

		<!-- hidden inputs -->
		<input type="hidden" id="x" name="x" />
		<input type="hidden" id="y" name="y" />
		<input type="hidden" id="w" name="w" />
		<input type="hidden" id="h" name="h" />
	</form>
    </center>
';
	
}
function MudaAvatar($width="",$height="",$usuario="",$return=""){
	echo '
	<img id="uploadPreview" style="display:none; vertical-align: middle; margin-left:20px; width:500px;"/>
	<br><br>
	<!-- image uploading form -->
	<form action="upload/avatar.php?w='.$width.'&h='.$height.'&u='.$usuario.'&r='.$return.'" method="post" enctype="multipart/form-data">
		<input id="uploadImage" type="file" accept="image/jpeg,image/gif,image/png" name="image" style="padding: 3px; padding-bottom:4px" />
		<input type="submit" value="Enviar" class="botao azulb">

		<!-- hidden inputs -->
		<input type="hidden" id="x" name="x" />
		<input type="hidden" id="y" name="y" />
		<input type="hidden" id="w" name="w" />
		<input type="hidden" id="h" name="h" />
	</form>

';
	
}
# Borda arredondada em CSS
# Data: 10/03/2013
# Parâmetros: topo esquerdo, topo direito, base direita, base esquerda. Se usado somente Topo esquerdo sera aplicado a todos.
function radius($te='',$td='',$bd='',$be='') {
if(($te!='') && ($td=='') && ($be=='') && ($bd=='')){
echo "
-webkit-border-radius: ".$te."px;
-moz-border-radius: ".$te."px;
border-radius: ".$te."px;";
}
else{
	echo "
-webkit-border-top-left-radius: ".$te."px;
-webkit-border-top-right-radius: ".$td."px;
-webkit-border-bottom-right-radius: ".$bd."px;
-webkit-border-bottom-left-radius: ".$be."px;
-moz-border-radius-topleft: ".$te."px;
-moz-border-radius-topright: ".$td."px;
-moz-border-radius-bottomright: ".$bd."px;
-moz-border-radius-bottomleft: ".$be."px;
border-top-left-radius: ".$te."px;
border-top-right-radius: ".$td."px;
border-bottom-right-radius: ".$bd."px;
border-bottom-left-radius: ".$be."px;
";
}
} 