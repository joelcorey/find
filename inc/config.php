<?php

class Config
{
    private $useragent = [];

    function __construct()
    {
        $include_directories = [];        
        $include_directories[0] = __DIR__ . "/class/Database/Database.php";
        $include_directories[1] = __DIR__ . "/class/Util/Util.php";
        $include_directories[2] = __DIR__ . "/class/Proxy_API/Proxy_API.php";
        
        $include_directories[3] = __DIR__ . "/useragentlist.php";

        foreach ($include_directories as $include) {
            include $include;
        }
        $this->agent = $useragent;
    }
    
    public function agent()
    {
        return $this->agent;
    }
    //public static function autoload()
    //{
        // spl_autoload_register(function ($class_name) {
        //     include __DIR__ . '/inc/' . $class_name . '.php';
        // });
    //}
}