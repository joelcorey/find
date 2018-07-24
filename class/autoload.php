<?php

spl_autoload_register(function ($class) {

    // $prefix = 'class/';
    $prefix = '';
    $base_dir = __DIR__ . '/'; // your classes folder
    $len = strlen($prefix);
    // if (strncmp($prefix, $class, $len) !== 0) {
    //     return;
    // }
    //$relative_class = substr($class, $len);
    $file = $base_dir . $prefix . str_replace('\\', '/', $class) . '.php';
    //echo $file;
    if (file_exists($file)) {
        require $file;
    }
});
