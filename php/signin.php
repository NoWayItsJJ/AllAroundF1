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
		<form id="firstSigninForm" action="" method="post">
			<input type="email" id="email" name="email" placeholder="Email" />
			<input type="password" id="password" name="password" placeholder="Password" />
			<button id="confirmFirstStep" href="#">Continua</button>
		</form>
        <form id="secondSigninForm" action="" method="post" style="display: none;">
			<input type="text" id="name" name="name" placeholder="Name" />
			<input type="text" id="surname" name="surname" placeholder="Surname"/>
			<input type="text" id="address" name="address" placeholder="Address"/>
			<input type="text" id="city" name="city" placeholder="City"/>
			<input type="number" id="cap" name="cap" placeholder="Cap"/>
			<input type="text" id="state" name="state" placeholder="State"/>
			<button id="confirmSignin" href="#">Continua</button>
		</form>
	</body>
	<script src="../js/signin.js"></script>
</html>
