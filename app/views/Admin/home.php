<html>
<head>
    <title>Home</title>
</head>

    <body>
        <h1>Welcome Admin</h1>
    
        <table>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Date of Birth</th>
                <th>Email</th>
            </tr>
            <?php
                $users = new \app\models\User();
                $users = $users->getUsers();
            ?>
            <?php foreach ($users as $user) : ?>
                <tr>
                    <td><?= $user->first_name ?></td>
                    <td><?= $user->last_name ?></td>
                    <td><?= $user->dob ?></td>
                    <td><?= $user->email ?></td>
                    <td>
                        <a href="<?= BASE ?>/User/delete/<?= $user->user_id ?>">delete</a>
			        </td>
                    
                </tr>
            <?php endforeach; ?>  
        </table>

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
                        <td><?= $cryptoValue['name'] ?></td>
                        <td><?= $cryptoValue['rate'] ?></td>
                        <td><?= $cryptoValue['last_refreshed'] ?></td>

                    </tr>
                <?php endforeach; ?>
            </table>

        <a href="<?= BASE ?>/Cryptocurrency/addCrypto">Add Crypto</a>
        <a href="<?= BASE ?>/User/logout">Logout</a>
    </body>
</html>