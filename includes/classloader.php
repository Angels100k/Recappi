<?php
spl_autoload_register(function ($className) {
    $source = $_SERVER['DOCUMENT_ROOT'];
    $dirs = [
        $source.'classes/'
    ];
    $ext = ".php";

    foreach ($dirs as $directory) {
        if (file_exists($directory.$className.$ext)) {
            require ($directory.$className.$ext);
        }
    }
});