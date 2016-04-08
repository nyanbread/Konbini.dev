<?php

require_once "../db_connect.php";
require_once "../views/partials/navbar.php";
require_once "../views/partials/footer.php";
require "../models/Ad.php";

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
			$realads[$i] = "<div id='modalad" . $modalthing . "' class='modaladscontainer font1 fontcenter'><img class='modalimageauto' src='" . $ads[$i]["img_url_main"] . "'><div class='modaltextcontainer'><div class='adname fontlarge'><a href=/ads.show.php?itemid=" . $ads[$i]["id"] . ">".$ads[$i]["item"]."</a></div><div class='fontmedium'>Courtesy of <a href='?user=1'>".$ads[$i]["user"]."</a></div><div class='modaladdescription fontmidsmall'>".substr($ads[$i]["description"],0,128)."...</div></div></div>";
		}
		else
		{
			$realads[$i] = "<div id='modalad". $modalthing ."' class='modaladscontainer font1 fontcenter'><img class='modalimageauto' src='". $ads[$i]["img_url_main"] ."'><div class='modaltextcontainer'><div class='adname fontlarge'><a href=/ads.show.php?itemid=".$ads[$i]["id"].">".$ads[$i]["item"].
			"</a></div><div class='fontmedium'>Courtesy of <a href=/ads.show.php?user=".$ads[$i]["user"].">".$ads[$i]["user"]."</a></div><div class='modaladdescription fontmidsmall'>".
			$ads[$i]["description"]."</div></div></div>";
		}
		$i++;
	}
	return $realads;
}
$modalads = adsArray($premainads);
$realmodalads = adsmodalarray($modalads);
$footer = new Footer();
$footer->userControls();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Konbini, The World's Premire Online Store for all things Japanese</title>
	<link rel="stylesheet" href="/css/main.css">
	<link rel="stylesheet" href=<?= $cssnav ?>>
	<link rel="stylesheet" href=<?= $footer->footcss ?>>
</head>
<body>
	<?= $contentnav ?>
	<main>
		<div id="intromodal">
			<video autoplay loop id="bgvid">
    			<source src="/videos/edm2.webm" type="video/webm">
    			<source src="/videos/free-loops_EDM_Triangles_Background_6_Slow.mp4" type="video/mp4">
			</video>
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
			<div id="modalcoverbottomleft"></div>
		</div>
	</main>
	<?= $footer->getFooter() ?>
	<script src="/js/jquery-1.12.0.js"></script>
	<script src="/js/jquery-ui.min.js"></script>
	<script type="text/javascript" src="/js/main.js"></script>
</body>
</html>
