<?php

$storagePath = '/tmp/storage';

foreach (['app/public', 'framework/cache/data', 'framework/sessions', 'framework/views', 'logs'] as $directory) {
    $path = $storagePath.'/'.$directory;

    if (! is_dir($path)) {
        @mkdir($path, 0777, true);
    }
}

$_ENV['LARAVEL_STORAGE_PATH'] = $storagePath;
$_SERVER['LARAVEL_STORAGE_PATH'] = $storagePath;
putenv('LARAVEL_STORAGE_PATH='.$storagePath);

require __DIR__.'/../public/index.php';
