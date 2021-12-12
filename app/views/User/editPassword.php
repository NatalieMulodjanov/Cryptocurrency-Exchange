<html>

<head>
	<title>Edit Password</title>
</head>

<body>
	<a href="<?= BASE ?>/User/login">return</a><br>
	Edit Password <br>

	<?php 
		if (isset($data['error'])) {
			echo $data['error'];
		}
	
	?>
		
	<form action='' method='post'>
		Email: <input type='text' name='email' /><br>
		New Password: <input type='password' name='password' /><br>
		New Password confirmation: <input type='password' name='password_confirm' /><br>
		<input type='submit' name='action' value='Edit' />
	</form>

</body>

</html>