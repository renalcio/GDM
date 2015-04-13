<?php
/**
 * User: gabriel.malaquias
 * Date: 10/12/2014
 * Time: 15:06
 */

namespace Libs;

use Libs\Annotation\Annotation;

class ModelState {

    public static $errors = array();


    public static function addError($erro, $campo, $DisplayName = ""){
        $addErro = new \stdClass();
        $addErro->Campo = $campo;
        $addErro->DisplayName = !empty($DisplayName) ? $DisplayName : $campo;
        $addErro->Mensagem = $erro;

        array_push(self::$errors, $addErro);
    }

    public static function getErrors(){
        return self::$errors;
    }

    public static function isValid(){
        if(count(self::$errors) == 0)
            return true;

        return false;
    }

    public static function clear(){
        self::$errors = array();
    }

    public static function RemoveNotMapped($model){
        $annotation = new Annotation($model);
        $get = $annotation->getAnnotations();

        foreach ($get as $campo=>$data):
            if (array_key_exists("NotMapped", $data))
                unset($model->$campo);
        endforeach;
    }

    public static function CheckAnnotation($model, $ann){
        $annotation = new Annotation($model);
        $get = $annotation->getAnnotations(true);

        $retorno = Array();
        //var_dump($get);
        //var_dump($ann);
        foreach ($get as $campo=>$data):
            if (array_key_exists($ann, $data))
                $retorno[] = $campo;
        endforeach;

        return $retorno;
    }

    public static function isPublicMethod($model, $metodo){
        $annotation = new Annotation($model);
        $get = $annotation->getAnnotations(true);

        $retorno = Array();
        //var_dump($get);
        //var_dump($ann);
        foreach ($get as $campo=>$data):
            if (array_key_exists("Public", $data))
                $retorno[] = strtolower($campo);
        endforeach;

        return in_array(strtolower($metodo), $retorno);
    }

    public static function GetMethodTitle($model, $metodo){
        $annotation = new Annotation($model);
        $get = $annotation->getAnnotations(true);

        $retorno = Array();
        //var_dump($metodo);
        //var_dump($get['index']);
        if(isset($get[$metodo])) {
            //var_dump($get[$metodo]);
            if (array_key_exists("Title", $get[$metodo]))
                return $get[$metodo]["Title"];
            else if (array_key_exists("DisplayName", $get[$metodo]))
                return $get[$metodo]["DisplayName"];
            else
                return "";
        }else if(isset($get[strtolower($metodo)])){
            $metodo = strtolower($metodo);
            //var_dump($get[$metodo]);
            if (array_key_exists("Title", $get[$metodo]))
                return $get[$metodo]["Title"];
            else if (array_key_exists("DisplayName", $get[$metodo]))
                return $get[$metodo]["DisplayName"];
            else
                return "";
        }
        else
            return "";
    }

    public static function GetClassTitle($model){
        $annotation = new Annotation($model);
        $get = $annotation->getAnnotations(true);

        $retorno = Array();
        //var_dump($annotation);
        //var_dump($ann);
        if (array_key_exists("Title", $get["classe"]))
            return $get["classe"]["Title"];
        else if (array_key_exists("DisplayName", $get["classe"]))
            return $get["classe"]["DisplayName"];
        else
            return "";
    }

    public static function isGenericMethod($model, $metodo){
        $annotation = new Annotation($model);
        $get = $annotation->getAnnotations(true);

        $retorno = Array();
        //var_dump($get);
        //var_dump($ann);
        foreach ($get as $campo=>$data):
            if (array_key_exists("Generic", $data))
                $retorno[] = strtolower($campo);
        endforeach;

        return in_array(strtolower($metodo), $retorno);
    }

    public static function GetPrimaryKey($model){
        $annotation = new Annotation($model);
        $get = $annotation->getAnnotations();

        foreach ($get as $campo=>$data):
            if (array_key_exists("PrimaryKey", $data))
                return $campo;
        endforeach;
    }

    public static function MSInt($model){
        $annotation = new Annotation($model);
        $get = $annotation->getAnnotations();

        foreach ($get as $campo=>$data):
            if (array_key_exists("Int", $data)){
                $pattern = "/[^0-9]/mi";
                $model->$campo = preg_replace($pattern, '', $model->$campo);

            }
        endforeach;
    }

    public static function Required($model){
        $annotation = new Annotation($model);
        $get = $annotation->getAnnotations();

        foreach ($get as $campo=>$data):
            if (array_key_exists("Required", $data)){
                if(empty($model->$campo)) {

                    self::addError($annotation->getName($campo) . " é obrigatório", $campo, $annotation->getName($campo));
                }

            }
        endforeach;
    }

    public static function DisplayName($model, $campo){
        $annotation = new Annotation($model);
        $get = $annotation->getAnnotations();


        if(property_exists($model, $campo)){
            if(array_key_exists("DisplayName", $get[$campo]))
                return $get[$campo]["DisplayName"];

            return $campo;
        }

    }

    public static function ValidateModel($model){
        self::Required($model);
    }

    public static function TratamentoDB($model){
        self::MSInt($model);
        self::RemoveNotMapped($model);
    }

} 