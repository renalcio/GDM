<?php
namespace Core;
use Libs\Database;
use Libs\Helper;
use Libs\UnitofWork;
use Libs\ModelState;

class Controller
{
    /**
     * @var null Database Connection
     */
    public $db = null;

    /**
     * @var null Model
     */
    public $bll = null;

    public $unitofwork = null;
    public $pdo = null;

    public $jsonAssets = null;

    private $assetCss = null;

    private $assetJs = null;

    private $assetIeCss = null;

    private $assetIeJs = null;

    public $ControllerTitle = null;

    public $ActonTitle = null;

    public $HeaderLayout = null;
    public $FooterLayout = null;

    /**
     * Whenever a controller is created, open a database connection too and load "the model".
     */
    function __construct()
    {
        $this->openDatabaseConnection();
        $this->pdo = new Database();
        $this->unitofwork = new UnitofWork();
        //$this->loadModel();
        $str = file_get_contents(ROOT_URL.'assets.json');
        $json = json_decode($str, true);
        $this->jsonAssets = $json;
    }

    /**
     * Open the database connection with the credentials from application/config/config.php
     */
    private function openDatabaseConnection()
    {
        // set the (optional) options of the PDO connection. in this case, we set the fetch mode to
        // "objects", which means all results will be objects, like this: $result->user_name !
        // For example, fetch mode FETCH_ASSOC would return results like this: $result["user_name] !
        // @see http://www.php.net/manual/en/pdostatement.fetch.php
        $options = array(\PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ, \PDO::ATTR_ERRMODE => \PDO::ERRMODE_WARNING);

        // generate a database connection, using the PDO connector
        // @see http://net.tutsplus.com/tutorials/php/why-you-should-be-using-phps-pdo-for-database-access/
        $this->db = new \PDO(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS, $options);
    }

    /**
     * Loads the "bll".
     * @return object model
     */
    public function loadBLL($bll = "")
    {
        if(empty($bll)) $bll = Helper::getController();

        $urlfinal = APP . 'BLL' . DIRECTORY_SEPARATOR . ucfirst($bll) . 'BLL.php';

        //echo $urlfinal;

        if(file_exists($urlfinal)) {
            $this->bll = 'BLL' . DIRECTORY_SEPARATOR . ucfirst($bll) ."BLL";
            $this->bll = new $this->bll($this->db);
            // require_once $urlfinal;
        }
    }

    public function View($view = "", $controller = "", $header = "", $footer=""){
        $this->ModelView(null, $view, $controller, $header, $footer);
    }

    public function ModelView($Model = "", $view = "", $controller = "", $header = "", $footer = ""){
        if(empty($view)) $view = Helper::getAction();
        if(empty($header))  $header = "Header";
        if(empty($footer))  $footer = "Footer";
        if(empty($controller)) $controller = Helper::getController();
        // load views

        require APP . 'Views/_templates/' . ucfirst($header) . '.php';


        if(empty($controller))
            require APP . 'Views/' . ucfirst($view) . '.php';
        else
            require APP . 'Views/' . ucfirst($controller) . '/' . $view . '.php';


        require APP . 'Views/_templates/' . ucfirst($footer) . '.php';

        //$this->PrintAssets();
    }

    public function Redirect($view, $controller = "", $params = ""){
        if(empty($controller)) $controller = Helper::getController();
        if(empty($view)) $view = "Index";

        if(is_array($params)) {
            $strPars = "";
            foreach ($params as $par) {
                $strPars .= $par.'/';
            }
        }else{
            $strPars = $params;
        }

        header('location: ' . URL . ucfirst($controller) . '/' . ucfirst($view) . '/'. $strPars);
    }


    public function AddAsset($asset){
        if(is_array($asset)){
            foreach($asset as $as){
                $this->AddAsset($as);
            }
        }else{
            $assetItem = $this->jsonAssets[$asset];
            //var_dump($assetItem);
            if(isset($assetItem) && !empty($assetItem)){
                if(isset($assetItem["css"]) && !empty($assetItem["css"])) {
                    foreach($assetItem["css"] as $k => $item){
                        $this->assetCss .= "<link href=\"".$item."\"  rel=\"stylesheet\" type=\"text/css\" />\n\r";
                    }
                }

                if(isset($assetItem["js"]) && !empty($assetItem["js"])) {
                    foreach($assetItem["js"] as $k => $item){
                        $this->assetJs .= "<script src=\"".$item."\" type=\"text/javascript\"></script>\n\r";
                    }
                }

                //IE
                //var_dump($assetItem);
                if(isset($assetItem["ie"]) && !empty($assetItem["ie"])) {

                    if(isset($assetItem["ie"]["js"]) && !empty($assetItem["ie"]["js"])) {
                        foreach($assetItem["ie"]["js"] as $kie => $item){
                            $this->assetIeJs .= "<script src=\"".$item."\" type=\"text/javascript\"></script>\n\r";
                        }
                    }

                    if(isset($assetItem["ie"]["css"]) && !empty($assetItem["ie"]["css"])) {
                        foreach($assetItem["ie"]["css"] as $kie => $item){
                            $this->assetIeCss .= "<link href=\"".$item."\"  rel=\"stylesheet\" type=\"text/css\" />\n\r";
                        }
                    }
                }
                //var_dump($this->assetIeJs);
            }
        }
    }

    public function Asset($asset){
        $this->AddAsset($asset);
    }

    private function PrintAssets(){
        echo "\n<!--CSS-->\n";
        echo $this->assetCss;
        echo "\n<!--JAVASCRIPT-->\n";
        echo $this->assetJs;
        echo "\n<!--IE-->\n";
        echo "\n<!--[if (gte IE 8)&(lt IE 10)]>\n";
        #CSS
        echo $this->assetIeCss;
        #JS
        echo $this->assetIeJs;
        echo "\n<![endif]-->\n";

    }

    public function GetControllerTitle(){
        return ModelState::GetClassTitle($this);
    }

    public function GetActionTitle()
    {
        $action = \Libs\Helper::getAction();
        return ModelState::GetMethodTitle($this, $action);
    }
}
