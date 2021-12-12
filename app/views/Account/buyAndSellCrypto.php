<html>
    <head>
        <title>
            Buy and sell 
        </title>
    </head>

    <body>
        <h1>Buy & Sell</h1>

        <h3>Your Coins:</h3>

        <?php if(isset($data['error'])): ?>  
            <script>
             alert("<?php echo $data["error"]; ?>");
              </script>
        
        <?php endif; ?>

        <table>
            <th>Currency</th> <th>Amount</th>
            <?php foreach($data['wallets'] as $wallet) : ?>
                <tr>
                    <td><?= $wallet->crypto_code ?></td>
                    <td><?= $wallet->amount ?></td>
                </tr>
             
            <?php endforeach; ?>

            <tr>
                    <td>CAD</td>
                    <td><?php echo $data["available_funds_CAD"]?></td>
                </tr>
        </table>
        
        <form action="" method = "post">
            <input type="radio" name = "radio" value="sell" checked>Sell
            <input type="radio" name = "radio" value="buy">Buy <br>

            <select name="cryptos" id="cryptos">
            <?php foreach($data["cryptos"] as $crypto): ?>
                    
                    <option value="<?php echo  $crypto->code?>">
                        <?php echo $crypto->code ?>
                    </option>
            <?php endforeach; ?>
            </select> <br>

            Amount<input type="text" name = "amount"> <br>
            <input type="submit" value="Submit" name = "action">
        </form>

     
    </body>
</html>