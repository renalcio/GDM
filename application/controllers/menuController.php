<?php
namespace Controllers;
use Core\Controller;
class MenuController extends Controller
{
    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/home/index (which is the default page btw)
     */
    public function index()
    {
        // load views
        $this->View("index");
    }
    
    public function cadastro($App = 0)
    {
        if($App == 0) $App = APP_ID;
            $menu = new \stdClass;
            //Editar
            $this->loadModel();
            $menu->ListMenu = $this->model->GetMenu();
            $menu->AppId = $App;
            //print_r($menu);
            
            $this->ModelView($menu, "cadastro");
    }
    
    public function salvar($App = 0)
    {
        if($App == 0) $App = APP_ID;
        extract($_POST);
        if(isset($menu))
        {
            $menu = json_decode($menu);
            //print_r($menu);
            
            $this->loadModel();
            
            $this->model->LimpaMenu();
            
            $this->model->Save((Array)$menu, 0, $App);
            
        }
    }

    public function Listagem()
    {
        $model = new \stdClass();
        $this->loadModel("apps");
        $model->ListApps = $this->model->getApps();

        $this->ModelView($model);
    }

    public function excluir()
    {
        
    }
}