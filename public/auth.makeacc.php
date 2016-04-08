<?php
	require "../utils/Input.php";
    require "../models/User.php";
    require_once "../db_connect.php";
    require_once "../views/partials/navbar.php";
    require_once "../views/partials/footer.php";

    if (!empty($_POST))
    {
        $userAdd = new User();
        foreach ($_POST as $key => $value)
        {
        	if (!is_numeric($value))
        	{
        		$userAdd->$key = Input::getString($value);
        	}
        	else
        	{
        		$userAdd->$key = Input::getNumber($value);
        	}
        }
        $userAdd->savenew($dbc);
        header("Location: /auth.login.php");
    }

    $footer = new Footer();
	$footer->userControls($_SESSION['user']);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Create a Listing!</title>
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/list.css">
    <link rel="stylesheet" href=<?= $cssnav ?>>
    <link rel="stylesheet" href=<?= $footer->footcss ?>>
</head>
<body>
    <?= $contentnav ?>
    <main>
    	<div id="loginmargin" class="mainadscontainer">
            <div class='adcontainerfail font1'>
            	<form class="formcontainer" method="POST" enctype="multipart/form-data" action="/auth.makeacc.php">
            		<input class="font1 fontmidsmall" type="hidden" name="userlevel" value="2">
            		<input id='item' class="font1 fontmidsmall" type="text" name='user' placeholder="Username">
            		<input id='item' class="font1 fontmidsmall" type="password" name='password' placeholder="Password">
            		<input id='item' class="font1 fontmidsmall" type="text" name='e_mail' placeholder="E-mail Address">
            		<input id='item' class="font1 fontmidsmall" type="text" name='location' placeholder="Where do you live?">
            		<input type="submit" class="button font1 fontmidsmall">
            	</form>
            </div>
        </div>
    </main>
    <?= $footer->getFooter() ?>
</body>
</html>