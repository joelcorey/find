<?php
require __DIR__  . '/vendor/autoload.php';
require __DIR__  . '/class/autoload.php';
$config = new \Config\Config();

$proxyapi = new \ProxyApi\ProxyApi();

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


