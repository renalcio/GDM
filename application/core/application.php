<?php
namespace Core;
use Controllers\Error;
use Libs\Session;
use Libs\Helper;
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
    /**
     * "Start" the application:
     * Analyze the URL elements and calls the according controller/method or the fallback
     */
    public function __construct()
    {

        // create array with URL parts in $url
        $this->splitUrl();

        $path = APP . 'controllers/' . $this->url_controller . '.php';

        // check for controller: no controller given ? then load start-page
        if (!$this->url_controller) {

            //require_once APP . 'controllers/home.php';

            $session = new Session("GDMAuth");
            if($session->Verifica("UsuarioId") == true && $session->Ver("UsuarioId") > 0 && defined('APP_ID')){
                $page = new \Controllers\Home();
                $page->index();
            }else{
                $page = new \Controllers\Login();
                $page->index();
            }

        } elseif (file_exists($path)) {
            //echo APP_ID;
            //print_r($_SESSION);if(defined('VAR_NAME')){
            $session = new Session("GDMAuth");
            //echo $session->Ver("AplicacaoId");
            if(($session->Verifica("UsuarioId") == true && $session->Ver("UsuarioId") > 0 && defined('APP_ID')) || $this->url_controller == "login")
            {
                // here we did check for controller: does such a controller exist ?

                // if so, then load this file and create this controller
                // example: if controller would be "car", then this line would translate into: $this->car = new car();
                //require_once APP . 'controllers/' . $this->url_controller . '.php';


                $this->url_controller = "\\Controllers\\".$this->url_controller;

                $this->url_controller = new $this->url_controller();

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
                        call_user_func_array(array($this->url_controller, $this->url_action), $this->url_params);
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
                        $page = new Error();
                        $page->index();
                    }
                }
            }
            else
            {
                $page = new \Controllers\Login();
                $page->index();
            }

        } else {
            $page = new \Controllers\Error();
            $page->index();
        }
    }

    /**
     * Get and split the URL
     */
    private function splitUrl()
    {
        if (isset($_GET['url'])) {

            // split URL
            $url = trim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);

            // Put URL parts into according properties
            // By the way, the syntax here is just a short form of if/else, called "Ternary Operators"
            // @see http://davidwalsh.name/php-shorthand-if-else-ternary-operators
            if(isset($url[0]) && $url[0] == "handler"){
                $this->url_controller = isset($url[1])  ? $url[0]."\\".$url[1] : $url[0];
                $this->url_action = isset($url[2]) ? $url[2] : null;
                $this->url_postAction = isset($url[2]) ? $url[2]."_post" : null;

                // Remove controller and action from the split URL
                unset($url[0], $url[1], $url[2]);

            }else{
                $this->url_controller = isset($url[0]) ? $url[0] : null;
                $this->url_action = isset($url[1]) ? $url[1] : null;
                $this->url_postAction = isset($url[1]) ? $url[1]."_post" : null;

                // Remove controller and action from the split URL
                unset($url[0], $url[1]);
            }




            // Rebase array keys and store the URL params
            $this->url_params = array_values($url);

            // for debugging. uncomment this if you have problems with the URL
            //echo 'Controller: ' . $this->url_controller . '<br>';
            //echo 'Action: ' . $this->url_action . '<br>';
            //echo 'Parameters: ' . print_r($this->url_params, true) . '<br>';
        }
    }
}
