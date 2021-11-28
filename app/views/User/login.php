<html>

<head>
	<title>Login</title>
</head>

<body>
	<?php
	if ($data != null) {
		echo $data;
	}
	?>
	<a href="<?= BASE ?>/User/register">Create a new User</a><br>
	Login
	<form action='' method='post'>
		Email: <input type='text' name='email' /><br>
		Password: <input type='password' name='password' /><br>
		<input type='submit' name='action' value='Login' />
	</form>

</body>

</html>