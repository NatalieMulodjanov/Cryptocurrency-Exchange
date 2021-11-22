<html>
<head><title>Login</title></head><body>
<?php
	if($data != null){
		echo $data;
	}
?>
<a href="<?=BASE?>/Account/register">Create a new User</a><br>
Login
<form action='' method='post'>
	Username: <input type='text' name='username' /><br>
	Password: <input type='password' name='password' /><br>
	<input type='submit' name='action' value='Login' />
</form>

</body></html>