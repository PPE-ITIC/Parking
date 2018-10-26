<?php

namespace Ipf\Loader;

class ClassLoader
{
    public function __construct()
    {
        spl_autoload_register(function ($classname) {
            $classname = str_replace('\\', DIRECTORY_SEPARATOR, $classname);
            // Ipf\Db\Connection\Pdo.php
            require_once $classname . '.php';
        });        
    }
}
