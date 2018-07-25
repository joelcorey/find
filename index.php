<?php

require __DIR__  . '/vendor/autoload.php';
require __DIR__  . '/class/autoload.php';

$config = new \Config\Config();
$util = new \Util\Util();
$proxyApi = new \ProxyApi\ProxyApi();

$userAgentList = $config->assign('useragentlist');
$ipSource = $config->assign('ipsourcelist');

$ipList = $util->getProxyList($ipSource[0]);
//print_r($ipList);

for ($i=0; $i < 100; $i++) 
{
    $ip = $ipList[rand(0, count($ipList))]; 
    echo $ip . '<br>';
    // $useragent = $userAgentList[rand(0, count($userAgentList))];
    // $response = testIp($ip, $useragent, $showResponse = true);
    // print_r($response);
    // echo "<br><br>";
    // echo "-------------------------------";
    // echo "<br><br>";
}   


