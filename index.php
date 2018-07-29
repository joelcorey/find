<?php

set_time_limit(500);

require __DIR__  . '/vendor/autoload.php';
require __DIR__  . '/class/autoload.php';

$config = new \Config\Config();
$util = new \Util\Util();
$proxyApi = new \ProxyApi\ProxyApi();
//$database = new \Database\Database();

$userAgentList = $config->assign('useragentlist');
$ipSource = $config->assign('ipsourcelist');

$ipList = $util->getProxyList($ipSource[0]);
//print_r($ipList);

//ENTRY: continue work on test and invalidate bad response ip's
//ENTRY: verify actual useragent/fix
for ($i=0; $i < 2; $i++) 
{
    $ip = $ipList[rand(0, count($ipList))];
    $useragent = $userAgentList[rand(0, count($userAgentList))];
    
    echo 'Use these: ' . $ip . ' ' . $useragent . '<br>';
    echo "-------------------------------<br>";

    try {
        $response = $proxyApi->testIp($ip, $useragent);
    } catch (Exception $e) {
        echo $e;
    }
    
    print_r($proxyApi->curlResponse);
    echo "<br><br><br>";

}