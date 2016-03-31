<?php

	function pageController(){
		if (isset($_SESSION['image'])){
			$postImage = $_SESSION['image']
		} else {
			$postImage = "http://placehold.it/300x300"
		}
		if (isset($_FILES['imageToUpload']['name'] != '')){
			$postImage = Input::getImage('imageToUpload');
			$_SESSION['image'] = $postImage;
		}
	}
	extract(pageController());
	var_dump($_SESSION);


?>
<html>
<head>
	<title>Create a Listing!</title>
</head>
<body>
	<h1>Create a Listing!</h1>
		<form method="POST">

	<div class="form-group">
    	<label for="item">Name of the Item: </label>
        <input id='item' type="text" name='item' value="<?php Input::get('name'); ?>">
    </div>
     <div class="form-group">
         <label for="price">Buyout Amount: </label>
         <input id='price' type="text" name='price' value="<?php Input::get('price') ?>">
     </div>

     <div class="form-group">
         <label for="description">Description of Item: </label>
         <input id='description' type="text" name='description' value="<?php Input::get('description') ?>">
     </div>

     <div class="form-group">
     	<label for="contact">Contact info: </label>
     	<input id="contact" type="text" name="contact" value="<?php Input::get('contact'); ?>">

     <div class="image-insert">
     	Upload image for product:
     	<input type="file" name="imageToUpload" id="imageToUpload">
     	<input type="submit" value="Upload Image" name="uploadImage" class="button">
     </div>
</body>
</html>