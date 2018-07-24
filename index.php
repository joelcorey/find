<?php

require __DIR__  . '/vendor/autoload.php';
require __DIR__  . '/class/autoload.php';

$config = new \Config\Config();
$proxyApi = new \ProxyApi\ProxyApi();

$userAgentList = $config->assign('useragentlist');

$ipList = $proxyApi->getProxyList('https://github.com/clarketm/proxy-list/blob/master/proxy-list.txt');

print_r($ipList);

for ($i=0; $i < 10; $i++) 
{
    // $ip = $ipList[rand(0, count($ipList))]; 
    //$useragent = $userAgentList[rand(0, count($userAgentList))];
    // $response = testIp($ip, $useragent, $showResponse = true);
    // print_r($response);
    // echo "<br><br>";
    // echo "-------------------------------";
    // echo "<br><br>";
}   


