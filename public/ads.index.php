<?php

require "../db_connect.php";
require "../models/Ad.php";
require_once "../views/partials/navbar.php";

session_start();

if (!isset($_GET['page']) && !isset($_GET['limit']))
{
	$idstart = 1;
}
else
{
	$idstart = $_GET['page']*$_GET['limit'];
}
if (!isset($_GET['limit']))
{
	$_GET['limit'] = 10;
}
if (!isset($_GET['page']))
{
	$_GET['page'] = 0;
}
$listads = new Ad();
$startads = $listads::baselist($dbc, $_GET['limit'], $idstart);
function adsArray($startads)
{
	for ($i=0; $i < count($startads); $i++) { 
		$ads[$i] = $startads[$i];
	}
	return $ads;
}
function adsList($adsin)
{
	$i = 0;
	while ($i < count($adsin))
	{
		$adsnum = $adsin[$i]['id'];
		$adsout[$i] = "<div id='ad" . $adsnum . "' class='adcontainer font2'><div class='triangle-right'></div><img class='imageadslist' src='" . $adsin[$i]["img_url_main"] . "'><div class='adstextcontainer'><div class='adname fontlarge'><a href='?itemid=" . $adsin[$i]["id"] . "'>".$adsin[$i]["item"]."</a></div><div class='fontmedium'> From: <a href='?user=1'>". $adsin[$i]['user'] ."</a></div><div class='addescription fontmidsmall'>".
		$adsin[$i]["description"]."</div></div></div>";
		$i++;
	}
	return $adsout;

}
$testads = adsArray($startads);
$realads = adsList($testads);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Konbini, The World's Premire Online Store for all things Japanese</title>
	<link rel="stylesheet" href="/css/main.css">
	<link rel="stylesheet" href=<?= $cssnav ?>>
	<link rel="stylesheet" href="/css/list.css">
</head>
<body>
	<?= $contentnav ?>
	<main>
		<?php
			for ($i=0; $i < count($realads); $i++)
			{
				echo $realads[$i];
			}
		 ?>
	</main>
	<script src="/js/jquery-1.12.0.js"></script>
	<script src="/js/jquery-ui.min.js"></script>
	<script type="text/javascript" src="/js/main.js"></script>
</body>
</html>
