<?php
class MysqlHelper{
    // Coloque aqui as Informações do Banco de Dados
    var $host = "localhost";
    var $user = "movew579"; # Usuário no Host/Servidor
    var $senha = "qbog46id"; # Senha no Host/Servidor
    var $dbase = "movew579_mediaspot"; # Nome do seu Banco de Dados

    // Cria as variáveis que Utilizaremos
    var $strquery;
    var $link;
    var $resultado;
    var $id;
    
    function MySQL(){
        // Instancia o Objeto para usarmos
    }
    
    function getLink(){
        return mysql_connect($this->host,$this->user,$this->senha);
    }
    
    // Cria a função para Conectar ao Banco MySQL
    function conecta(){
        $this->link = @mysql_connect($this->host,$this->user,$this->senha);
        // Conecta ao Banco de Dados
        if(!$this->link){
            // Caso ocorra um erro, exibe uma mensagem com o erro
            echo "Ocorreu um Erro na conexão MySQL:";
            echo "<b>".mysql_error()."</b>";
            die();
        }else{
            if(!mysql_select_db($this->dbase,$this->link)){
            // Seleciona o banco após a conexão
            // Caso ocorra um erro, exibe uma mensagem com o erro
            echo "Ocorreu um Erro em selecionar o Banco:";
            echo "<b>".mysql_error()."</b>";
            die();
        }else{
            mysql_query("SET NAMES 'utf8'");
            mysql_query('SET character_set_connection=utf8');
            mysql_query('SET character_set_client=utf8');
            mysql_query('SET character_set_results=utf8');
        }
        }
    }


    // Cria a função para query no Banco de Dados
    function query($strquery){
        $this->conecta();
        $this->strquery = self::formatQuery($strquery);
        // Conecta e faz a query no MySQL
        if($this->resultado = mysql_query($this->strquery)){
            $this->id = mysql_insert_id();
            $this->desconnecta();
        }else{
            // Caso ocorra um erro, exibe uma mensagem com o Erro
            echo  "Ocorreu um erro ao executar a Query MySQL: <b>$query</b>";
            echo  "<br /><br />";
            echo  "Erro no MySQL: <b>".mysql_error()."</b>";
            die();
            $this->desconnecta();
        }
        return $this->resultado;      
    }
    
    function total($strquery){
        $this->strquery = $strquery;
        return mysql_num_rows($this->strquery);
    }
    
    function associar($strquery){
        $this->strquery = $strquery;
        return mysql_fetch_assoc($this->strquery);
    }
    
    function listar($strquery){
        $this->strquery = $strquery;
        return mysql_fetch_array($this->strquery);
    }

    // Cria a função para Desconectar ao Banco MySQL
    function desconnecta(){
        return mysql_close($this->link);
    }
    
    static function formatQuery($query){
        $args = Array("@ULTIMOID");
        $sbs = Array("LAST_INSERT_ID()");
        return str_replace($args,$sbs,$query);
    }
}
?>