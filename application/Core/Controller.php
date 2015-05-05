<?php
namespace Core;
use Libs\Database;
use Libs\Helper;
use Libs\ModelState;
use Libs\UnitofWork;

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
        $str = file_get_contents(URL.'assets.json');
        $json = json_decode($str, true);
        $this->jsonAssets = $json;
        $this->HeaderLayout = "Header";
        $this->FooterLayout = "Footer";
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

        $urlfinal = APP . MODULES . PASTA  . 'BLL' . DIRECTORY_SEPARATOR. $bll . 'BLL.php';


        if(file_exists($urlfinal)) {
            //require_once $urlfinal;
            $this->bll = MODULES . PASTA . 'BLL' . DIRECTORY_SEPARATOR . $bll."BLL";
            $this->bll = new $this->bll($this->db);
        }else {
            $urlfinal = APP . MODULES . 'Generic' . DIRECTORY_SEPARATOR . 'BLL' . DIRECTORY_SEPARATOR . $bll . 'BLL.php';
           // echo "\n\nBLL: ".$urlfinal;

            if(file_exists($urlfinal)) {
                //require_once $urlfinal;
                $this->bll =  MODULES . 'Generic' . DIRECTORY_SEPARATOR . 'BLL' . DIRECTORY_SEPARATOR . $bll . "BLL";
                $this->bll = new $this->bll($this->db);
            }
        }

    }
    
    public function View($view = "", $controller = "", $header = "", $footer=""){
        $this->ModelView(null, $view, $controller, $header, $footer);
    }

    public function Layout($header="", $footer=""){
        $this->HeaderLayout = ucfirst($header);
        $this->FooterLayout = ucfirst($footer);
    }
    
    public function ModelView($Model = "", $view = "", $controller = ""){
        if(empty($view)) $view = Helper::getAction();
        if(empty($controller)) $controller = Helper::getController();
        // load views

        if(!empty($this->HeaderLayout))
        require APP . 'Templates/' . ucfirst($this->HeaderLayout) . '.php';
		
		
        /*if(empty($controller))
            require APP . 'views/' . $view . '.php';
        else
            require APP . 'views/' . $controller . '/' . $view . '.php';
        */
        Helper::LoadModelView($Model, $view, $controller);

        if(!empty($this->FooterLayout))
        require APP . 'Templates/' . ucfirst($this->FooterLayout) . '.php';

        //$this->PrintAssets();
    }
    
    public function Redirect($view, $controller = "", $data = ""){
        if(empty($controller)) $controller = Helper::getController();

        $strUrl = Helper::getUrl($view, $controller, $data);

            header('location: ' . $strUrl . '');
    }


    public function AddAsset($asset){
        if(is_array($asset)){
            foreach($asset as $as){
                $this->AddAsset($as);
            }
        }else{
            $assetItem = $this->jsonAssets[$asset];

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