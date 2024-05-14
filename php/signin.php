<?php
session_start();
if(isset($_SESSION['user_id'])) {
    header('Location: account.php');
    exit;
}
?>
<html>
	<head>
		<title>Sign up</title>
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
			<div id="card-email-password" class="card">
				<div class="card-content">
					<p>Step 1 of 2</p>
					<h1>Create an account</h1>
					<p>Already have an account? <a class="link" href="./login.php">Sign in</a></p>
					<form id="firstSigninForm" action="" method="post">
						<div class="input-email email-password">
							<div class="width-100">
								<label for="email">Email address</label>
								<div class="email-row">
									<input type="email" id="email" name="email" />
									<i id="emailErrorIcon" class="bi bi-exclamation-triangle" style="display: none;"></i>
									<i id="emailCorrectIcon" class="bi bi-check" style="display: none;"></i>
								</div>
								<span id="emailError" class="invalid"></span>
							</div>
							<div class="width-100">
								<label for="password">Password</label>
								<div class="email-row">
									<input type="password" id="password" name="password" />
									<i class="bi bi-eye-slash"></i>
								</div>
								<span id="passwordError" class="invalid"></span>
								<div id="passwordCriteria"></div>
							</div>
						</div>
						<button id="confirmFirstStep" class="button-primary">Continue</button>
					</form>
				</div>
				<div class="line"><div><span>Or</span></div></div>
				<div class="other-login">
					<button id="googleLogin"><img src="../img/logo/google.png" alt="">Continue with Google</button>
					<button id="facebookLogin"><img src="../img/logo/facebook.png" alt="">Continue with Facebook</button>
					<button id="appleLogin"><img src="../img/logo/apple.png" alt="">Continue with Apple</button>
				</div>
			</div>
			<div id="card-more-info" class="card" style="display: none;">
				<div class="card-content">
					<p>Step 2 of 2</p>
					<h1>Create an account</h1>
					<p>Already have an account? <a class="link" href="./login.php">Sign in</a></p>
					<div class="user-info">
						<div class="user-img">
							<img id="user-img" src="" alt="">
							<input type="file" id="fileInput" style="display: none;">
							<div class="overlay" onclick="document.getElementById('fileInput').click()">
								<i class="bi bi-plus"></i>
							</div>
						</div>
						<p id="user-email"></p>
					</div>
					<form id="secondSigninForm" action="" method="post">
						<div class="input-email email-password">
							<div class="row">
								<div class="width-100">
									<label for="name">Name</label>
									<input type="text" id="name" name="name" placeholder="Name" />
								</div>
								<div class="width-100">
									<label for="surname">Surname</label>
									<input type="text" id="surname" name="surname" placeholder="Surname"/>
								</div>
							</div>
							<div class="width-100">
								<label for="birthdate">Birthdate</label>
								<input type="date" id="birthdate" name="birthdate"/>
							</div>
							<div class="width-100">
								<label for="address">Address</label>
								<input type="text" id="address" name="address" placeholder="Address"/>
							</div>
							<div class="row">
								<div class="width-100">
									<label for="city">City</label>
									<input type="text" id="city" name="city" placeholder="City"/>
								</div>
								<div class="width-100">
									<label for="cap">Cap</label>
									<input type="text" id="cap" name="cap" placeholder="Cap"/>
								</div>
							</div>
							<div class="width-50">
								<label for="state">State</label>
								<input type="text" id="state" name="state" placeholder="State"/>
							</div>
						</div>
						<button id="confirmSignin" class="button-primary">Continua</button>
					</form>
				</div>
			</div>
		</div>
	</body>
	<script src="../js/signin.js"></script>
</html>
