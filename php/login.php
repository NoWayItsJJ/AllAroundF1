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
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	</head>
	<body>
		<form id="emailForm" action="" method="post">
			<input type="email" id="email" name="email" placeholder="Email" />
			<input type="password" name="password" id="password" placeholder="Password" style="display: none" />
			<button id="confirmEmail">Continua</button>
			<button id="confirmPassword" style="display: none">Continua</button>
		</form>
	</body>
	<script src="../js/login.js"></script>
</html>
