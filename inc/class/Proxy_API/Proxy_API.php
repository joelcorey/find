<?php

class Proxy_API
{
    private $inputIpList;
    private $ipList = [];

    function __construct($inputIpList = '')
    {
        $this->inputIpList = $inputIpList;
        $this->regexIpAddress = $regexIpAddress;
    }

    public function regexIpAddress($input)
    {
        $out = [];
        $regex = '/\b(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?):\d{1,5}\b/';
        preg_match_all($regex, $input, $out);
        return $this->removeWrapperArray($out);
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

    // $ip_list = removeWrapperArray($ip_match);
    // echoArray($ip_list);
}