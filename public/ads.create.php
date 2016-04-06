<?php
    require "../utils/Input.php";
    require "../models/Ad.php";
    require_once "../db_connect.php";
    require_once "../views/partials/navbar.php";
    require_once "../views/partials/footer.php";
    if (!empty($_POST))
    {
        $adAdd = new Ad();
        foreach ($_POST as $key => $value)
        {
            echo $key.PHP_EOL;
            if ($key != 'uploadImage')
            {
            $adAdd->$key = $value;
            }
        }
        foreach ($_FILES as $key => $value)
        {
            if ($_FILES[$key]['name'] !== '')
            {
                Input::getImage($_FILES[$key]);
                echo $key;
                $directory = "img/uploads/ads/";
                $targetImage = $directory . basename($_FILES[$key]['name']);
                $adAdd->$key = $targetImage;
            }
        }
        $adAdd->savenew($dbc);
    }
    if(!$_SESSION["is_logged_in"])
    {
        header("Location: /ads.index.php");
    }
$footer = new Footer();
$footer->userControls($_SESSION['user']);
?>
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
            	<form class="formcontainer" method="POST" enctype="multipart/form-data" action="/ads.create.php">
                        <input class="font1 fontmidsmall" type="hidden" name="user" value=<?= $_SESSION['user'] ?>>
                        <input id='item' class="font1 fontmidsmall" type="text" name='item' placeholder="name">
                         <input id='price' class="font1 fontmidsmall" type="text" name='price' placeholder="price">
                         <input id='description' class="font1 fontmidsmall" type="text" name='description' placeholder="description">
                     	<input type="file" class="imginput font1 fontmidsmall" name="img_url_main" id="img1">
                        <input type="file" class="imginput font1 fontmidsmall" name="img_url_second" id="img2">
                        <input type="file" class="imginput font1 fontmidsmall" name="img_url_third" id="img3">
                     	<input type="submit" class="button font1 fontmidsmall">
                </form>
            </div>
        </div>
    </main>
    <?= $footer->getFooter() ?>
</body>
</html>