<?php
    require "../utils/Input.php";
    require "../models/Ad.php";
    require_once "../db_connect.php";
    require_once "../views/partials/navbar.php";
    require_once "../views/partials/footer.php";
    if (!empty($_POST))
    {
        $adAdd = new Ad();
        print_r($_POST);
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
            	<form method="POST" enctype="multipart/form-data" action="/ads.create.php">
                	<div class="form-group">
                        <input type="hidden" name="user" value=<?= $_SESSION['user'] ?>>
                    	<label for="item">Name of the Item: </label>
                        <input id='item' type="text" name='item' placeholder="name">
                    </div>
                     <div class="form-group">
                         <label for="price">Buyout Amount: </label>
                         <input id='price' type="text" name='price' placeholder="price">
                     </div>
                     <div class="form-group">
                         <label for="description">Description of Item: </label>
                         <input id='description' type="text" name='description' placeholder="description">
                     </div>
                     <div class="image-insert">
                     	<input type="file" name="img_url_main" id="img1">
                        <input type="file" name="img_url_second" id="img2">
                        <input type="file" name="img_url_third" id="img3">
                     	<input type="submit" class="button">
                     </div>
                </form>
            </div>
        </div>
    </main>
    <?= $footer->getFooter() ?>
</body>
</html>