<?php
	$dbc = NEW PDO('mysql:host=127.0.0.1;dbname=konbini_db', "isurus", "isurus");
	$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$ads = [];
	$query = "INSERT INTO konbini_db (id, user, item, description, price, img_url) 
				VALUES (:id, :user, :item, :description, :price, :img_url)";
	$stmt = $dbc->prepare($query);
	foreach ($ads as $key => $value){
		$stmt->bindValue(":id", $value["id"], PDO::PARAM_STR);
		$stmt->bindValue(":user", $value["user"], PDO::PARAM_STR);
		$stmt->bindValue(":item", $value["item"], PDO::PARAM_STR);
		$stmt->bindValue(":description", $value["description"], PDO::PARAM_STR);
		$stmt->bindValue(":price", $value["price"], PDO::PARAM_INT);
		$stmt->bindValue(":img_url", $value["img_url"], PDO::PARAM_STR);
		$stmt->execute();
		echo "Inserted ID" . $dbc->lastInsertId() . PHP_EOL;
	}
?>
