<?php
/**
 * Created by PhpStorm.
 * User: renalcio.freitas
 * Date: 06/02/2015
 * Time: 12:22
 */

namespace Libs;

/**
 * Class UnitofWork
 * @package Libs
 * @author  Renalcio Carlos
 * @date    11/02/2015
 */
class UnitofWork {

    var $pdo;
    var $banco;
    var $tabela;
    var $retorno;
    var $pk;
    var $objeto;
    var $lista;
    private $classe;

    private $select = "*";
    private $from;
    private $where = null;

    private $orderby = null;

    private $limit = null;
    private $skip = null;
    private $take = null;

    public $query;
    private $results;

    private $join;

    private $bolJoin;

    private $as;


    private $groupby; /* TODO */

    public function __construct(){
        $this->pdo = new Database();
        $this->lista = new ArrayHelper();
        $this->results  = new ArrayHelper();
        $this->bolJoin = false;
        return $this;
    }

    /**
     * Busca resultados de um determinada classe no MySQL
     * @param mixed $objeto   Objeto com a classe que deseja trabalhar
     * @param string $where   Where no formato MYSQL ou Array (Array sempre será AND)
     * @return UnitofWork
     */
    public function Get($objeto, $where = ""){
        $this->Clear();
        $this->Initialize($objeto);
        if(!empty($where)){
            $comparacoes = "";

            if(!is_array($where) && !is_object($where)){
                $comparacoes = " ".$where;
            }else{
                if(is_object($where))
                    $where = (Array)$where;
                $z = 0;
                foreach($where as $k=>$v){
                    if($z > 0)
                        $comparacoes .= " AND";

                    $comparacoes .= " ".$k." = ".$v;

                }
            }

            if(!empty($comparacoes))
                $this->Where($comparacoes);
            else
                $this->where = "";
        }

        //echo "SELECT * FROM ". $this->from . $where;


        return clone $this;
    }

    public function Select($select, $objeto = "\\stdClass"){

        $this->GetClass($objeto);

        $nSelect = "";
        $xVirgula = explode(",", $select);
        if(count($xVirgula) > 0){
            for($i = 0; $i < count($xVirgula); $i++){
                $xPoint = explode(".", $xVirgula[$i]);
                if(count($xPoint) <= 1){
                    $xVirgula[$i] .= ".*";
                }

                $nSelect .= " ".$xVirgula[$i] . ($i < (count($xVirgula) - 1) ? "," : "");
            }
        }

        $this->select = $nSelect;

        //$this->BuildQuery();
        //echo $this->query;

        return clone $this;
    }

    public function Join(UnitofWork $join, $refPai, $refItem){

        $this->SetJoin($join, $refPai, $refItem);

        $strJoin = " JOIN ".$join->from." AS ".$join->as." ON ".$refItem." = ".$refPai;

        $this->join .= $strJoin;

        $this->where = $join->where;

        //echo "<br>This Where: ".$this->where;
        //echo "<br>Join Where: ".$join->where;


        //echo  $this->join."<br>";

        //$this->BuildQuery();

        //echo $this->query;

        return clone $this;
    }

    public function LeftJoin(UnitofWork $join, $refPai, $refItem){

        $this->SetJoin($join, $refPai, $refItem);

        $strJoin = " LEFT JOIN ".$join->from." AS ".$join->as." ON ".$refItem." = ".$refPai;

        $this->join .= $strJoin;

        $this->Where($join->where);

        return clone $this;
    }



    public function Where($where){
        if($where != null) {
            if (empty($this->where))
                $this->where = " (" . $where . ")";
            else
                $this->where .= " AND (" . $where . ")";
        }else{
            $this->where = "";
        }

        return $this;
    }

    public function First(){
        $obj = clone $this;
        $obj->take = 1;
        $obj->ExecuteQuery();
        $retorno = new ArrayHelper($obj->results);
        return $retorno->First();
    }

    public function FirstOrDefault(){
        return $this->First();
    }

    public function ToList(){
        $obj = clone $this;
        $obj->ExecuteQuery();
        return new ArrayHelper($obj->results);
    }

