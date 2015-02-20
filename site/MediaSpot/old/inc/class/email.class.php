<?php
include_once ("mysql.class.php");
include_once ("session.class.php");
class EmailHelper
{
    // Coloque aqui as Informações do Banco de Dados
    var $nome; #Quem está enviando?
    var $de;
    var $para;
    var $assunto;
    var $mensagem;
    private $header; //cabeçalho
    private $corpo;

    function enviar($de, $para, $assunto, $corpo, $nome = "")
    {
        $this->de = $de;
        $this->para = $para;
        $this->assunto = $assunto;
        $this->nome = $nome;
        $this->header = "MIME-Version: 1.0\n";
        $this->header .= "Content-type: text/html; charset=UTF-8\n";
        $this->header .= "From: " . $this->nome . " <" . $this->de . "> \n";
        $this->header .= "Reply-to: " . $this->nome . " <" . $this->de . ">\n";
        $this->corpo = nl2br($corpo);
        $mail = mail($this->para, $this->assunto, $this->corpo, $this->header);
    }

}

?>