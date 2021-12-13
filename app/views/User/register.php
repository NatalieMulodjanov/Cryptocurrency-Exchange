<html>

<head>
	<title>Register</title>
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
	<div class="container d-flex">
		<div class="d-flex justify-content-center" style="flex-direction: column; width: 100%">
			<?php
			if ($data != null) {
				echo $data;
			}
			?>
			<a style="text-decoration: none; font-size: 20px; font-weight: bold" href="<?= BASE ?>/User/login"> <i class="fa fa-arrow-left fa-lg" aria-hidden="true"></i> Login</a><br>
			<h1 style="font-weight: bold; margin-bottom: 20px; margin-top: 20px;" class="d-flex justify-content-center">
				Register a new user
			</h1>

			<form action='' method='post' style="margin: 0 auto;">
				<input class="form-control" style="width: 250px; margin-right: 10px; margin-bottom: 10px" placeholder="First name" type="text" name="first_name" />
				<input class="form-control" style="width: 250px; margin-right: 10px; margin-bottom: 10px" placeholder="Last name" type="text" name="last_name" />
				<input class="form-control" style="width: 250px; margin-right: 10px; margin-bottom: 10px" placeholder="Date of birth" type="text" name='dob' />
				<input class="form-control" style="width: 250px; margin-right: 10px; margin-bottom: 10px" placeholder="Email" type="text" name="email" />
				<input class="form-control" style="width: 250px; margin-right: 10px; margin-bottom: 10px" placeholder="Password" type="password" name="password" />
				<input class="form-control" style="width: 250px; margin-right: 10px; margin-bottom: 10px" placeholder="Password confirmation:" type="password" name="password_confirm" />
				<input class="form-control" style="width: 250px; margin-right: 10px; margin-bottom: 10px" placeholder="Referral Code:" type="password" name="referral_code" />
				<input style="text-align:center; margin: 0 auto; padding-right: 30px; padding-left: 30px" class="btn btn-success d-flex justify-content-center" type="submit" name="action" value="Register" />
			</form>
		</div>
	</div>

</body>

</html>