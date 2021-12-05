<html>
<head>
    <title>Edit Personal Info</title>   
</head>

    <body>
        <a href="<?=BASE?>/User/settings">return</a>

        <h1>Edit Personal Info</h1>
        
        <form method="post">
            <div>
                <label>First Name</label>
                <input type="text" name="first_name" value="<?=$data->first_name?>" />
            </div>
            
            <div>
                <label>Last Name</label>
                <input type="text" name="last_name" value="<?=$data->last_name?>" />
            </div>

            <div>
                <label>Date of birth</label>
                <input type="text" name="lastName" value="<?=$data->dob?>" />
            </div>
            
            <div>
                <label>Email</label>
                <input type="text" name="email" value="<?=$data->email?>" />
            </div>

            <div>
                <input type="submit" name='action' value="Edit" />
            </div>
        </form>
    </body>
</html>