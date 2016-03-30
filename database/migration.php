<?php
define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'konbini_db');
define('DB_USER', 'isurus');
define('DB_PASS', 'isurus');
require_once '../db_connect.php';

$arraycreate = [ 'ads'=>'CREATE TABLE IF NOT EXISTS ads
(
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    user VARCHAR(32) NOT NULL,
    item VARCHAR(150) NOT NULL,
    description TEXT NOT NULL,
    price INT UNSIGNED NOT NULL,
    img_url_main VARCHAR(255) NOT NULL,
    img_url_second VARCHAR(255),
    img_url_third VARCHAR(255),
    PRIMARY KEY (id)
)', 'users'=>'CREATE TABLE IF NOT EXISTS users
(
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    user VARCHAR(32) NOT NULL,
    password VARCHAR(255) NOT NULL,
    e_mail VARCHAR(255) NOT NULL,
    location VARCHAR(255),
    userlevel INT(2) NOT NULL,
    PRIMARY KEY (id)
)', 'posts'=>'CREATE TABLE IF NOT EXISTS posts
(
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    user VARCHAR(32) NOT NULL,
    title VARCHAR(140) NOT NULL,
    post_date VARCHAR(64) NOT NULL,
    post_content TEXT NOT NULL,
    img_url_main VARCHAR(255) NOT NULL,
    img_url_second VARCHAR(255),
    img_url_third VARCHAR(255),
    PRIMARY KEY (id)
)'];
function createtype()
{
	$tf = false;
	$arraychoice = ["ads","users","posts","all"];
	$choice = fgets(STDIN);
	for ($i=0; $i < count($arraychoice); $i++) { 
		if (trim($choice) == $arraychoice[$i])
		{
			$choice = $arraychoice[$i];
			$tf = true;
		}
	}
	if ($tf)
	{
		return $choice;
	}
	else
	{
	fwrite(STDOUT, "You did not enter a valid choice.");
	createtype();
	}
}
function maketables($choice, $array)
{
	foreach ($array as $key => $value) {
		if ($choice == $key)
		{
			return $value;
		}
	}
	return null;
}
fwrite(STDOUT,"Which table do you want to make? (ads, users, posts, or all): ");
$choice = createtype();
$createTableQuery = maketables($choice, $arraycreate);

if (strtolower($choice) !== "all")
{
	$dbc->exec('DROP TABLE IF EXISTS '. $choice);
	$dbc->exec($createTableQuery);
}
else
{
	foreach ($arraycreate as $key => $value)
	{
	$dbc->exec('DROP TABLE IF EXISTS '. $key);
	$dbc->exec($value);
	}
}