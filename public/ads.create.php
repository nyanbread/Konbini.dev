<?php
    require "../utils/Input.php";
    require "../models/Ad.php";
    require "../db_connect.php";
    session_start();
    var_dump($_POST);
    var_dump($_SESSION);
    var_dump($_FILES);
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
    echo "BREAK";


?>
<html>
<head>
	<title>Create a Listing!</title>
</head>
<body>
	<h1>Create a Listing!</h1>
	<form method="POST" enctype="multipart/form-data" action="/ads.create.php">

    	<div class="form-group">
            <input type="hidden" name="user" value="Yeasayer">
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
</body>
</html>