<html>
    <head>
        <title>View Past Transactions</title>
    </head>

    <body>
        <h1>All Past Transactions</h1>
        <a href="Account/Home">Return</a>
        
        <table>
            <th>Currency</th> <th>amount</th> <th>Total transaction in CAD</th> <th>Date and Time</th>

            <?php foreach ($data['transactions'] as $transaction) : ?>
                <tr>
                    <td><?= $transaction->crypto_code ?></td>
                    <td><?= $transaction->amount?></td>
                    <td><?= $transaction->total ?></td>
                    <td><?= $transaction->date_time ?></td>
                    
                </tr>
            <?php endforeach; ?>  
        </table>

    </body>
</html>