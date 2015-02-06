<?php
/**
 * Created by PhpStorm.
 * User: renalcio.freitas
 * Date: 06/02/2015
 * Time: 12:22
 */

namespace Libs;


class UnitofWork {

    var $pdo;
    var $banco;
    var $tabela;
    var $retorno;
    var $pk;
    var $objeto;
    private $classe;


    public function Get($objeto, $where = ""){
        $this->Initialize($objeto);

        $from = $this->banco.".".$this->tabela;

        if(!empty($where)){
            $comparacoes = "";

            if(!is_array($where) && !is_object($where)){
                $comparacoes = $where;
            }else{
                if(is_object($where))
                    $where = (Array)$where;
                foreach($where as $k=>$v){
                    $comparacoes .= $k." = ".$v;
                }
            }

            if(!empty($comparacoes))
                $where = " WHERE ".$comparacoes;
            else
                $where = "";
        }

        $sql = $this->pdo->select("SELECT * FROM ". $from . $where, $this->classe, true);

        $retorno = new ArrayHelper($sql);

        return $retorno;
    }

    public function GetById($objeto, $id){
        $this->Initialize($objeto);

    }

    public  function Update($objeto){
        $this->Initialize($objeto);

    }

    public function Insert($objeto){
        $this->Initialize($objeto);

    }

    private function Initialize($objeto){
        //Se nao for objeto instacia
        if (is_object($objeto))
            $this->objeto = $objeto;
        else
            $this->objeto = new $objeto();

        //Define classe do objeto
        $this->classe = get_class($this->objeto);

        $this->GetBase();
        $this->GetTable();
        $this->GetPK();

        $this->pdo = new Database();
    }

    private function GetPK(){

    }

    private function GetTable()
    {
        if(!empty($this->objeto)) {

            $xplode = explode("\\", $this->classe);
            $retorno = (isset($xplode[2])) ? $xplode[2] : (isset($xplode[1]) ? $xplode[1] : $xplode[0]);

            if($retorno != "stdClass")
                $this->tabela = $retorno;
            else
                throw new \Exception("stdClass não é permitido");

        }else
            throw new \Exception("Objeto ou classe inválida em GetTable");
    }

    private  function GetBase()
    {
        if(!empty($this->objeto)) {

            $xplode = explode("\\", $this->classe);
            $retorno =  (!isset($xplode[2])) ? ROOTDB : (isset($xplode[1]) ? $xplode[1] : $xplode[0]);

            if($retorno != "stdClass")
                $this->banco = $retorno;
            else
                throw new \Exception("stdClass não é permitido");
        }else
            throw new \Exception("Objeto ou classe inválida em GetTable");
    }

}