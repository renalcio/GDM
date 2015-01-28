<?php
namespace Core;
use Libs\Helper;
class Controller
{
    /**
     * @var null Database Connection
     */
    public $db = null;

    /**
     * @var null Model
     */
    public $model = null;
    

    /**
     * Whenever a controller is created, open a database connection too and load "the model".
     */
    function __construct()
    {
        $this->openDatabaseConnection();
        //$this->loadModel();
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
     * Loads the "model".
     * @return object model
     */
    public function loadBLL($bll = "")
    {
        if(empty($bll)) $bll = Helper::getController();
        
        $urlfinal = APP . 'BLL' . DIRECTORY_SEPARATOR . PASTA . $bll . 'BLL.php';


        if(file_exists($urlfinal))
            require_once $urlfinal;
        else {
            $urlfinal = APP . 'BLL' . DIRECTORY_SEPARATOR . 'Generic' . DIRECTORY_SEPARATOR . $bll . 'BLL.php';

            if(file_exists($urlfinal))
                require_once $urlfinal;
            else
                require_once APP . '/BLL/' . $bll . 'BLL.php';
        }

        
        // create new "model" (and pass the database connection)
        $this->model = "BLL\\".$bll."BLL";
        $this->model = new $this->model($this->db);
    }
    
    public function View($view = "", $controller = "", $header = "", $footer=""){
        $this->ModelView(null, $view, $controller, $header, $footer);
    }
    
    public function ModelView($Model = "", $view = "", $controller = "", $header = "", $footer = ""){
        if(empty($view)) $view = Helper::getAction();
        if(empty($header))  $header = "header";
        if(empty($footer))  $footer = "footer";
        if(empty($controller)) $controller = Helper::getController();
        // load views
		
        require APP . 'views/_templates/' . $header . '.php';
		
		
        /*if(empty($controller))
            require APP . 'views/' . $view . '.php';
        else
            require APP . 'views/' . $controller . '/' . $view . '.php';
        */
        Helper::LoadModelView($Model, $view, $controller);
        
		
        require APP . 'views/_templates/' . $footer . '.php';
    }
    
    public function Redirect($view, $controller = ""){
        if(empty($controller)) $controller = Helper::getController();

            header('location: ' . URL . $controller . '/' . $view . '');
    }
    
    public function Autenticar(){
        
    }
}
