<html>

<head>
    <title>Home</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <style>
        body::after {
            background-image: urL('https://media.istockphoto.com/photos/blockchain-technology-with-abstract-background-picture-id871491470?b=1&k=20&m=871491470&s=170667a&w=0&h=CmIzgNM_ca2bMDwUpxCfMwcl5vE5Xs_H6JjsAdKKoiY=');
            background-repeat: no-repeat;
            background-size: cover;
            background-color: rgba(0, 0, 0, 0.2);
        }
    </style>
</head>

<body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <ul class="navbar-nav">
                    <li class="nav-item" style="">
                        <a class="nav-link" href="<?= BASE ?>/Account/home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASE ?>/Account/addFunds">Add Funds</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASE ?>/Account/removeFunds">Remove Funds</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASE ?>/User/settings">Settings</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASE ?>/Account/buyCrypto">Buy & Sell</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASE ?>/User/logout">Logout</a>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="container d-flex">
        <div class="row d-flex justify-content-center">
            <h1 class="d-flex">Welcome
                <?php echo $data['user_First_name'] ?>
                <?php echo $data['user_Last_name'] ?>

            </h1>

            <div class="d-flex">
                <label>Total Balance: &nbsp;</label>
                <label><?php echo $data['available_funds_CAD'] ?> CAD</label>
            </div>

            <table class="d-flex table table-striped table-hover">
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