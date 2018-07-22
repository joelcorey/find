<?php

class Curl
{
    function doCurl($url, $proxy, $useragent)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_PROXY, $proxy);
        //curl_setopt($ch, CURLOPT_PROXYUSERPWD, $proxyauth);
        //curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 1);
        $curl_scraped_page = curl_exec($ch);
        $headers = curl_getinfo($ch);
        //echo "http_code: " . $headers['http_code'] . '<br>'; 
        print_r($headers) . '<br>';
        curl_close($ch);
        return $curl_scraped_page;
    }
}