<?php

declare(strict_types = 1);

$root = dirname(__DIR__) . DIRECTORY_SEPARATOR;

define('APP_PATH', $root . 'app' .DIRECTORY_SEPARATOR);
define('FILES_PATH',$root . 'tranasction_files' . DIRECTORY_SEPARATOR);
define('VIEWS_PATH',$root . 'views' . DIRECTORY_SEPARATOR);

require APP_PATH . "App.php";


$files = getTransactionFiles(FILES_PATH);

$transsactions = [];

foreach($files as $file)
{
    $transsactions = array_merge($transsactions,getTransactions($file));
}

print_r($transsactions);