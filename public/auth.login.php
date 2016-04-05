<?php

	require_once "../db_connect.php";
	require_once "../views/partials/navbar.php";
	require "../utils/Auth.php";
	require "../models/User.php";
	$find = new User();
	$iduser = $find::findname($_POST['user'], $dbc);
	if (!empty($iduser))
	{
		$hashedpass = $iduser['password'];
		$compare = new Auth();
		$compare::attempt($iduser['user'], $_POST['password'], $hashedpass);
	}
	if ($_SESSION['is_logged_in'] == true)
	{
		header("Location: /ads.index.php");
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Konbini, The World's Premire Online Store for all things Japanese</title>
	<link rel="stylesheet" href="/css/list.css">
	<link rel="stylesheet" href="/css/main.css">
	<link rel="stylesheet" href=<?= $cssnav ?>>
</head>
<body>
	<?= $contentnav ?>
	<main>
		<div id="loginmargin" class="mainadscontainer">
			<div class='adcontainerfail font1'>
				<form method="POST" enctype="multipart/form-data" action="/auth.login.php" class='formcontainer'>
					<input type="text" name="user" placeholder="Username">
					<input type="text" name="password" placeholder="Password">
					<input type="submit" class="button">
				</form>
			</div>
		</div>
	</div>
</body>
</html>