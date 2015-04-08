<?php
/**
 * Controller
 *
 * Titulo: Destaques do Site
 * Autor: renalcio.freitas
 * Data: 30/01/2015
 *
 */
namespace Modules\MediaSpot\Controllers;
use Core\Controller;
use DAL\MediaSpot\SiteDestaque;
use Libs\ArrayHelper;
use Libs\Database;
use Libs\Helper;
use Libs\ModelState;

class SiteDestaqueController extends Controller
{

    public function index()
    {
        $this->AddAsset(["jquery.nestable"]);
        $this->loadBLL();
        $Model = new \stdClass();
        $Model = $this->bll->GetToIndex($Model);
        $this->ModelView($Model);
    }

    public function salvar()
    {

        extract($_POST);
        if(isset($destaques))
        {
            $destaques = json_decode($destaques);
            //print_r($menu);

            $this->loadBLL();

            //Passa destaque a destaque atualizando
            $i = 0;
            $Destaques = new ArrayHelper((Array)$destaques);

            $Destaques->For_Each(function($destaque, $i){
                $itemAdd = new SiteDestaque();
                $itemAdd->ReferenciaId = $destaque->referenciaid;
                $itemAdd->SiteDestaqueId = $destaque->sitedestaqueid;
                $itemAdd->Posicao = $i+1;
                $this->bll->Save($itemAdd);
            });


        }
    }

    public function cadastro($id = 0)
    {
        // load views
        $this->loadBLL();
        $Model = new SiteDestaque();
        $Model->SiteDestaqueId = $id;
        $Model = $this->bll->GetToEdit($Model);
        $this->ModelView($Model);

    }

    public function cadastro_post($model = null)
    {

        if ($model != null) {
            $model = (object)$model;
            Helper::cast($model, new SiteDestaque());
            // select
            $this->loadBLL();


            $this->bll->Save($model); // Salva
            $this->Redirect("Index"); // Redireciona pra index do controller


           $this->ModelView($model);
        }
    }

        public function deletar($id){
            if($id > 0){
                $this->loadBLL();
                $this->bll->Deletar($id);
            }

            $this->Redirect("Index");
        }
    }