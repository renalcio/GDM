<?php
namespace Core;
use Libs\Database;
use Libs\Helper;
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

        $urlfinal = APP . 'BLL' . DIRECTORY_SEPARATOR . PASTA . $bll . 'BLL.php';


        if(file_exists($urlfinal)) {
            $this->bll = 'BLL' . DIRECTORY_SEPARATOR . PASTA . $bll."BLL";
            $this->bll = new $this->bll($this->db);
           // require_once $urlfinal;
        }else {
            $urlfinal = APP . 'BLL' . DIRECTORY_SEPARATOR . 'Generic' . DIRECTORY_SEPARATOR . $bll . 'BLL.php';
           // echo "\n\nBLL: ".$urlfinal;

            if(file_exists($urlfinal)) {
                //require_once $urlfinal;
                $this->bll =  'BLL' . DIRECTORY_SEPARATOR . 'Generic' . DIRECTORY_SEPARATOR . $bll."BLL";
                $this->bll = new $this->bll($this->db);
            }else{
                    //require_once APP . '/BLL/' . ucfirst($bll) . 'BLL.php';
                $this->bll =  '/BLL/' . ucfirst($bll)."BLL";
                $this->bll = new $this->bll($this->db);
            }
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
		
        require APP . 'Templates/' . ucfirst($header) . '.php';
		
		
        /*if(empty($controller))
            require APP . 'views/' . $view . '.php';
        else
            require APP . 'views/' . $controller . '/' . $view . '.php';
        */
        Helper::LoadModelView($Model, $view, $controller);
        
		
        require APP . 'Templates/' . ucfirst($footer) . '.php';

        $this->PrintAssets();
    }
    
    public function Redirect($view, $controller = ""){
        if(empty($controller)) $controller = Helper::getController();

            header('location: ' . URL . ucfirst($controller) . '/' . ucfirst($view) . '');
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
}