    public function ToArray(){
        $obj = clone $this;
        $obj->ExecuteQuery();
        return $obj->results;
    }

    public function OrderBy($order){
        if (empty($this->orderby))
            $this->orderby = " ORDER BY " .$order;
        else
            $this->orderby .= "," .$order;

        return $this;
    }

    public function OrderByDescending($order){

        if (empty($this->orderby))
            $this->orderby = " ORDER BY " .$order. " DESC";
        else
            $this->orderby .= "," .$order. " DESC";


        return $this;
    }

    public function Take($numero){
        $this->take = $numero;
        return $this;
    }

    public function Skip($numero){
        $this->skip = $numero;
        return $this;
    }



    /** AUTOMATICAS */

    public function GetById($objeto, $id){
        $this->Initialize($objeto);

        $sql = $this->pdo->GetById($this->from, $this->pk, $id, $this->classe);

        return $sql;
    }

    public function Save(&$objeto){
        $this->Initialize($objeto);

        $this->lista->For_Each(function($key,$item){
            $pk = $this->pk;
            if (empty($item->$pk)) {
                $this->objeto->$pk = $this->pdo->Insert($this->from, $item);
                $this->lista[$key]->$pk = $this->objeto->$pk;
            }
            else
                $this->pdo->update($this->from, $item, $pk . " = " . $item->$pk);
        });

        if (is_object($objeto) && (get_class($objeto) == "ArrayHelper" || get_class($objeto) == "ListHelper"))
            $objeto = $this->lista;
        else
            $objeto =  $this->objeto;
    }

    public function Update(&$objeto){
        $this->Initialize($objeto);
       // print_r($this->lista);
        $this->lista->For_Each(function($item) {
            //print_r($item);
            if(is_object($item))
                $item = $this->ClearClass($item);
            //Verifica PK
            $pk = $this->pk;
            if (empty($item->$pk))
                throw new \Exception("Chave primária inválida");
            else {
                //Atualiza via PDO
                $this->pdo->update($this->from, $item, $pk . " = " . $item->$pk);
            }
        });

        if (is_object($objeto) && (get_class($objeto) == "ArrayHelper" || get_class($objeto) == "ListHelper"))
            $objeto = $this->lista;
        else
            $objeto = $this->objeto;
    }

    public function Insert(&$objeto){
        $this->Initialize($objeto);

        $this->lista->For_Each(function($item, $key){
            print_r($item);
            $item = $this->ClearClass($item);
            $pk = $this->pk;
            $this->objeto->$pk = $this->pdo->Insert($this->from, $item);
            $array = $this->lista->ToList();
            $array[$key]->$pk = $this->objeto->$pk;
            $this->lista = new ArrayHelper($array);
        });

        if (is_object($objeto) && (get_class($objeto) == "ArrayHelper" || get_class($objeto) == "ListHelper"))
            $objeto = $this->lista;
        else
            $objeto = $this->objeto;
    }

    /**
     * @param $objeto: Objeto a ser apagado ou tipo a levar em consideração
     * @param int $condicao: Id ou (Opcional)
     * @param int $limit: Limite de registros a ser apagado (Opcional)
     */
    public  function Delete($objeto, $condicao = 0, $limit = 0){
        $this->Initialize($objeto);

        if(empty($condicao)) { //Se esta vazio apaga pela PK do Objeto

            $this->lista->For_Each(function ($key, $item) {
                //Verifica PK
                $limit = 1;
                $pk = $this->pk;
                if (empty($item->$pk))
                    throw new \Exception("Chave primária inválida");
                else {
                    //Atualiza via PDO
                    $sql = $this->pdo->delete($this->from, $pk . " = " . $item->$pk, $limit);
                }
            });
        }else{
            if(is_numeric($condicao)) { //Se a condição é um numero ela é considerada o id da PK
                $limit = 1;
                $pk = $this->pk;
                $this->objeto->$pk = $condicao;
                $this->pdo->delete($this->from, $pk . " = " . $condicao, $limit);
            }else{
                //Considera a condição um WHERE
                $this->pdo->delete($this->from, $condicao, $limit);
            }
        }
    }

