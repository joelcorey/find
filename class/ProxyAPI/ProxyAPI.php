<?php

namespace ProxyAPI;

class ProxyAPI
{
    private $inputIpList;
    private $ipList = [];

    public function getUnmaskedIp()
    {
        $externalContent = file_get_contents('http://checkip.dyndns.com/');
        preg_match('/Current IP Address: \[?([:.0-9a-fA-F]+)\]?/', $externalContent, $match);
        return $match[1];
    }

    public function get($url)
    {
        return \Httpful\Request::get($url)->send();
    }

    public function testIp($proxyIp, $useragent, $showResponse = false)
    {
        $response = [];
        $page = \Httpful\Request::get('https://api.ipify.org?format=json')
            ->sendsJson()
            //->addHeader("User-Agent", $userAgent)
            //->useSocks($ip['ip'], $ip['port'])
            ->addOnCurlOption(CURLOPT_PROXY, $proxyIp)
            ->addOnCurlOption(CURLOPT_USERAGENT, $useragent)
            ->send();
        //$page = $this->doCurl('https://api.ipify.org?format=json', $proxyIp, $useragent);

        if($showResponse !== false)
        {
            echo '<br>';
            print_r($page);
            echo '<br><br>';
        }

        $response['http_code'] = $page->code;
        $response['input_ip'] = $proxyIp;
        $response['actual_ip'] = $page->body->ip; 
        $response['input_useragent'] = $useragent;
        $response['actual_useragent'] = $page->body;
        return $response;
    }

    public function seperateIpAndPort($input)
    {
        $input = explode(':', $input);
        $array['ip'] = $input[0];
        $array['port'] = $input[1];
        return $array;
    }

    public function doCurl($url, $proxy, $useragent)
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

    public function doCurlHttpful($url, $proxy, $useragent)
    {
        $ipArray = explode(':', $proxy);
        $ip = $ipArray[0];
        $port = $ipArray[1];
        //$url = 'https://www.whatismyip.net/';
        $url = 'https://api.ipify.org?format=json';

        $curl_scraped_page = \Httpful\Request::get($url)
        ->header("User-Agent:", $userAgent)
        ->useProxy($ip, $port)
        ->send();
        if ($curl_scraped_page->code === "200") {
                echo "Error: non 200 http_code detected: " . $curl_scraped_page->code;
        }
        echo '<br><br>';
    }
}