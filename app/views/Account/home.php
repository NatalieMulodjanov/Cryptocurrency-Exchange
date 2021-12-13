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
                        <a class="nav-link" href="<?= BASE ?>Account/addFunds">Deposit Funds <i class="fa fa-arrow-up" aria-hidden="true"></i></a>
                    </li>
                    <li class="nav-item nav-item-link" style="display: flex; justify-content: flex-end;">
                        <a class="nav-link" href="<?= BASE ?>Account/removeFunds">Withdraw Funds <i class="fa fa-arrow-down" aria-hidden="true"></i></a>
                    </li>
                    <li class="nav-item nav-item-link" style="display: flex; justify-content: flex-end;">
                        <a class="nav-link" href="<?= BASE ?>Account/buyCrypto">Buy & Sell</a>
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
        <div class="d-flex" style="flex-direction: column;">
            <h1 style="font-weight: bold; margin-bottom: 40px; margin-top: 20px;" class="d-flex justify-content-center">
                Welcome <?php echo $data['user_First_name'] ?> <?php echo $data['user_Last_name'] ?>
            </h1>

            
            <h3 style="font-weight: bold; display: flex;">Owned Coins</h3>
            <table class="d-flex table table-hover" style="display: flex; align-items: center; margin-bottom: 10px;">
                <tr style="display: flex; font-size: 17px">
                    <th style="width: 400px; display: flex">Name</th>
                    <th style="width: 250px; display: flex">Amount owned</th>
                    <th style="width: 250px; display: flex">Current price</th>
                    <th style="width: 250px; display: flex">Last refreshed</th>
                    <th style="width: 150px; display: flex">Trade</th>
                </tr>
                <?php if (empty($data['ownedCrypto'])) : ?>
                    <tr style="display: flex">
                        <td style="width: 100%; text-align: center" style="width: 400px; display: flex; align-items: center;">
                            <span style="font-size: 17px; font-weight: bold; margin-left: 15px; color: black">No owned coins.</span>
                        </td>
                    </tr>
                <?php endif; ?>
                <?php foreach ($data['ownedCrypto'] as $cryptoKey => $cryptoValue) : ?>
                    <tr style="display: flex">
                        <td style="width: 400px; display: flex; align-items: center;">
                            <img src="/Final_Project/app/imgs/<?= $cryptoValue['coin_logo_path'] ?>" class="logo" />
                            <span style="font-size: 19px; font-weight: bold; margin-left: 15px; color: black"><?= $cryptoValue['name'] ?></span>
                            <span style="font-size: 17px; font-weight: 300; margin-left: 15px; color: rgb(93, 93, 93)"><?= $cryptoKey ?></span>
                        </td>
                        <td style="width: 250px; display: flex; align-items: center;">
                            <span style="font-size: 18px; font-weight: bold; color: black"><?= $cryptoValue['amount_owned'] ?></span>
                            <!-- <?= $cryptoValue['rate'] ?> -->
                        </td>
                        <td style="width: 250px; display: flex; align-items: center;">
                            <span style="font-size: 18px; font-weight: bold; color: black">CA$<?= $cryptoValue['rate'] < 1 ? number_format($cryptoValue['rate'], 8) : number_format($cryptoValue['rate'], 3) ?></span>
                        </td>
                        <td style="width: 250px; display: flex; align-items: center;">
                            <?= $cryptoValue['last_refreshed'] ?>
                        </td>
                        <td style="width: 150px; display: flex; align-items: center;">
                            <a class="btn btn-success" style="width: 150px; color: white; font-size: 17px; font-weight: bold;" href="<?= BASE ?>Account/buyCrypto">Buy & Sell</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>

            
            <div class="d-flex" style="display: flex; margin-bottom: 20px; margin-left: 10px;">
                <h5 style="margin-bottom: 0">Available funds(CA$    ): <b style="color: #85bb65"><?= $data['available_funds_CAD'] ?></b>&nbsp;</h5>
                    <img src="https://www.clipartmax.com/png/full/78-786778_file-icon-canada-svg-canada-flag-icon-png.png" style="display:flex; align-self: center; width: 25px; height: 25px;" />
            </div>
            <div class="d-flex" style="display: flex; margin-bottom: 20px; margin-left: 10px; margin-bottom: 70px">
                <h5 style="margin-bottom: 0;">Total funds(CA$): <b style="color: #85bb65"><?= $data['total_funds_CAD'] ?></b>&nbsp;</h5>
                    <img src="https://www.clipartmax.com/png/full/78-786778_file-icon-canada-svg-canada-flag-icon-png.png" style="display:flex; align-self: center; width: 25px; height: 25px;" />
            </div>

            <h3 style="font-weight: bold; display: flex;">Your favorite coins</h3>
            <table class="d-flex table table-hover" style="display: flex; align-items: center; margin-bottom: 70px">
                <tr style="display: flex; font-size: 17px">
                    <th style="width: 400px; display: flex">Name</th>
                    <th style="width: 375px; display: flex">Current price</th>
                    <th style="width: 375px; display: flex">Last refreshed</th>
                    <th style="width: 150px; display: flex">Trade</th>
                </tr>
                <?php if (empty($data['favorites'])) : ?>
                    <tr style="display: flex">
                        <td style="width: 100%; text-align: center" style="width: 400px; display: flex; align-items: center;">
                            <span style="font-size: 17px; font-weight: bold; margin-left: 15px; color: black">No favorites.</span>
                        </td>
                    </tr>
                <?php endif; ?>

                <?php foreach ($data['favorites'] as $cryptoKey => $cryptoValue) : ?>
                    <tr style="display: flex">
                        <td style="width: 400px; display: flex; align-items: center;">
                            <img src="/Final_Project/app/imgs/<?= $cryptoValue['coin_logo_path'] ?>" class="logo" />
                            <span style="font-size: 19px; font-weight: bold; margin-left: 15px; color: black"><?= $cryptoValue['name'] ?></span>
                            <span style="font-size: 17px; font-weight: 300; margin-left: 15px; color: rgb(93, 93, 93)"><?= $cryptoKey ?></span>
                        </td>
                        <td style="width: 375px; display: flex; align-items: center;">
                            <span style="font-size: 18px; font-weight: bold; color: black">CA$<?= $cryptoValue['rate'] < 1 ? number_format($cryptoValue['rate'], 8) : number_format($cryptoValue['rate'], 3) ?></span>
                        </td>
                        <td style="width: 375px; display: flex; align-items: center;">
                            <?= $cryptoValue['last_refreshed'] ?>
                        </td>
                        <td style="width: 150px; display: flex; align-items: center;">
                            <a class="btn btn-success" style="width: 150px; color: white; font-size: 17px; font-weight: bold;" href="<?= BASE ?>Account/buyCrypto">Buy & Sell</a>
                        </td>
                    </tr>

                <?php endforeach; ?>
            </table>


            <h3 style="font-weight: bold; display: flex;">All available coins</h3>
            <table class="d-flex table table-hover" style="display: flex; align-items: center;">
                <tr style="display: flex; font-size: 17px">

                    <th style="width: 50px; display: flex"></th>
                    <th style="width: 350px; display: flex">Name</th>
                    <th style="width: 375px; display: flex">Current price</th>
                    <th style="width: 375px; display: flex">Last refreshed</th>
                    <th style="width: 150px; display: flex">Trade</th>
                </tr>
                <?php if (empty($data['cryptoAPI'])) : ?>
                    <tr style="display: flex">
                        <td style="width: 100%; text-align: center" style="width: 400px; display: flex; align-items: center;">
                            <span style="font-size: 17px; font-weight: bold; margin-left: 15px; color: black">No coins are available.</span>
                        </td>
                    </tr>
                <?php endif; ?>

                <?php foreach ($data['cryptoAPI'] as $cryptoKey => $cryptoValue) : ?>
                    <tr style="display: flex">
                        <td style="width: 50px; display: flex; align-items: center;">
                        <?php if (!isset($data['favorites'][$cryptoKey])) : ?>
                            <a href="<?= BASE ?>Cryptocurrency/addFavorite/<?= $cryptoKey ?>"><i style="color: black" class="inactive-favorite fas fa-star fa-lg"></i></a>
                        <?php else : ?>
                            <a href="<?= BASE ?>Cryptocurrency/removeFavorite/<?= $cryptoKey ?>"><i style="color: gold" class="active-favorite fas fa-star fa-lg"></i></a>
                        <?php endif; ?>

                        </td>
                        <td style="width: 350px; display: flex; align-items: center;">
                            <img src="/Final_Project/app/imgs/<?= $cryptoValue['coin_logo_path'] ?>" class="logo" />
                            <span style="font-size: 19px; font-weight: bold; margin-left: 15px; color: black"><?= $cryptoValue['name'] ?></span>
                            <span style="font-size: 17px; font-weight: 300; margin-left: 15px; color: rgb(93, 93, 93)"><?= $cryptoKey ?></span>
                        </td>
                        <td style="width: 375px; display: flex; align-items: center;">
                            <span style="font-size: 18px; font-weight: bold; color: black">CA$<?= $cryptoValue['rate'] < 1 ? number_format($cryptoValue['rate'], 8) : number_format($cryptoValue['rate'], 3) ?></span>
                        </td>
                        <td style="width: 375px; display: flex; align-items: center;">
                            <?= $cryptoValue['last_refreshed'] ?>
                        </td>
                        <td style="width: 150px; display: flex; align-items: center;">
                            <a class="btn btn-success" style="width: 150px; color: white; font-size: 17px; font-weight: bold;" href="<?= BASE ?>Account/buyCrypto">Buy & Sell</a>
                        </td>
                    </tr>

                <?php endforeach; ?>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script>
        window.onload = () => {
            // mdc.ripple.MDCRipple.attachTo(document.querySelector('.foo-button'));
        }
    </script>
</body>

</html>