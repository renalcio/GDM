<?php
/**
 * Created by PhpStorm.
 * User: renalcio.freitas
 * Date: 13/02/2015
 * Time: 14:53
 */

namespace BLL;


use Libs\Database;
use Libs\UnitofWork;

class BLL {
    public $pdo;
    public $unitofwork;


    public function __construct(){
        $this->pdo = new Database();
        $this->unitofwork = new UnitofWork();
    }
}