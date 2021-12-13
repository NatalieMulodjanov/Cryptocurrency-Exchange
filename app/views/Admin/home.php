<html>

<head>
    <title>Home</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background: rgba(255, 255, 255, 1)
        }

        .logo {
            width: 30px;
            height: 30px;
        }

        .cryptoAmount {
            color: black;
            font-size: 1rem;
            margin-right: 30px;
            margin-left: 10px;
            font-weight: bold;
        }

        .cryptoAmount:hover {
            color: rgb(28, 165, 211) !important;
            cursor: pointer !important;
            transition: all 0.3s !important;
        }

        .nav-item-link {
            margin-right: 20px;
            font-size: 1rem;
            font-weight: bold;
            display: flex;
            justify-content: flex-end;
        }

        a:hover {
            color: rgb(28, 165, 211) !important;
            cursor: pointer !important;
            transition: all 0.3s !important;
        }

        a {
            color: black;
        }

        .nav-link {
            color: black;
        }

        * {
            box-sizing: border-box;
        }

        .inactive-favorite:hover {
            color: gold !important;
        }

        .active-favorite:hover {
            color: black !important;
        }
    </style>
</head>

<body>
    <nav class="container navbar navbar-expand-lg">
        <div style="width: 100%">
            <ul class="navbar-nav col-md-12" style="display: flex; align-items: center; width: 100%">
                <div style="display: flex">
                    <li class="nav-item" style="display: flex; justify-content: center;align-items: center;">
                        <img class="logo" src="/Final_Project/app/imgs/<?= $data['cryptoAPI']['BTC']['coin_logo_path'] ?>" alt="logo">
                    </li>
                    <li class="nav-item" style="display: flex; justify-content: center;align-items: center; ">
                        <span class="cryptoAmount">$<?= number_format($data['cryptoAPI']['BTC']['rate'], 2) ?></span>
                    </li>
                    <li class="nav-item" style="display: flex; justify-content: center;align-items: center;">
                        <img class="logo" src="/Final_Project/app/imgs/<?= $data['cryptoAPI']['ETH']['coin_logo_path'] ?>" alt="logo">
                    </li>
                    <li class="nav-item" style="margin-right: 60px; display: flex; justify-content: center;align-items: center;">
                        <span class="cryptoAmount">$<?= number_format($data['cryptoAPI']['ETH']['rate'], 2) ?></span>
                    </li>
                </div>

                <div style="display: flex; justify-content: flex-end; width: 100%">
                    <li class="nav-item nav-item-link" style="display: flex; justify-content: flex-end; align-items: center;">
                        <a class="nav-link" href="<?= BASE ?>Account/index"><i class="fa fa-home fa-lg" aria-hidden="true" alt="Home"></i></a>
                    </li>
                    <li class="nav-item nav-item-link" style="display: flex; justify-content: flex-end;">
                        <a class="nav-link" href="<?= BASE ?>/Cryptocurrency/addCrypto">Add Crypto</a>
                    </li>
                    <li class="nav-item nav-item-link" style="display: flex; justify-content: flex-end; align-items: center;">
                        <a class="nav-link" href="<?= BASE ?>User/settings"><i class="fa fa-cog fa-lg" alt="Settings"></i></a>
                    </li>
                    <li class="nav-item nav-item-link" style="display: flex; justify-content: flex-end; align-items: center;">
                        <a class="nav-link" href="<?= BASE ?>User/logout"><i class="fas fa-sign-out-alt fa-lg" alt="Logout"></i></a>
                    </li>
                </div>
            </ul>
        </div>
    </nav>
    <div class="container d-flex">
        <div class="d-flex" style="flex-direction: column; width: 100%">
            <h1 style="font-weight: bold; margin-bottom: 20px; margin-top: 20px;" class="d-flex justify-content-center">
                Welcome Admin
            </h1>

            <table class="d-flex table table-hover" style="display: flex; align-items: center; margin-bottom: 10px;">
                <tr style="display: flex; font-size: 17px">
                    <th style="width: 400px; display: flex">First name</th>
                    <th style="width: 300px; display: flex">Last name</th>
                    <th style="width: 300px; display: flex">Date of birth</th>
                    <th style="width: 300px; display: flex">Email</th>
                    <th style="width: 300px; display: flex">Delete</th>
                </tr>
                <?php if (empty($data['users'])) : ?>
                    <tr style="display: flex">
                        <td style="width: 100%; text-align: center" style="width: 400px; display: flex; align-items: center;">
                            <span style="font-size: 17px; font-weight: bold; margin-left: 15px; color: black">No registered users.</span>
                        </td>
                    </tr>
                <?php endif; ?>
                <?php foreach ($data['users'] as $user) : ?>
                    <tr style="display: flex">
                        <td style="width: 400px; display: flex; align-items: center;">
                            <span style="font-size: 19px; margin-left: 15px; color: rgb(93, 93, 93)"><?= $user->first_name ?></span>
                        </td>
                        <td style="width: 300px; display: flex; align-items: center;">
                            <span style="font-size: 19px; color: black"><?= $user->last_name ?></span>
                        </td>
                        <td style="width: 300px; display: flex; align-items: center;">
                            <span style="font-size: 19px; color: black"><?= $user->dob ?></span>
                        </td>
                        <td style="width: 300px; display: flex; align-items: center;">
                            <span style="font-size: 19px; color: black"><?= $user->email ?></span>
                        </td>
                        <td style="width: 300px; display: flex; align-items: center;">
                            <a href="<?= BASE ?>/User/delete/<?= $user->user_id ?>" class="btn btn-danger" style="width: 100px">Delete</span>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>

        </div>
    </div>

    <a href="<?= BASE ?>/Cryptocurrency/addCrypto">Add Crypto</a>
    <a href="<?= BASE ?>/User/logout">Logout</a>
</body>

</html>