<?php

namespace Libs;


class ArrayHelper {
    private $array;

    public function __construct($Array = Array()){
        if(count($Array) > 0) {
            $this->array = $Array;
        }else{
            $this->array = Array();
        }
    }

    public function Add($Item){
        $this->array[] = $Item;
    }

    public function RemoveAt($Index){
        unset($this->array[$Index]);
        $this->array = array_values($this->array);
    }

    public function Remove($Item){

        foreach($this->array as $key=>$value){
            if($value == $Item)
                unset($this->array[$key]);
        }

        $this->array = array_values($this->array);
    }

    public function Count(){
        return count($this->array);
    }

    public function ToList(){
        return $this->array;
    }

    public function First(){
        if($this->Count() > 0)
            return $this->array[0];

        return null;
    }

    public function Where($where){
        $array = $this->array;
        $retorno = new ArrayHelper();
        foreach($array as $key => $element){
            if($where($element))
                $retorno->Add($this->array[$key]);
        }

        return $retorno;
    }

    public function For_Each($for){
        $array = $this->array;
        foreach($array as $key => $element)
            $for($key,$element);
        return $this;
    }
}