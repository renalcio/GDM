<?php
namespace Modules\Generic\Controllers;
use Core\Controller;

/**
 * Class SiteMenuController
 * @package Modules\Generic\Controllers
 * @Title: SiteMenu
 */
class SiteMenuController extends Controller
{
    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/home/index (which is the default page btw)
     * @Title: Listagem
     */
    public function index()
    {
        // load views
        $model = new \stdClass();
        $this->loadBLL("Aplicacao");
        $model = $this->bll->GetToIndex($model);

        $this->ModelView($model);
    }

    /**
     * @param int $App
     * @Title: Cadastro
     */
    public function cadastro($App = 0)
    {
        $this->AddAsset(["jquery.nestable"]);
        if($App == 0) $App = APP_ID;
            $SiteMenu = new \stdClass;
            //Editar
            $this->loadBLL();
            $SiteMenu->ListSiteMenu = $this->bll->GetSiteMenu(0, $App);
            $SiteMenu->AppId = $App;
            //print_r($SiteMenu);
            
            $this->ModelView($SiteMenu, "cadastro");
    }
    
    public function salvar($App = 0)
    {
        if($App == 0) $App = APP_ID;
        extract($_POST);
        if(isset($SiteMenu))
        {
            $SiteMenu = json_decode($SiteMenu);
            //print_r($SiteMenu);
            
            $this->loadBLL();
            
            //$this->model->LimpaSiteMenu($App);
            
            $this->bll->Save((Array)$SiteMenu, 0, $App);
            
        }
    }

    public function excluir()
    {
        
    }
}