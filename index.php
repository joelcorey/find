<?php
require __DIR__  . '/vendor/autoload.php';
require __DIR__  . '/inc/config.php';
$config = new Config();

$rawIpList = \Httpful\Request::get('https://raw.githubusercontent.com/clarketm/proxy-list/master/proxy-list.txt')->send();  
$ipApi = new Proxy_API($rawIpList);
$ipList = $ipApi->regexIpAddress($rawIpList);

$externalContent = file_get_contents('http://checkip.dyndns.com/');
preg_match('/Current IP Address: \[?([:.0-9a-fA-F]+)\]?/', $externalContent, $m);
$externalIp = $m[1];

// echo "Normal ip: $externalIp";
// echo "What proxy ip is supposed to be: $ip";
// echo "<br><br>";

$url = 'http://whatismyip.host/my-ip-address-details';
$proxy = $ip;
echo $proxy;

function testIp($proxyIp, $useragent, $showResponse = false)
{
    $response = [];
    $page = \Httpful\Request::get('https://api.ipify.org?format=json')
        ->sendsJson()
        //->addHeader("User-Agent", $userAgent)
        //->useSocks($ip['ip'], $ip['port'])
        ->addOnCurlOption(CURLOPT_PROXY, $proxyIp)
        ->addOnCurlOption(CURLOPT_USERAGENT, $useragent)
        ->send();

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
    $response['actual_useragent'] = '';
    return $response;
}

function seperateIpAndPort($input)
{
    $input = explode(':', $input);
    $array['ip'] = $input[0];
    $array['port'] = $input[1];
    return $array;
}

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

function doCurlHttpful($url, $proxy, $useragent)
{
    $ipArray = explode(':', $proxy);
    $ip = $ipArray[0];
    $port = $ipArray[1];
    //$url = 'https://www.whatismyip.net/';
    $url = 'https://api.ipify.org?format=json';

    $curl_scraped_page = \Httpful\Request::get($url)
    ->addHeader("User-Agent", $userAgent)
    ->useProxy($ip, $port)
    ->send();
    if ($curl_scraped_page->code === "200") {
            echo "Error: non 200 http_code detected: " . $curl_scraped_page->code;
    }
    echo '<br><br>';
}

$useragentlist = $config->agent();
for ($i=0; $i < 10; $i++) 
{
    $ip = $ipList[rand(0, count($ipList))]; 
    $useragent = $useragentlist[rand(0, count($useragentlist))];
    
    $response = testIp($ip, $useragent, $showResponse = true);
    print_r($response);
    echo "<br><br>";
    echo "-------------------------------";
    echo "<br><br>";
}    

//$useragent = $list[rand(count($list))];

//echo $useragentlist[rand(0, count($useragentlist))];
// echo "<br><br><br><br><br><br><br><br><br>";
// echo "Headers:<br>";
// print_r($headers);

//echo $curl_scraped_page;



