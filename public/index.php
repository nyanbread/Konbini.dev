<?php

require_once "../db_connect.php";
require_once "../views/partials/navbar.php";
require "../models/Ad.php";
session_start();

$mainads = new Ad();
$premainads = $mainads::headlist($dbc);
function adsArray($preads)
{
	for ($i=0; $i < count($preads); $i++) { 
		$ads[$i] = $preads[$i];
	}
	return $ads;
}
function adsmodalarray($ads)
{
	$i = 0;
	while ($i < count($ads)) 
	{	
		$modalthing = $i+1;
		if (strlen($ads[$i]["description"]) > 128)
		{
			$realads[$i] = "<div id='modalad" . $modalthing . "' class='modaladscontainer font1 fontcenter'><img class='modalimageauto' src='" . $ads[$i]["img_url_main"] . "'><div class='modaltextcontainer'><div class='adname fontlarge'><a href='?itemid=" . $ads[$i]["id"] . "'>".$ads[$i]["item"]."</a></div><div class='fontmedium'>Courtesy of <a href='?user=1'>".$ads[$i]["user"]."</a></div><div class='modaladdescription fontmidsmall'>".substr($ads[$i]["description"],0,128)."...</div></div></div>";
		}
		else
		{
			$realads[$i] = "<div id='modalad". $modalthing ."' class='modaladscontainer font1 fontcenter'><img class='modalimageauto' src='". $ads[$i]["img_url_main"] ."'><div class='modaltextcontainer'><div class='adname fontlarge'><a href='?itemid=".$ads[$i]["id"]."'>".$ads[$i]["item"].
			"</a></div><div class='fontmedium'>Courtesy of <a href='?user=1'>".$ads[$i]["user"]."</a></div><div class='modaladdescription fontmidsmall'>".
			$ads[$i]["description"]."</div></div></div>";
		}
		$i++;
	}
	return $realads;
}
$modalads = adsArray($premainads);
$realmodalads = adsmodalarray($modalads);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Konbini, The World's Premire Online Store for all things Japanese</title>
	<link rel="stylesheet" href="/css/main.css">
	<link rel="stylesheet" href=<?= $cssnav ?>>
</head>
<body>
	<?= $contentnav ?>
	<main>
		<div id="intromodal">
			<?php
				for ($i=0; $i < count($realmodalads); $i++)
				{ 
					echo $realmodalads[$i];
				}
			?>	
			<div id="intromodalnavcontainer">
				<img id="intromodalarrowleft" class="modalarrow" src="/img/site/Sideways_Arrow_Icon.png">
				<div id="circlecontainer">
					<div id="circle1" class="intromodalcircle"></div>
					<div id="circle2" class="intromodalcircle"></div>
					<div id="circle3" class="intromodalcircle"></div>
				</div>
				<img id="intromodalarrowright" class="modalarrow" src="/img/site/Sideways_Arrow_Icon.png">
			</div>
		</div>
		<div id="modalcoverbottomleft"></div>
		<div id="maincontent"></div>
	</main>
	<script src="/js/jquery-1.12.0.js"></script>
	<script src="/js/jquery-ui.min.js"></script>
	<script type="text/javascript" src="/js/main.js"></script>
</body>
</html>
