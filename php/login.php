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

		<link rel="stylesheet" type="text/css" href="../css/login.css">
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
					<h1>Accedi</h1>
					<p>Nuovo utente? <a class="link" href="./signin.php">Crea un Account</a></p>
					<form id="emailForm" action="" method="post">
						<div class="input-email">
							<label for="email">Indirizzo e-mail</label>
							<input type="email" id="email" name="email" />
						</div>
						<button id="confirmEmail" class="button-primary">Continua</button>
					</form>
				</div>
				<div class="line"><div><span>Oppure</span></div></div>
				<div class="other-login">
					<button id="googleLogin"><img src="../img/logo/google.png" alt="">Accedi con Google</button>
					<button id="facebookLogin"><img src="../img/logo/facebook.png" alt="">Accedi con Facebook</button>
					<button id="appleLogin"><img src="../img/logo/apple.png" alt="">Accedi con Apple</button>
				</div>
			</div>
			<div id="card-password" class="card" style="display: none;">
				<div class="card-content">
					<h1>Siamo lieti di rivederti</h1>
					<div class="user-info">
						<img id="user-img" src="" alt="">
						<p id="user-email"></p>
					</div>
					<form id="passwordForm" action="" method="post">
						<div class="input-email">
							<label for="password">Password</label>
							<input type="password" id="password" name="password" />
						</div>
						<button id="confirmPassword" class="button-primary">Continua</button>
					</form>
				</div>
				<div class="line"><div><span>Oppure</span></div></div>
				<div class="other-login">
					<button id="googleLogin"><img src="../img/logo/google.png" alt="">Accedi con Google</button>
					<button id="facebookLogin"><img src="../img/logo/facebook.png" alt="">Accedi con Facebook</button>
					<button id="appleLogin"><img src="../img/logo/apple.png" alt="">Accedi con Apple</button>
				</div>
			</div>
		</div>
	</body>
	<script src="../js/login.js"></script>
</html>
