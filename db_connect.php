<?php
	define('DB_HOST', '127.0.0.1');
	define('DB_NAME', 'konbini_db');
	define('DB_USER', 'isurus');
	define('DB_PASS', 'isurus');
	$dbc = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
	$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?> 