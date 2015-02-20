<?php

class ArrayHelper
{
    public static function buscar($array, $key)
    {
        $results = array();

        if (is_array($array))
        {
            if (isset($array[$key]) && key($array) == $key)
            {
                $results[] = $array[$key];
            }

            foreach ($array as $sub_array)
            {
                $results = array_merge($results, ArrayHelper::buscar($sub_array, $key));
            }


        }

        return $results;

    }

    public static function primeiro_valor($array)
    {
        $retorno = "";
        if (is_array($array[0]))
        {
            $retorno = ArrayHelper::primeiro_valor($array[0]);
        } else
        {
            $retorno = $array[0];
        }

        return $retorno;

    }
    /**
     * Filtra itens unicos em um array a partir de uma chave
     * 
     * @uses Array::itens_unicos(array, mixed) Filtra itens unicos em um array através de uma chave
     * @param array $array Array a ser filtrado
     * @param mixed $key Chave de busca
     * @return array
     * 
     * */
    
    public static function itens_unicos(array $array, $key){
        
        foreach($array as $element){
            $hash = $element[$key];
            $retorno[$hash] = $element;
        }
        
        return $retorno;
    }
}

