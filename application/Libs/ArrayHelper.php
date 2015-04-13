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
            $for($element,$key);
        return $this;
    }

    public function Join(Array $add){
        $this->array = $this->array + $add;
    }

    public function Merge(Array $array){
        $this->array = array_merge($this->array, $array);
    }

    public function Skip($x){
        $arr = Array();
        for($i = $x; $i <= count($this->array); $i++){
            $id = ($i -1);
            $arr[] = $this->array[$id];
        }

        $retorno = clone $this;
        $retorno->array = $arr;
        return $retorno;
    }

    public function Take($x){
        $arr = Array();
        for ($i = 0; $i < count($this->array) && $i < $x; $i++) {
            $arr[] = $this->array[$i];
        }

        $retorno = clone $this;
        $retorno->array = $arr;
        return $retorno;
    }
}