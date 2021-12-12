<html>
<head>
    <title>Home</title>
</head>

    <body>
        <h1>Welcome  
            <?php echo $data['user_First_name'] ?>
            <?php echo $data['user_Last_name'] ?>
            
        </h1>
    
        <table>
            <tr>
                <th>Code</th>
                <th>Name</th>
                <th>Rate</th>
                <th>Last refreshed</th>
            </tr>
            <?php foreach ($data['cryptoAPI'] as $cryptoKey => $cryptoValue) : ?>
                <tr>
                    <td><?= $cryptoKey ?></td>
                    <td><?= $cryptoValue['name']?></td>
                    <td><?= $cryptoValue['rate'] ?></td>
                    <td><?= $cryptoValue['last_refreshed'] ?></td>
                    
                </tr>
            <?php endforeach; ?>  
        </table>

        <a href="<?=BASE?>/Account/addCrypto">Add Crypto</a>
        <a href="<?= BASE ?>/User/logout">Logout</a>
    </body>
</html>