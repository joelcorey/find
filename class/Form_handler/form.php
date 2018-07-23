<?php


$url = 'https://www.proxysite.com/';
$response = Httpful::post($url)             
    ->body(['foo' => 'bar'], Httpful\Mime::FORM)
    ->sendsType(\Httpful\Mime::FORM)
    ->send();  
        
echo $response;
