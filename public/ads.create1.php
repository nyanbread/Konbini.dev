<?php
    require "../utils/Input.php";
    require "../models/Ad.php";
    require "../db_connect.php";
    session_start();
    if (isset($_POST))
    {
        $adAdd = new Ad();
        foreach ($_FILES as $key => $value)
        {
            if ($_FILES[$key]['name'] !== '')
            {
                Input::getImage($_FILES[$key]);
            }
        }
        print_r($_POST);
        foreach ($_POST as $key => $value)
        {
            echo $key;
            $adAdd->$key = $value;
        }
        $adAdd->savenew($dbc);
    }
	var_dump($_SESSION);
    var_dump($_FILES);
    echo "BREAK";


?>
<html>
<head>
	<title>Create a Listing!</title>
</head>
<body>
	<h1>Create a Listing!</h1>
	<form method="POST" enctype="multipart/form-data" action="/ads.create1.php">

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
         	<input type="file" name="main_img_url" id="img1" value="Upload Image">
            <input type="file" name="second_img_url" id="img2" value="Upload Image">
            <input type="file" name="third_img_url" id="img3" value="Upload Image">
         	<input type="submit" value="Upload Image" name="uploadImage" class="button">
         </div>
    </form>
</body>
</html>