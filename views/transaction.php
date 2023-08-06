<!DOCTYPE html>
<html>
    <head>
        <title>Transactions</title>
        <style>
            table {
                width: 100%;
                border-collapse: collapse;
                text-align: center;
            }

            table tr th, table tr td {
                padding: 5px;
                border: 1px #eee solid;
            }

            tfoot tr th, tfoot tr td {
                font-size: 20px;
            }

            tfoot tr th {
                text-align: right;
            }
        </style>
    </head>
    <body>
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Check #</th>
                    <th>Description</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
               <?php if(! empty($transactions)):?>
                <?php foreach($transactions as $transaction):?>
                    <tr>
                <td><?php echo isset($transaction['date']) ? $transaction['date'] : ''; ?></td>
                <td><?php echo isset($transaction['checkNumber']) ? $transaction['checkNumber'] : ''; ?></td>
                <td><?php echo isset($transaction['description']) ? $transaction['description'] : ''; ?></td>
                <td>

                <?php if (isset($transaction['amount'])): ?>
    <?php if ($transaction['amount'] < 0): ?>
        <span style="color: red;">'<?php echo '$' . number_format($transaction['amount'], 2); ?>'</span>
    <?php else: ?>
        <span style="color: green;">'<?php echo '$' . number_format($transaction['amount'], 2); ?>'</span>
    <?php endif; ?>
<?php endif; ?>
                </td>
            </tr>
                    <?php endforeach?>
                    <?php endif?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3">Total Income:</th>
                    <td><?=$totals['totalIncome']??0?></td>
                </tr>
                <tr>
                    <th colspan="3">Total Expense:</th>
                    <td><?=$totals['totalExpense']??0?></td>
                </tr>
                <tr>
                    <th colspan="3">Net Total:</th>
                    <td><?=$totals['netTotal']??0?></td>
                </tr>
            </tfoot>
        </table>
    </body>
</html>
