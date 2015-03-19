<?php
namespace Core;
use Controllers\Error;
use Controllers\LoginController;
use DAL\Action;
use DAL\ActionModulo;
use DAL\Modulo;
use Libs\SessionHelper;
use Libs\Helper;
use Libs\UnitofWork;

class Application
{
    /** @var null The controller */
    private $url_controller = null;

    /** @var null The method (of the above controller), often also named "action" */
    private $url_action = null;

    /** @var null The post action for actual action */
    private $url_postAction = null;

    /** @var array URL parameters */
    private $url_params = array();

    private $Modulo = null;

    private $Action = null;

    private $ActionModulo = null;

    /**
     * "Start" the application:
     * Analyze the URL elements and calls the according controller/method or the fallback
     */
    public function __construct()
    {
        // create array with URL parts in $url
        $this->splitUrl();

        // check for controller: no controller given ? then load start-page

        //Verifica se tem pasta personalizada
        $urlController = APP . 'Modules' . DIRECTORY_SEPARATOR . PASTA . 'Controllers' . DIRECTORY_SEPARATOR . $this->url_controller . '.php';

        //echo $urlController;
        if(!file_exists($urlController)){
            //Verifica se tem pasta generica
            $urlController = APP . 'Modules' . DIRECTORY_SEPARATOR . 'Generic' . DIRECTORY_SEPARATOR . 'Controllers' . DIRECTORY_SEPARATOR . $this->url_controller . '.php';

            if(!file_exists($urlController)){
                //Verifica se tem na pasta do sistema
                $urlController = APP . 'Controllers' . DIRECTORY_SEPARATOR . $this->url_controller . '.php';
            }
        }




        if (empty($this->url_controller)) {

            //require_once APP . 'controllers/home.php';

            $session = new SessionHelper("GDMAuth");
            if($session->Verifica("UsuarioId") == true && $session->Ver("UsuarioId") > 0 && defined('APP_ID')){
                if(APPID > 0) {
                    $page = new \Controllers\HomeController();
                    $page->index();
                }else{
                    $page = new \Controllers\LoginController();
                    $page->SelecionaAplicacao();
                }
            }else{
                $page = new \Controllers\LoginController();
                $page->index();
            }

        } elseif (file_exists($urlController) && $this->ActionModulo->ActionModuloId > 0) {
            require_once $urlController;
            //echo APP_ID;
            //print_r($_SESSION);if(defined('VAR_NAME')){
            $session = new SessionHelper("GDMAuth");
            //echo $session->Ver("AplicacaoId");
            if(($session->Verifica("UsuarioId") == true && $session->Ver("UsuarioId") > 0 && defined('APP_ID')) ||
                $this->ActionModulo->Publico == 1)
            {

                // here we did check for controller: does such a controller exist ?

                // if so, then load this file and create this controller
                // example: if controller would be "car", then this line would translate into: $this->car = new car();
                //require_once APP . 'controllers/' . $this->url_controller . '.php';
                if((defined('APP_ID') && APP_ID > 0) || $this->ActionModulo->Publico == 1) {
                    $this->url_controller = "\\Controllers\\" . str_replace("/","\\", $this->url_controller);
                    //echo "Controller: ".$this->url_controller. " URl: ".$urlController;
                    $this->url_controller = new $this->url_controller();
                }else if(defined('APP_ID') && APP_ID <= 0){
                    $page = new LoginController();
                    $page->SelecionaAplicacao();
                }

                // check for method: does such a method exist in the controller ?

                //Verifica se exite post
                if(isset($_POST) && count($_POST) > 0){

                    $Model = Helper::CastPost();

                    //Verifica se o metodo de post existe
                    if(method_exists($this->url_controller, $this->url_postAction)) {
                        $this->url_params = array_merge(array("model" => $Model),$this->url_params);
                        call_user_func_array(array($this->url_controller, $this->url_postAction), $this->url_params);
                    }else{
                        $this->url_params["model"] = $Model;
                        //var_dump($this->url_postAction);
                        call_user_func_array(array($this->url_controller, $this->url_action),
                            $this->url_params);
                    }

                }else if (method_exists($this->url_controller, $this->url_action)) {

                    if(!empty($this->url_params)) {
                        // Call the method and pass arguments to it
                        call_user_func_array(array($this->url_controller, $this->url_action), $this->url_params);
                    } else {
                        // If no parameters are given, just call the method without parameters, like $this->home->method();
                        $this->url_controller->{$this->url_action}();
                    }

                } else {
                    if(strlen($this->url_action) == 0) {
                        // no action defined: call the default index() method of a selected controller
                        $this->url_controller->index();
                    }
                    else {
                        // defined action not existent: show the error page
                        $page = new \Controllers\ErrorController();
                        $page->index();
                    }
                }
            }
            else
            {
                $page = new \Controllers\LoginController();
                $page->index();
            }

        } else {
            $page = new \Controllers\ErrorController();
            $page->index();
        }
    }

    /**
     * Get and split the URL
     */
    private function splitUrl()
    {
        $unitofwork = new UnitofWork();
        if (isset($_GET['url'])) {

            // split URL
            $url = trim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);

            $this->Modulo = new Modulo();
            $this->Action = new Action();
            $this->ActionModulo = new ActionModulo();

            if(isset($url[0]) && $url[0] == "handler"){
                $this->url_controller = isset($url[1])  ? ucfirst($url[0])."s".DIRECTORY_SEPARATOR.ucfirst($url[1])."Handler" : ucfirst($url[0]);
                $this->url_action = isset($url[2]) ? $url[2] : "index";
                $this->url_postAction = isset($url[2]) ? $url[2]."_post" : "index_post";


                $this->Modulo = $unitofwork->Get(new Modulo(), "LOWER(Titulo) = '".strtolower($url[1])."'")->FirstOrDefault();

                // Remove controller and action from the split URL
                unset($url[0], $url[1], $url[2]);



            }else{

                $this->url_controller = isset($url[0]) ? ucfirst($url[0])."Controller" : null;
                $this->url_action = isset($url[1]) ? $url[1] : "index";
                $this->url_postAction = isset($url[1]) ? $url[1]."_post" : "index_post";

                $this->Modulo = $unitofwork->Get(new Modulo(), "LOWER(Titulo) = '".strtolower($url[0])."'")
                    ->FirstOrDefault();

                // Remove controller and action from the split URL
                unset($url[0], $url[1]);
            }

            if($this->Modulo->ModuloId > 0)
                $this->Action = $unitofwork->Get(new Action(), "LOWER(Titulo) = '".strtolower($this->url_action)."'")
                    ->Join($unitofwork->Get(new ActionModulo()), "a.ActionId", "am.ActionId")->Where("am.ModuloId =
                    '".$this->Modulo->ModuloId."'")->Select("a", new Action())->FirstOrDefault();

            if($this->Modulo->ModuloId > 0 && $this->Action->ActionId > 0)
                $this->ActionModulo = $unitofwork->Get(new ActionModulo(), "ActionId = '".$this->Action->ActionId."' AND ModuloId = '".$this->Modulo->ModuloId."'")->FirstOrDefault();




            // Rebase array keys and store the URL params
            $this->url_params = array_values($url);

            // for debugging. uncomment this if you have problems with the URL
            //echo 'Controller: ' . $this->url_controller . '<br>';
            //echo 'Action: ' . $this->url_action . '<br>';
            //echo 'Parameters: ' . print_r($this->url_params, true) . '<br>';
        }
        //var_dump($this);
    }
}
