<?php

namespace Util;

class Util
{
    public function getProxyList($url)
    {
        return $this->regexIpAddress($this->get($url));
    }

    public function regexIpAddress($input)
    {
        $out = [];
        $regex = '/\b(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?):\d{1,5}\b/';
        preg_match_all($regex, $input, $out);
        return $this->removeWrapperArray($out);
    }

    public function get($url)
    {
        return \Httpful\Request::get($url)->send();
    }

        public function removeWrapperArray(&$array)
    {
        $new_array = [];
        for ($i=0; $i < count($array[0]); $i++) { 
            $new_array[$i] = $array[0][$i];
        }
        return $new_array;
    }

    public static function echoArray($array)
    {
        for ($i=0; $i < count($array); $i++) 
        { 
            echo $array[$i] . '<br>';
        }
    }

    // Left overs from other un-used util class
    // public function objToArray($obj, $arr)
    // {

    //     if(!is_object($obj) && !is_array($obj)){
    //         $arr = $obj;
    //         return $arr;
    //     }

    //     foreach ($obj as $key => $value)
    //     {
    //         if (!empty($value))
    //         {
    //             $arr[$key] = array();
    //             static::objToArray($value, $arr[$key]);
    //         }
    //         else
    //         {
    //             $arr[$key] = $value;
    //         }
    //     }
    //     return $arr;
    // }

    // public static function traverseArray($array)
    // {
    //     // Loops through each element. If element again is array, function is recalled. If not, result is echoed.
    //     foreach ($array as $key => $value)
    //     {
    //         if (is_array($value))
    //         {
    //             static::traverseArray($value); // Or
    //             // traverseArray($value);
    //         }
    //         else
    //         {
    //             echo $key . " = " . $value . "<br />\n";
    //         }
    //     }
    // }

}