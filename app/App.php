<?php

declare(strict_types=1);

function getTransactionFiles(string $dirPath): array
{
    $files = [];

    foreach (scandir($dirPath) as $file) {
        if (is_dir($dirPath . $file)) {
            continue;
        }

        $files[] = $dirPath . $file;
    }

    return $files;
}


function getTransactions(string $fileName): array
{
    if (!file_exists($fileName)) {
        trigger_error('File"' . $fileName . '"does not exist.', E_USER_ERROR);
    }

    $file = fopen($fileName, 'r');

    $transactions = [];

    while (($transaction = fgetcsv($file)) !== false) {
        $transactions[] = $transaction;
    }
    fclose($file);
    return $transactions;
}
