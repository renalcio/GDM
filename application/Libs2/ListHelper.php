<?php

namespace Libs;


class ListHelper {
    private $list;
    private $type;

    public function __construct(Array $Array = Array()){
        if(count($Array) > 0){
            if(is_object($Array[0])){
                $this->type = get_class($Array[0]);
            }
        }
        $this->list = $Array;
    }

    public function Add($Item){
        if(!empty($this->type)){
            if(get_class($Item) == $this->type)
                $this->list[] = $Item;
            else
                throw new \Exception("O objeto deve pertencer a a classe ".$this->type);
        } else {
            $this->type = get_class($Item);
            $this->list[] = $Item;
        }
    }

    public function RemoveAt($Index){
        unset($this->list[$Index]);
        $this->list = array_values($this->list);
    }

    public function Remove($Item){

        foreach($this->list as $key=>$value){
            if($value == $Item)
                unset($this->list[$key]);
        }

        $this->list = array_values($this->list);
    }

    public function Count(){
        return count($this->list);
    }

    public function ToList(){
        return $this->list;
    }

    public function First(){
        if($this->Count() > 0)
            return $this->list[0];

        return null;
    }

    public function Where($where){
        $array = $this->list;
        $retorno = Array();
        foreach($array as $key => $element){
            if($where($element))
                $retorno[] = $this->list[$key];
        }

        return $retorno;
    }

    public function For_Each($for){
        $lista = $this->list;
        foreach($lista as $key => $element)
            $for($element,$key);
        return $this;
    }

}