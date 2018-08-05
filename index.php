<?php

require __DIR__  . '/vendor/autoload.php';
require __DIR__  . '/class/autoload.php';

$config = new \Config\Config();
$util = new \Util\Util();
$proxyApi = new \ProxyApi\ProxyApi();
$database = new \Database\Database();

set_time_limit(0);

date_default_timezone_set('America/Los_Angeles');
// echo(date("Y:m:d:l:H:i:s"));
// die();

$userAgentList = $config->assign('useragentlist');
$ipSource = $config->assign('ipsourcelist');

$ipList = $util->getProxyList($ipSource[1]);
//print_r($ipList);

$database->selectValidIpAddresses();

$doIp = 0;
//ENTRY: continue work on test and invalidate bad response ip's
if ($doIp === 1) {
    for ($i=0; $i < 100; $i++) 
    {
        $proxyIp = $ipList[rand(0, count($ipList))];
        $useragent = $userAgentList[rand(0, count($userAgentList))];
        $timeSpentConnecting = 5;
        $timeSpentTotal = 12;

        echo 'Use these: ' . $proxyIp . ' ' . $useragent . "<br>";
        echo "-------------------------------<br>";

        $testDatabase = 1;

        try {
            $proxyApi->testIp($proxyIp, $useragent, $timeSpentConnecting, $timeSpentTotal);

            // Likely want to keep info on bad httpCodes as well ..
            if (/*$proxyApi->curlResonse['httpCode'] == 200 && */$testDatabase == 1) {
                if (empty($proxyApi->curlResponse['primaryIp'])) {
                    $explodeIp          = explode(':', $proxyIp);
                    $ip                 = $explodeIp[0];
                    $port               = $explodeIp[1];
                }
                if (!empty($proxyApi->curlResponse['primaryIp'])) {
                    $ip                 = $proxyApi->curlResponse['primaryIp'];
                    $port               = $proxyApi->curlResponse['primaryPort'];
                }
                $httpCode               = $proxyApi->curlResponse['httpCode'];
                $totalTime              = $proxyApi->curlResponse['totalTime'];
                $nameLookupTime         = $proxyApi->curlResponse['nameLookupTime'];
                $connectTime            = $proxyApi->curlResponse['connectTime'];
                $pretransferTime        = $proxyApi->curlResponse['pretransferTime'];
                $speedDownload          = $proxyApi->curlResponse['speedDownload'];
                $startupTransferTime    = $proxyApi->curlResponse['startupTransferTime'];
                $rawData                = json_encode($proxyApi->curlResponse);
                $timeStamp              = date("Y:m:d:l:H:i:s");

                $database->insertIpAddress($ip, $port, $httpCode, $totalTime, $nameLookupTime, $connectTime, $pretransferTime, $speedDownload, $startupTransferTime, $rawData, $timeStamp);
            }
            
        } catch (Exception $e) {
            echo $e;
        }
        
        print_r($proxyApi->curlResponse);
        echo "<br><br><br>";

    }
}