<?php

$get_proxy = \Httpful\Request::get("https://api.getproxylist.com/proxy")->send();
//$get_proxy = json_decode($get_proxy);

// $ip = $get_proxy->ip;
// $port
// $anonymity

$get_proxy = (array)$get_proxy;


$get_proxy_array = [];
$get_proxy_array = objToArray($get_proxy, $get_proxy_array);

function objToArray($obj, &$arr){

    if(!is_object($obj) && !is_array($obj)){
        $arr = $obj;
        return $arr;
    }

    foreach ($obj as $key => $value)
    {
        if (!empty($value))
        {
            $arr[$key] = array();
            objToArray($value, $arr[$key]);
        }
        else
        {
            $arr[$key] = $value;
        }
    }
    return $arr;
}

function traverseArray($array)
{
    // Loops through each element. If element again is array, function is recalled. If not, result is echoed.
    foreach ($array as $key => $value)
    {
        if (is_array($value))
        {
            traverseArray($value); // Or
            // traverseArray($value);
        }
        else
        {
            echo $key . " = " . $value . "<br />\n";
        }
    }
}

//print_r($get_proxy_array);
//print_r($get_proxy);

traverseArray($get_proxy_array);

// $ip = $get_proxy->ip;
// $port = $get_proxy->port;

// echo $ip . ":" . $port;

// $headers = '';

// $response = \Httpful\Request::get("www.example.com")
//     ->useProxy($ip . ":" . $port)
//     ->parseHeaders($headers)
//     ->send();

// print_r($response);

// $database = new database();
// $database->insertIp();