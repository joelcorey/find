<?php

require __DIR__  . '/vendor/autoload.php';
require __DIR__  . '/class/autoload.php';

$config = new \Config\Config();
$userAgentList = $config->assign('useragentlist');


//$proxyapi = new \ProxyApi\ProxyApi();

for ($i=0; $i < 10; $i++) 
{
    // $ip = $ipList[rand(0, count($ipList))]; 
    $useragent = $userAgentList[rand(0, count($userAgentList))];
    echo $useragent . '<br>';
    // $response = testIp($ip, $useragent, $showResponse = true);
    // print_r($response);
    // echo "<br><br>";
    // echo "-------------------------------";
    // echo "<br><br>";
}   


