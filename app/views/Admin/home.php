<html>
<head>
    <title>Home</title>
</head>

    <body>
        <h1>Welcome Admin</h1>
    
        <table>
            <tr>
                <th>Code</th>
                <th>Name</th>
                <th>Rate</th>
                <th>Last refreshed</th>
            </tr>
            <?php foreach ($data as $user) : ?>
                <tr>
                    <td><?= $user->first_name ?></td>
                    <td><?= $user->last_name ?></td>
                    <td><?= $user->dob ?></td>
                    <td><?= $user->email ?></td>
                    <td>
                        <a href="<?=BASE?>/User/delete">delete</a>
			        </td>
                    
                </tr>
            <?php endforeach; ?>  
        </table>

        <a href="<?=BASE?>/Account/addCrypto">Add Crypto</a>
        <a href="<?= BASE ?>/User/logout">Logout</a>
    </body>
</html>