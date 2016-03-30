<?php
define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'konbini_db');
define('DB_USER', 'isurus');
define('DB_PASS', 'isurus');
require_once 'db_connect.php';
$createTableQuery = 'CREATE TABLE IF NOT EXISTS ads
(
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    user VARCHAR(150) NOT NULL,
    item VARCHAR(150) NOT NULL,
    description TEXT NOT NULL,
    price INT UNSIGNED NOT NULL,
    img_url VARCHAR(255) NOT NULL,
    PRIMARY KEY (id)
)';
$dbc->exec('DROP TABLE IF EXISTS ads');
$dbc->exec($createTableQuery);