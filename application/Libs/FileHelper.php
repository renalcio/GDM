<?php
/**
 * Created by PhpStorm.
 * User: TANDA
 * Date: 08/06/2015
 * Time: 12:57
 */

namespace Libs;


class FileHelper {

    static function DirArray($dir, $ignoreList = array()) {

        $result = array();

        $cdir = scandir($dir);

        foreach ($cdir as $key => $value)
        {
            if (!in_array($value,array(".","..")) && !in_array($value,$ignoreList))
            {
                if (is_dir($dir . DIRECTORY_SEPARATOR . $value))
                {
                    $result[$value] = self::DirArray($dir . DIRECTORY_SEPARATOR . $value, $ignoreList);
                }
                else
                {
                    $url = preg_replace("/(.*public\\\\)/mi","",$dir);
                    $url = URL.$url.DIRECTORY_SEPARATOR.$value;
                    $url = preg_replace("/(\\\\)+/", "/", $url);
                    $result[] = $url;
                }
            }
        }

        return $result;
    }

    static function DirList($dir, $ignoreList = array()) {

        $result = array();

        $cdir = scandir($dir);

        //var_dump($ignoreList);

        foreach ($cdir as $key => $value)
        {
            if (!in_array($value,array(".","..")) && !in_array($value,$ignoreList))
            {
                if (is_dir($dir . DIRECTORY_SEPARATOR . $value))
                {
                    $result[$value] = self::DirList($dir . DIRECTORY_SEPARATOR . $value, $ignoreList);
                }
                else
                {
                    $arrAdd =  array();
                    $arrAdd["type"] = pathinfo($dir . DIRECTORY_SEPARATOR . $value, PATHINFO_EXTENSION);
                    $arrAdd["url"] = preg_replace("/(.*public\\\\)/mi","",$dir);
                    $arrAdd["url"] = URL.$arrAdd["url"].DIRECTORY_SEPARATOR.$value;
                    $arrAdd["url"] = preg_replace("/(\\\\)+/", "/", $arrAdd["url"]);
                    $arrAdd["title"] = $value;
                    $arrAdd["size"] = self::formatFileSize(filesize($dir . DIRECTORY_SEPARATOR . $value));
                    $arrAdd["img"] = (strtolower($arrAdd["type"]) == "jpg" || strtolower($arrAdd["type"]) == "jpeg"
                        || strtolower($arrAdd["type"]) == "gif" || strtolower($arrAdd["type"]) == "png" ? true : false);

                    $result[] = $arrAdd;
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