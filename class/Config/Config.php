<?php

namespace Config;

class Config
{
    private $load = [];
    public $config = [];

    public function __construct()
    {
        $this->load = array(
            'useragentlist',
            'ipsourcelist'
        );

        $this->loadFiles();
    }

    public function loadFiles()
    {
        // for ($i=0; $i < count($load); $i++) { 
        //     $file = __DIR__ . '/load/' . $load[$i] . '.php';
        //     echo $file;
        // }

        foreach ($this->load as $l) {
            $this->config[$l] = require(__DIR__ . '/load/' . $l . '.php');
        }

    }

    public function assign($index)
    {
        return $this->config[$index];
    }
}