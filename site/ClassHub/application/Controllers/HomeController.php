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
     * @Public
     */
    public function index()
    {
        // load views
        $this->View("index");
    }


    public function index_post($model = null){
        var_dump($model);
    }
}
