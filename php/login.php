<?php
session_start();
if(isset($_SESSION['user_id'])) {
    header('Location: account.php');
    exit;
}
?>
<html>
	<head>
		<title>Login</title>
		<link rel="icon" href="../img/logo/white-horse.svg" type="image/x-icon">

		<link rel="stylesheet" type="text/css" href="../css/login-signup.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	</head>
	<body>
		<div class="left-side">
			<img id="greyhorse" src="../img/logo/grey-horse.svg" alt="">
			<img id="car" src="../img/car/car.png" alt="">
		</div>
		<div class="right-side">
			<div id="card-email" class="card">
				<div class="card-content">
					<h1>Sign in</h1>
					<p>New user? <a class="link" href="./signin.php">Create an account</a></p>
					<form id="emailForm" action="" method="post">
						<div class="input-email">
							<label for="email">Email address</label>
							<div class="email-row">
								<input type="email" id="email" name="email" />
								<i id="emailErrorIcon" class="bi bi-exclamation-triangle" style="display: none;"></i>
							</div>
							<span id="emailError" class="invalid"></span>
						</div>
						<button id="confirmEmail" class="button-primary">Continue</button>
					</form>
				</div>
				<div class="line"><div><span>Or</span></div></div>
				<div class="other-login">
					<button id="googleLogin"><img src="../img/logo/google.png" alt="">Continue with Google</button>
					<button id="facebookLogin"><img src="../img/logo/facebook.png" alt="">Continue with Facebook</button>
					<button id="appleLogin"><img src="../img/logo/apple.png" alt="">Continue with Apple</button>
				</div>
			</div>
			<div id="card-password" class="card" style="display: none;">
				<div class="card-content">
					<h1>Welcome back</h1>
					<div class="user-info">
						<div class="user-img">
							<img id="user-img" src="" alt="">
						</div>
						<p id="user-email"></p>
					</div>
					<form id="passwordForm" action="" method="post">
						<div class="input-email">
							<label for="password">Password</label>
							<div class="email-row">
								<input type="password" id="password" name="password" />
								<i class="bi bi-eye-slash"></i>
							</div>
							<span id="passwordError" class="invalid"></span>
						</div>
						<button id="confirmPassword" class="button-primary">Continue</button>
					</form>
				</div>
				<div class="line"><div><span>Or</span></div></div>
				<div class="other-login">
					<button id="googleLogin"><img src="../img/logo/google.png" alt="">Continue with Google</button>
					<button id="facebookLogin"><img src="../img/logo/facebook.png" alt="">Continue with Facebook</button>
					<button id="appleLogin"><img src="../img/logo/apple.png" alt="">Continue with Apple</button>
				</div>
			</div>
		</div>
	</body>
	<script src="../js/login.js"></script>
</html>
