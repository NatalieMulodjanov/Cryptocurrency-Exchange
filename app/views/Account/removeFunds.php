<html>
    <head>
        <title>Remove Funds</title>
    </head>
    
    <body>
        <a href="<?=BASE?>/Account/index">return</a>

        <h1>Remove Funds</h1>
        
        <div>
            <label>Total Balance</label>
            <label>$  CAD</label>
        </div>
        
        <form method="post">
            <label>Amount</label>
            <input type="text" name="amount"/>CAD
            <input type="submit" name = "action" value="Remove Funds" />
        </form>
    </body>
</html>