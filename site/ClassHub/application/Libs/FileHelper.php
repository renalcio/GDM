<?php
/**
 * Created by PhpStorm.
 * User: TANDA
 * Date: 08/06/2015
 * Time: 12:57
 */

namespace Libs;


class FileHelper {

    static function MoveDir($path, $newPath, $ignoreList = array()){
        self::CopyDir($path, $newPath, $ignoreList, true);
    }

    static function CopyDir($path, $newPath, $ignoreList = array(), $clearOriginal = false){
        if(file_exists($path)){

            //Verifica pasta de destino
            if(!file_exists($newPath)){
                self::newDir($newPath);
            }

            //Atualiza permissões
            chmod($path, 0777);
            chmod($newPath, 0777);

            $cdir = scandir($path);

            //Le arquivo por arquivo e copia na nova pasta
            foreach ($cdir as $key => $value)
            {
                //Verifica se não é um arquivo "ignorado"
                if (!in_array($value,array(".","..")) && !in_array($value,$ignoreList))
                {
                    chmod($path . DIRECTORY_SEPARATOR . $value, 0777);
                    //Se for uma pasta chama a mesma função para ela
                    if (is_dir($path . DIRECTORY_SEPARATOR . $value))
                    {

                       self::CopyDir($path . DIRECTORY_SEPARATOR . $value, $newPath . DIRECTORY_SEPARATOR . $value,
                           $ignoreList, $clearOriginal);
                    }
                    else
                    {
                        $file = $path . DIRECTORY_SEPARATOR . $value;
                        $newFile = $newPath . DIRECTORY_SEPARATOR . $value;
                        copy($file, $newFile);
                        if($clearOriginal){
                            unlink($file);
                        }
                    }
                }
            }
            if($clearOriginal){
                rmdir($path);
            }

        }
    }

    static function NewDir($path){
        if(!file_exists($path)){
            mkdir($path, 0777, true);
        }
    }
    static function DirArray($dir, $ignoreList = array()) {

    $result = array();
        if(file_exists($dir)) {
            $cdir = scandir($dir);

            foreach ($cdir as $key => $value) {
                if (!in_array($value, array(".", "..")) && !in_array($value, $ignoreList)) {
                    if (is_dir($dir . DIRECTORY_SEPARATOR . $value)) {
                        $result[$value] = self::DirArray($dir . DIRECTORY_SEPARATOR . $value, $ignoreList);
                    } else {
                        $url = preg_replace("/(.*public\\\\)/mi", "", $dir);
                        $url = URL . $url . DIRECTORY_SEPARATOR . $value;
                        $url = preg_replace("/(\\\\)+/", "/", $url);
                        $result[] = $url;
                    }
                }
            }
        }
    return $result;

    }

    static function DirList($dir, $ignoreList = array()) {

        $result = array();
        if(file_exists($dir)) {
            $cdir = scandir($dir);

            //var_dump($ignoreList);

            foreach ($cdir as $key => $value) {
                if (!in_array($value, array(".", "..")) && !in_array($value, $ignoreList)) {
                    if (is_dir($dir . DIRECTORY_SEPARATOR . $value)) {
                        $result[$value] = self::DirList($dir . DIRECTORY_SEPARATOR . $value, $ignoreList);
                    } else {
                        $arrAdd = array();
                        $arrAdd["type"] = pathinfo($dir . DIRECTORY_SEPARATOR . $value, PATHINFO_EXTENSION);
                        $arrAdd["url"] = preg_replace("/(.*public\\\\)/mi", "", $dir);
                        $arrAdd["url"] = URL . $arrAdd["url"] . DIRECTORY_SEPARATOR . $value;
                        $arrAdd["url"] = preg_replace("/(\\\\)+/", "/", $arrAdd["url"]);
                        $arrAdd["title"] = $value;
                        $arrAdd["size"] = self::formatFileSize(filesize($dir . DIRECTORY_SEPARATOR . $value));
                        $arrAdd["img"] = (strtolower($arrAdd["type"]) == "jpg" || strtolower($arrAdd["type"]) == "jpeg"
                        || strtolower($arrAdd["type"]) == "gif" || strtolower($arrAdd["type"]) == "png" ? true : false);

                        $result[] = $arrAdd;
                    }
                }
            }
        }
        return $result;
    }

    static function  formatFileSize($bytes) {

        if ($bytes >= 1000000000) {
            return round(($bytes / 1000000000), 2) . ' GB';
        }
        if ($bytes >= 1000000) {
            return round(($bytes / 1000000), 2) . ' MB';
        }
        return round(($bytes / 1000), 2) . ' KB';
    }
} 