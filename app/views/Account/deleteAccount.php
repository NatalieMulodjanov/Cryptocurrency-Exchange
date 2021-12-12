<html>

<head>
    <title>Delete my account</title>
</head>

<body>
    <a href="<?=BASE?>/User/Settings">return</a></br></br>
    <h1>Delete my account</h1>

    <?php if (isset($data['error'])) : ?>
        <script>
            alert("<?php echo $data["error"]; ?>");
        </script>

    <?php endif; ?>
    <table>
        <th>Currency</th>
        <th>Amount</th>
        <?php foreach ($data['wallets'] as $wallet) : ?>
            <tr>
                <td><?= $wallet->crypto_code ?></td>
                <td><?= $wallet->amount ?></td>
            </tr>

        <?php endforeach; ?>

        <tr>
            <td>CAD</td>
            <td><?php echo $data["available_funds_CAD"] ?></td>
        </tr>
    </table>

    <?php if (isset($data['wallets']) && $data['wallets'] != null) : ?>
        <a href="tradeAll">Trade all cryptocurrencies</a>
    <?php endif; ?>

    <?php if (isset($data['available_funds_CAD']) && $data['available_funds_CAD'] != null && $data['available_funds_CAD'] > 0) : ?>
        <a href="withdrawAll">Withdraw all CAD</a>
    <?php endif; ?>

    <form action="" method="post">
        <input type="submit" name="action" value="Delete My Account">
    </form>

</body>

</html>