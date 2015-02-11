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

    private $query;
    private $results;

    private $groupby; /* TODO */

    public function __construct(){
        $this->pdo = new Database();
        $this->lista = new ArrayHelper();
        $this->results  = new ArrayHelper();
    }

    /**
     * Busca resultados de um determinada classe no MySQL
     * @param mixed $objeto   Objeto com a classe que deseja trabalhar
     * @param string $where   Where no formato MYSQL ou Array (Array sempre será AND)
     * @return UnitofWork
     */
    public function Get($objeto, $where = ""){
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
                $this->where = " WHERE ".$comparacoes;
            else
                $this->where = null;
        }

        //echo "SELECT * FROM ". $this->from . $where;
        return $this;
    }

    public function Select($select){
        $this->select = $select;
        return $this;
    }

    public function Join($objeto, $where){
        /**
         * TODO
         */

    }

    public function Where($where){
        $this->where = $where;
        return $this;
    }

    public function First(){
        $this->take = 1;
        $this->ExecuteQuery();
        $retorno = new ArrayHelper($this->results);
        return $retorno->First();
    }

    public function FirstOrDefault(){
        return $this->First();
    }

    public function ToList(){
        $this->ExecuteQuery();
        return new ArrayHelper($this->results);
    }

    public function ToArray(){
        $this->ExecuteQuery();
        return $this->results;
    }

    public function OrderBy($order){
        $orders = explode(",", $order);

        foreach($orders as $ord) {
            if (empty($this->orderby))
                $this->orderby = " ORDER BY " .$ord;
            else
                $this->orderby .= ", " .$ord;
        }

        return $this;
    }

    public function OrderByDescending($order){
        $orders = explode(",", $order);

        foreach($orders as $ord) {
            if (empty($this->orderby))
                $this->orderby = " ORDER BY " .$ord. " DESC";
            else
                $this->orderby .= ", " .$ord. " DESC";
        }

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

    private function ExecuteQuery(){

        if(empty($this->take) && !empty($this->skip))
            $this->take = "18446744073709551615"; //Pula x e pega TODOS

        if(!empty($this->take) && !empty($this->skip))
            $this->limit = " LIMIT ". $this->skip .",". $this->take;
        else if(!empty($this->take) && empty($this->skip))
            $this->limit = " LIMIT ". $this->take;


        $this->query = "SELECT " .$this->select. " FROM " .$this->from . $this->where . $this->orderby . $this->limit;
        //echo $this->query;
        $this->results = $this->pdo->select($this->query, ($this->select == "*" ? $this->classe : ""), true);

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

        $this->lista->For_Each(function($key,$item) {
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

        $this->lista->For_Each(function($key,$item){
            $pk = $this->pk;
            $this->objeto->$pk = $this->pdo->Insert($this->from, $item);
            $this->lista[$key]->$pk = $this->objeto->$pk;
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
            $this->classe = get_class($this->lista->First());

            $this->objeto = $this->lista->First();
        }else{
            //Se nao for objeto instacia
            if (is_object($objeto))
                $this->objeto = $objeto;
            else
                $this->objeto = new $objeto();

            $this->lista->Add($this->objeto);
            $this->classe = get_class($this->objeto);
        }

        $this->GetBase();
        $this->GetTable();
        $this->GetPK();

        $this->from = $this->banco . "." . $this->tabela;

        $this->pdo = new Database();
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

}