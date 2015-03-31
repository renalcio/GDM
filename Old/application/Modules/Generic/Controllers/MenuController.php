<?php
namespace Modules\Generic\Controllers;
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
        $model = new \stdClass();
        $this->loadBLL("Aplicacao");
        $model = $this->bll->GetToIndex($model);

        $this->ModelView($model);
    }
    
    public function cadastro($App = 0)
    {
        if($App == 0) $App = APP_ID;
            $menu = new \stdClass;
            //Editar
            $this->loadBLL();
            $menu->ListMenu = $this->bll->GetMenu(0, $App);
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
            
            $this->loadBLL();
            
            //$this->model->LimpaMenu($App);
            
            $this->bll->Save((Array)$menu, 0, $App);
            
        }
    }

    public function excluir()
    {
        
    }
}