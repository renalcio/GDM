<?php
namespace Libs;
class Helper
{

    public static function Abreviar($Nome, $NumNome = 2){
        $array = explode(" ", $Nome);
        $retorno= "";
        for($i = 0; $i < $NumNome; $i++){
            if(isset($array[$i])) {
                $retorno .= $array[$i];
                if ($i != ($NumNome - 1))
                    $retorno .= " ";
            }
        }
        return $retorno;
    }

    public static function SomenteNumeros($Texto){
        $pattern = "/[^0-9]/mi";
        return preg_replace($pattern, '', $Texto);
    }
    /**
     * Converter POST para Model
     */
    public static function CastPost()
    {
        $Model = null;
        //Verifica se exite post
        if (isset($_POST) && count($_POST) > 0) {
            //var_dump($_POST);
            $Model = self::CastArray($_POST);
        }

        return $Model;
    }

    private static function CastArray($Array)
    {
        if ( count($Array) > 0) {
            $Retorno = Array();
            //trata o post adequadamente
            foreach ($Array as $key => $valor) {
                //Verifica se a key tem _
                if (strpos($key, "_") !== false) {
                    $nivel = substr_count($key, "_");
                    $na = 0;
                    //Monta o novo indice
                    $nova_key = explode("_", $key);
                    $nova_key = $nova_key[$na];
                    $nova_subkey = explode("_", $key);
                    $nova_subkey = $nova_subkey[$na + 1];
                    if($nivel > 1) {
                        for ($na = 1; $na < $nivel; $na++) {
                            $arrtemp = explode("_", $key);
                            $nova_subkey .= "_" . $arrtemp[$na + 1];

                        }
                    }
                    //Busca o novo indice no post
                    if (isset($Retorno[$nova_key])) {
                        //Adiciona o valor ao nova key existente
                        $Retorno[$nova_key][$nova_subkey] = $valor;
                    } else {
                        //Cria nova key no POST
                        $Retorno[$nova_key] = Array($nova_subkey => $valor);
                    }
                } else {
                    $Retorno[$key] = $valor;
                }
            }

            foreach($Retorno as $k=>$item) {
                if (is_array($Retorno[$k]) && count($Retorno[$k]) > 0) {
                    $Retorno[$k] = self::CastArray($Retorno[$k]);
                }
            };


        }
        return $Retorno;
    }
    /**
     * Class casting
     *
     * @param string|object $destination
     * @param object $sourceObject
     * @return object
     */
    static function cast(&$Dados, $Classe="\\stdClass")
    {
        if(is_array($Dados))
            $Dados = self::arrayToObject($Dados, $Classe);

        else if(is_object($Dados))
            $Dados = self::objectToObject($Dados, $Classe);
    }

    private static function arrayToObject(array $array, $className) {
        if(is_object($className))
            $className = get_class($className);

        return unserialize(sprintf(
            'O:%d:"%s"%s',
            strlen($className),
            $className,
            strstr(serialize($array), ':')
        ));
    }

    private static function objectToObject($instance, $className) {
        if(is_object($className))
            $className = get_class($className);

        return unserialize(sprintf(
            'O:%d:"%s"%s',
            strlen($className),
            $className,
            strstr(strstr(serialize($instance), '"'), ':')
        ));
    }

    /**
     * debugPDO
     *
     * Shows the emulated SQL query in a PDO statement. What it does is just extremely simple, but powerful:
     * It combines the raw query and the placeholders. For sure not really perfect (as PDO is more complex than just
     * combining raw query and arguments), but it does the job.
     *
     * @author Panique
     * @param string $raw_sql
     * @param array $parameters
     * @return string
     */
    static public function debugPDO($raw_sql, $parameters) {

        $keys = array();
        $values = $parameters;

        foreach ($parameters as $key => $value) {

            // check if named parameters (':param') or anonymous parameters ('?') are used
            if (is_string($key)) {
                $keys[] = '/' . $key . '/';
            } else {
                $keys[] = '/[?]/';
            }

            // bring parameter into human-readable format
            if (is_string($value)) {
                $values[$key] = "'" . $value . "'";
            } elseif (is_array($value)) {
                $values[$key] = implode(',', $value);
            } elseif (is_null($value)) {
                $values[$key] = 'NULL';
            }
        }


        $raw_sql = preg_replace($keys, $values, $raw_sql, 1, $count);

        return $raw_sql;
    }

    static function getUrl($Action="", $Controller="", $Parametros = ""){
        if(empty($Action))
            $Action = self::getAction();
        if(empty($Controller))
            $Controller = self::getController();

        $strParametros = "";
        if(is_array($Parametros)){
            foreach($Parametros as $key=>$valor){
                $strParametros .= "/".$valor;
            }
        }else
            $strParametros = "/".$Parametros;

        return URL.$Controller."/".$Action.$strParametros;
    }

    static function getAction(){
        // split URL
        if(isset($_GET['url'])){
            $url = trim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            $retorno = isset($url[1]) ? $url[1] : "index";
        }else
            $retorno = "index";
        return $retorno;
    }

    static function getController(){
        // split URL
        if(isset($_GET['url'])){
            $url = trim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);

            $retorno = isset($url[0]) ? $url[0] : "error";
        }else
            $retorno = "error";

        return ucfirst($retorno);
    }

    static function Utf($Mensagem){
        return mb_convert_encoding($Mensagem, "UTF-8", "HTML-ENTITIES");
    }

    static function LoadView($view = "", $controller = ""){
        self::LoadModelView(null, $view, $controller);
    }

    static function LoadModelView($Model = null, $view = "", $controller = ""){
        if(empty($view)) $view = Self::getAction();
        if(empty($controller)) $controller = Self::getController();

        $view = ucfirst($view);
        $controller = ucfirst($controller);
        // load views

        $urlfinal = "";

        if(empty($controller))
            $urlfinal = APP. MODULES . PASTA . 'Views' . DIRECTORY_SEPARATOR . $view . '.php';
        else
            $urlfinal = APP. MODULES . PASTA . 'Views' . DIRECTORY_SEPARATOR . $controller . DIRECTORY_SEPARATOR . $view . '.php';



        if(file_exists($urlfinal))
            require $urlfinal;
        else{
            if(empty($controller))
                $urlfinal = APP. MODULES . 'Generic' . DIRECTORY_SEPARATOR . 'Views' . DIRECTORY_SEPARATOR . $view . '.php';
            else
                $urlfinal = APP. MODULES . 'Generic' . DIRECTORY_SEPARATOR . 'Views' . DIRECTORY_SEPARATOR . $controller . DIRECTORY_SEPARATOR . $view . '.php';
            //echo $urlfinal;
            if(file_exists($urlfinal))
                require $urlfinal;
            else {

                if (empty($controller))
                    require APP . 'Views/' . $view . '.php';
                else
                    require APP . 'Views/' . $controller . '/' . $view . '.php';
            }
        }

    }

    static function LoadMedia($local, Array $arquivos){

        if(isset($arquivos) && count($arquivos > 0)){
            foreach($arquivos as $arquivo){
                if($local=="js")
                echo "<script src=\"".URL.$arquivo."\" type=\"text/javascript\"></script>\n\r";
                if($local=="css")
                    echo "<link href=\"".URL.$arquivo."\"  rel=\"stylesheet\" type=\"text/css\" />\n\r";
            }
        }
    }

}