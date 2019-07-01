<?php
    spl_autoload_register(function ($class)
    {
        $array_dir = [
            '/components/',
            '/controllers/',
            '/models/',
        ];

        foreach ($array_dir as $dir)
        {
            $path = ROOT.$dir.$class.'.php';

            if (file_exists($path)) {
                include_once $path;
            }
        }
    });