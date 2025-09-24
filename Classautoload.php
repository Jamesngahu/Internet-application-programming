<?php

require_once 'conf.php';

$directories = ['Global', 'Forms', 'Layouts'];

spl_autoload_register(function ($className) use ($directories) {
    foreach ($directories as $directory) {
        $filePath = __DIR__ . "/$directory/" . $className . '.php';
        if (file_exists($filePath)) {
            require_once $filePath;
            return;
        }
    }
});


$hello = new classes();
$form = new forms();
$layout = new layouts();