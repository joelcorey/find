<?php

namespace ProxyAPI;

class ProxyAPI
{
    private $inputIpList;
    private $ipList = [];

    public $curlResponse = [];

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
        // $page = \Httpful\Request::get('https://api.ipify.org?format=json')
        //     ->sendsJson()
        //     //->addHeader("User-Agent", $userAgent)
        //     //->useSocks($ip['ip'], $ip['port'])
        //     ->addOnCurlOption(CURLOPT_PROXY, $proxyIp)
        //     ->addOnCurlOption(CURLOPT_USERAGENT, $useragent)
        //     ->send();
        $page = $this->doCurl('https://api.ipify.org?format=json', $proxyIp, $useragent);

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
        curl_setopt($ch, CURLINFO_HEADER_OUT, true);
        $curl_scraped_page = curl_exec($ch);
        $this->responseInfo(curl_getinfo($ch));
        curl_close($ch);
        return $curl_scraped_page;
    }

    public function responseInfo($curlInfo)
    {
        $userAgent = explode("User-Agent: ",  $curlInfo['request_header']);

        $this->curlResponse['httpCode']             = $curlInfo['http_code'];
        $this->curlResponse['totalTime']            = $curlInfo['total_time'];
        $this->curlResponse['nameLookupTime']       = $curlInfo['namelookup_time'];
        $this->curlResponse['connectTime']          = $curlInfo['connect_time'];
        $this->curlResponse['pretransferTime']      = $curlInfo['pretransfer_time'];
        $this->curlResponse['speedDownload']        = $curlInfo['speed_download'];
        $this->curlResponse['startupTransferTime']  = $curlInfo['starttransfer_time'];
        $this->curlResponse['primaryIp']            = $curlInfo['primary_ip'];
        $this->curlResponse['primaryPort']          = $curlInfo['primary_port'];
        $this->curlResponse['userAgent']            = $userAgent[1];
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