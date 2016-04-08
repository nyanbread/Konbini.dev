<?php

	require_once "../db_connect.php";
	require_once "../views/partials/navbar.php";
	require_once "../views/partials/footer.php";
	require "../utils/Auth.php";
	require "../models/User.php";
	$find = new User();
	if (!empty($_POST))
	{
	$iduser = $find::findname($_POST['user'], $dbc);
	}
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
	$footer = new Footer();
	$footer->userControls($_SESSION['user']);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Konbini, The World's Premire Online Store for all things Japanese</title>
	<link rel="stylesheet" href="/css/list.css">
	<link rel="stylesheet" href="/css/main.css">
	<link rel="stylesheet" href=<?= $cssnav ?>>
	<link rel="stylesheet" href=<?= $footer->footcss ?>>
</head>
<body>
	<?= $contentnav ?>
	<main>
		<div id="loginmargin" class="mainadscontainer">
			<div class='adcontainerfail font1'>
				<form method="POST" enctype="multipart/form-data" action="/auth.login.php" class='formcontainer'>
					<input class="font1 fontsmall" type="text" name="user" placeholder="Username">
					<input class="font1 fontsmall" type="password" name="password" placeholder="Password">
					<input class="font1 fontsmall subbutton" type="submit" value="Login">
				</form>
			</div>
			<div class='adcontainerfail font1 fontcenter'>
				<p class='fontsmall'>Don't have an account?<br>Make one <a href='/auth.makeacc.php'>Today</a></p>
			</div>
		</div>
	</main>
	<?= $footer->getFooter() ?>
</body>
</html>