<?php
namespace Controllers;
use Core\Controller;
class Menu extends Controller
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
    
    public function cadastro()
    {
            $menu = new \stdClass;
            //Editar
            $this->loadModel();
            $menu->ListMenu = $this->model->GetMenu();
            //print_r($menu);
            
            $this->ModelView($menu, "cadastro");
    }
    
    public function salvar()
    {
        extract($_POST);
        if(isset($menu))
        {
            $menu = json_decode($menu);
            //print_r($menu);
            
            $this->loadModel();
            
            $this->model->LimpaMenu();
            
            $this->model->Save((Array)$menu);
            
        }
    }
    public function excluir()
    {
        
    }
}