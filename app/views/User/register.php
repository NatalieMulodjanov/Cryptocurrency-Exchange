<html>

<head>
	<title>Register</title>
</head>

<body>
	<a href="<?= BASE ?>/Account/login">return</a><br>
	Register a new user
	<form action='' method='post'>
		First name: <input type='text' name='first_name' /><br>
		Last name: <input type='text' name='last_name' /><br>
		Date of birth: <input type='text' name='dob' /><br>
		Email: <input type='text' name='email' /><br>
		Password: <input type='password' name='password' /><br>
		Password confirmation: <input type='password' name='password_confirm' /><br>
		<input type='submit' name='action' value='Register' />
	</form>

</body>

</html>