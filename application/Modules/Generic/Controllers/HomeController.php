<?php

/**
 * Class Home
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
namespace Modules\Generic\Controllers;
use Core\Controller;

/**
 * Class HomeController
 * @package Modules\Generic\Controllers
 * @Title: Início
 */
class HomeController extends Controller
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


    public function index_post($model = null){
        var_dump($model);
    }

    /**
     * @Public
     * @Generic
     */
    public function generator()
    {
        // load views
        $this->View("generator");
    }

    public function generator_post($model = null)
    {
        //var_dump($model);
        // load views
        $this->loadBLL();
        //echo $model['AplicacaoId'];
        $model = $this->bll->Generator($model['AplicacaoId']);
        $this->View("generator");
        //var_dump($model);
    }
}
