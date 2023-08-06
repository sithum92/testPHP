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


function getTransactions(string $fileName, ?callable $transactionHandler = null): array
{
    if (!file_exists($fileName)) {
        trigger_error('File"' . $fileName . '"does not exist.', E_USER_ERROR);
    }

    $file = fopen($fileName, 'r');

    fgetcsv($file);

    $transactions = [];

    while (($transaction = fgetcsv($file)) !== false) {
        if($transactionHandler !== null)
        {
            $transactions[] = extractTransaction($transaction);
        }
       $transactions[] = $transaction;
    }
    fclose($file);
    return $transactions;
}


function extractTransaction(array $transactionRow): array
{
    [$date,$checkNumber,$description,$amount] = $transactionRow;
    $amount =(float) str_replace(['$',','],'',$amount);

    // $date = isset($transactionRow['date'])?$transactionRow['date']:null;
    // $checkNumber = isset($transactionRow['checkNumber'])?$transactionRow['checkNumber']:null;
    // $description = isset($transactionRow['description'])?$transactionRow['description']:null;
    // $amount = isset($transactionRow['amount']) ? (float) str_replace(['$', ','], '', $transactionRow['amount']) : null;

return [
    'date' => $date,
    'checkNumber' => $checkNumber,
    'description' => $description,
    'amount' => $amount,
];
}

function calculateTotals(array $transactions): array
{
    $totals = ['netTotal'=>0,'totalIncome'=>0,'totalExpense'=>0];

foreach($transactions as $transaction)
{
   if(isset($transaction['amount']))
   {
    $totals['netTotal'] += $transaction['amount'];

    if($transaction['amount']>=0)
    {
        $totals['totalIncome'] += $transaction['amount'];
    }
    else
    {
        $totals['totalExpense'] += $transaction['amount'];
    }
   }

}
return $totals;
}