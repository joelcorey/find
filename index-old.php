<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">

  <title>The HTML5 Herald</title>
  <meta name="description" content="The HTML5 Herald">
  <meta name="author" content="SitePoint">
  
  <link rel="stylesheet" href="css/styles.css?v=1.0">
  <!--[if lt IE 9]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
  <![endif]-->
</head>

<body>
  
<?php

require __DIR__  . '/vendor/autoload.php';

spl_autoload_register(function ($class_name) {
    include __DIR__ . '/inc/' . $class_name . '.php';
});


$url_proxy = 'https://www.proxysite.com/';
$url_post = 'https://craigslist.org';

$response = \Httpful\Request::post($url_proxy)             
    ->body(['action' => "update"], Httpful\Mime::FORM)
    //->sendsType(\Httpful\Mime::FORM)
    ->send();  
        
echo $response;

// $get_proxy = \Httpful\Request::get("https://api.getproxylist.com/proxy")->send();
// //$get_proxy = json_decode($get_proxy);

// // $ip = $get_proxy->ip;
// // $port
// // $anonymity

// $get_proxy = (array)$get_proxy;


// $get_proxy_array = [];
// $get_proxy_array = objToArray($get_proxy, $get_proxy_array);

// function objToArray($obj, &$arr){

//     if(!is_object($obj) && !is_array($obj)){
//         $arr = $obj;
//         return $arr;
//     }

//     foreach ($obj as $key => $value)
//     {
//         if (!empty($value))
//         {
//             $arr[$key] = array();
//             objToArray($value, $arr[$key]);
//         }
//         else
//         {
//             $arr[$key] = $value;
//         }
//     }
//     return $arr;
// }

// function traverseArray($array)
// {
//     // Loops through each element. If element again is array, function is recalled. If not, result is echoed.
//     foreach ($array as $key => $value)
//     {
//         if (is_array($value))
//         {
//             traverseArray($value); // Or
//             // traverseArray($value);
//         }
//         else
//         {
//             echo $key . " = " . $value . "<br />\n";
//         }
//     }
// }

// //print_r($get_proxy_array);
// //print_r($get_proxy);

// traverseArray($get_proxy_array);

// // $ip = $get_proxy->ip;
// // $port = $get_proxy->port;

// // echo $ip . ":" . $port;

// // $headers = '';

// // $response = \Httpful\Request::get("www.example.com")
// //     ->useProxy($ip . ":" . $port)
// //     ->parseHeaders($headers)
// //     ->send();

// // print_r($response);

// // $database = new database();
// // $database->insertIp();    
?>

<script>
    
    // console.log("JavaScript sucks");
    var form = document.querySelectorAll( "form.url-form" );
    var server = form[0][0].value;
    console.log(server);
    var temp_action = form[0].action.split("/");
    var new_action = "https://" + server + ".proxysite.com/" + temp_action[4];
    form[0].action = new_action;

    form[0][1].value = "www.craigslist.org";
    // Working example code:
    for (i = 0; i < form.length; i++) {
        // if (form[i].type.toLowerCase() == "text") {
        //     console.log(form[i].value);
        // }
        console.log(form[i]);
    } 
    //console.log(form[0].action);
    //console.log(form[0][1].placeholder)

</script>

<?php


  

?>

</body>
</html>

