<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Matcha | Connexion</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
	<link rel="stylesheet" href="<?=$css_login?>">
</head>
<body>
	<div class="header">
		<div class="title">
			<div class="band1"></div>
			<div class="band2"></div>
			<div class="band3"></div>
			<h1 class="title-text">Matcha</h1>
		</div>
	</div>
	<div class="content">
		<div class="form login active" > 
			<div class="form-title">
				<h1 class="login-title">Login</h1>
				<div class="login-hr"></div>
			</div>
			<div class="form-item email">
				<label for="email">Email</label>
				<input type="email" class="form-input email" data-login="email" value="" placeholder="email adress">
			</div>
			<div class="form-item password">
				<label for="password">Password</label>
				<input type="password" class="form-input password" data-login="password" value="" placeholder="Password exemple">
			</div>
			<div class="form-item button">
				<a class="link-form" href="/#password_lost">Need help login?</a>
			</div>
			<div class="form-item button">
				<a class="form-input login" value="Login" data-action="login" data-event="send">Login</a>
				<a class="form-input signup" value="Sign up" data-action="register" data-event="show">Sign up</a>
			</div>
		</div>
		<div class="form register hidden">
		<div class="form-title">
				<h1 class="login-title">Register</h1>
				<div class="login-hr"></div>
			</div>
			<div class="form-item username">
				<label for="email">Create your username</label>
				<input type="text" name="text" class="form-input username" data-register="username"  value="" placeholder="AwesomeUnicorn">
			</div>
			<div class="form-item email">
				<label for="email">Email</label>
				<input type="email" name="email" class="form-input email" data-register="email"  value="" placeholder="email adress">
			</div>
			<div class="form-item name">
				<div class="small-form">
					<label for="firstname" class="name-label">First Name</label>
					<input type="text" name="firstname" class="form-input first_name" data-register="first_name"  value="" placeholder="First Name">
				</div>
				<div class="small-form">
					<label for="lastname" class="name-label">Last Name</label>
					<input type="text" name="lastname" class="form-input last_name" data-register="last_name"  value="" placeholder="Last name">
				</div>
			</div>
			<div class="form-item birthday">
				<label for="password">Bithday</label>
				<input type="date" name="date" class="form-input birthday" data-register="birthday"  value="">
			</div>
			<div class="form-item password">
				<label for="password">Password</label>
				<input type="password" name="password" class="form-input password" data-register="password"  value="" placeholder="Password exemple">
			</div>
			<div class="form-item password">
				<label for="password">Repeat Password</label>
				<input type="password" name="repeat_password" class="form-input password"  data-register="r_password"  value="" placeholder="Repeat">
			</div>
			<div class="form-item button">
				<a class="form-input login" value="Login" data-action="login" data-event="show" id="login" >Login</a>
				<a class="form-input signup" value="Sign up" data-action="register" data-event="send" id="register">Sign up</a>
			</div>
		</div>
	</div>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="<?=$js_login?>"></script>
</body>
</html>