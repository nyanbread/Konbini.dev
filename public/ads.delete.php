<?php

	require "../utils/Input.php";
    require "../models/Ad.php";
    require_once "../db_connect.php";

    session_start();

    print_r($_GET);
    $deletead = new Ad();
    if ($_SESSION['is_logged_in'] == true && $_GET['delete'] == 'yes')
    {
    	$deletead->id = $_GET['itemid'];
    	$deletead->rmthing($dbc);
    	header("Location: /ads.index.php");
    }
    else
    {
    	header("Location: /ads.index.php");
    }


?>