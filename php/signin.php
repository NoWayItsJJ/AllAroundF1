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

		<link rel="stylesheet" type="text/css" href="../css/login.css">
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
					<p>Passaggio 1 di 2</p>
					<h1>Crea un account</h1>
					<p>Hai già un account? <a class="link" href="./login.php">Accedi</a></p>
					<form id="firstSigninForm" action="" method="post">
						<div class="input-email">
							<label for="email">Indirizzo e-mail</label>
							<input type="email" id="email" name="email" placeholder="Email" />
							<label for="password">Password</label>
							<input type="password" id="password" name="password" placeholder="Password" />
						</div>
						<button id="confirmFirstStep" class="button-primary">Continua</button>
					</form>
				</div>
				<div class="line"><div><span>Oppure</span></div></div>
				<div class="other-login">
					<button id="googleLogin"><img src="../img/logo/google.png" alt="">Accedi con Google</button>
					<button id="facebookLogin"><img src="../img/logo/facebook.png" alt="">Accedi con Facebook</button>
					<button id="appleLogin"><img src="../img/logo/apple.png" alt="">Accedi con Apple</button>
				</div>
			</div>
			<div id="card-more-info" class="card" style="display: none;">
				<div class="card-content">
					<p>Passaggio 2 di 2</p>
					<h1>Crea un account</h1>
					<p>Hai già un account? <a class="link" href="./login.php">Accedi</a></p>
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
						<div class="input-email">
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
