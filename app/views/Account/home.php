<html>
<head>
    <title>Home</title>
</head>

    <body>
        <h1>Welcome <?= $user->name ?></h1>
        
        <div>
            <label>Total Balance</label>
            <label>$ <? ?> CAD</label>
        </div>

        <a href = "<?=BASE?>/User/addFunds">Add Funds</a>
        <a href = "<?=BASE?>/User/removeFunds">Remove Funds</a>
    </body>
</html>