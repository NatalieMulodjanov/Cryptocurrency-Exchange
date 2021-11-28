<html>
<head>
    <title>Home</title>
</head>

    <body>
        <h1>Welcome </h1>
        
        <div>
            <label>Total Balance</label>
            <label>$ <? ?> CAD</label>
        </div>

        <table>
            <tr>
                <th>Code</th>
                <th>Name</th>
                <th>Rate</th>
                <th>Last refreshed</th>
            </tr>
            <?php foreach ($data as $crypto) : ?>
                <tr>
                    <td><?= $crypto['code'] ?></td>
                    <td><?= $crypto['name']?></td>
                    <td><?= $crypto['rate'] ?></td>
                    <td><?= $crypto['last_refreshed'] ?></td>
                </tr>
            <?php endforeach; ?>
        </table>

        <a href = "<?=BASE?>/Account/addFunds">Add Funds</a>
        <a href = "<?=BASE?>/Account/removeFunds">Remove Funds</a>
        <a href = "<?=BASE?>/User/settings">Settings</a>
    </body>
</html>