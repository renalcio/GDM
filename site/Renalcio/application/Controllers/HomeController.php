<?php

/**
 * Class Home
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
namespace Controllers;
use Core\Controller;
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

    public function generator()
    {
        // load views
        $this->View("generator");
    }

    public function generator_post($model = null)
    {
        // load views
        $this->View("generator");
        $this->loadBLL();
        //echo $model['AplicacaoId'];
        $model = $this->bll->Generator($model['AplicacaoId']);
        var_dump($model);
    }
}