    private function Initialize($objeto){
        $this->lista = new ArrayHelper();
        //Verifica Se é Lista ou Array HELPER
        if (is_object($objeto) && (get_class($objeto) == "ArrayHelper" || get_class($objeto) == "ListHelper")){

            if(get_class($objeto) == "ArrayHelper")
                $this->lista = $objeto;
            else
                $objeto->For_Each(function($key,$item){
                    $this->lista->Add($item);
                });

            $this->objeto = $this->lista->First();
        }else{
            //Se nao for objeto instacia
            if (is_object($objeto))
                $this->objeto = $objeto;
            else
                $this->objeto = new $objeto();

            $this->lista->Add($this->objeto);

        }

        $this->GetClass($this->objeto);

        $this->GetBase();
        $this->GetTable();
        $this->GetPK();

        $this->from = $this->banco . "." . $this->tabela;

        $this->pdo = new Database();
    }

    /** GETS E SETS **/

    private function SetJoin(UnitofWork $join, $refPai, $refItem){
        if($this->bolJoin==false) {
            //Pai
            $xPai = explode(".", $refPai);
            $paiTabela = (isset($xPai[1]) ? $xPai[1] : $xPai[0]);
            $paiAs = (isset($xPai[1]) ? $xPai[0] : "");

            $this->SetAs($paiAs);
        }
        $this->bolJoin = true;

        //Item
        $xItem = explode(".", $refItem);
        $itemTabela = (isset($xItem[1]) ? $xItem[1] : $xItem[0]);
        $itemAs = (isset($xItem[1]) ? $xItem[0] : "");
        $join->SetAs($itemAs);
    }

    private function GetClass($objeto){
        if(is_object($objeto))
            $this->classe = get_class($objeto);
        else
            $this->classe = $objeto;
    }

    private function GetPK(){
        $this->pk = ModelState::GetPrimaryKey($this->objeto);
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

            if($retorno != "stdClass") {
                $this->banco = DB_PREFIX . $retorno;
                //echo  $this->banco;
            }
            else
                throw new \Exception("stdClass não é permitido");
        }else
            throw new \Exception("Objeto ou classe inválida em GetTable");
    }

    public function SetAs($as){
        $this->as = $as;
        //$this->from .= " AS ".$as;

        return $this;
    }

    /** FINAL **/

    private function ExecuteQuery(){

        $this->BuildQuery();

        $this->results = $this->pdo->select($this->query, $this->classe, true);

    }

    public function BuildQuery(){
        if(empty($this->take) && !empty($this->skip))
            $this->take = "18446744073709551615"; //Pula x e pega TODOS

        if(!empty($this->take) && !empty($this->skip))
            $this->limit = " LIMIT ". $this->skip .",". $this->take;
        else if(!empty($this->take) && empty($this->skip))
            $this->limit = " LIMIT ". $this->take;



        $this->query = "SELECT " .$this->select. " FROM " .$this->from. (empty($this->as) ? "" : " AS ".$this->as).
            $this->join.
            (empty($this->where) ? "" : " WHERE". $this->where).
            $this->orderby.
            $this->limit;

        // echo $this->query;
    }

    public function ClearClass($objeto){
        $classe = get_class($objeto);
        $retorno = new $classe();
        foreach($objeto as $key=>$item){
            if(!property_exists($retorno, $key))
                unset($objeto->$key);
        }
        return $objeto;
    }

    public function Clear(){
        $this->banco = "";
        $this->tabela = "";
        $this->retorno = "";
        $this->pk = "";
        $this->objeto = "";
        $this->lista = "";
        $this->classe = "";
        $this->select = "*";
        $this->from;
        $this->orderby = null;
        $this->limit = null;
        $this->skip = null;
        $this->take = null;
        $this->query = "";
        $this->results = "";
        $this->join = "";
        $this->bolJoin = false;
        $this->as = "";
        $this->where = "";
    }

}