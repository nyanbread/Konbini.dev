<?php

require "../db_connect.php";
require "../models/Ad.php";
require_once "../views/partials/navbar.php";
require_once "../views/partials/footer.php";

/* Ghetto JSON */

if (!isset($_GET['page']) or $_GET["page"] < 0)
{
	$_GET['page'] = 0;
}
if (!isset($_GET["itemid"]))
{
	if ($_GET["page"] > 0)
	{
		$idstart = 1+$_GET["page"]*10;
	}
	else
	{
		$idstart = 1;
	}
}
else
{
	$responseText = $_GET["itemid"];
	$idstart = $_GET['itemid'];
	$_GET['limit'] = 1;
}
if (!isset($_GET['limit']))
{
	$_GET['limit'] = 10;
}
$listads = new Ad();
if (isset($_GET['user']))
{
	$startads = $listads::findbyuser($dbc,$_GET['user'],$idstart);
}
elseif (!isset($_GET['item']))
{
	$startads = $listads::baselist($dbc, $_GET['limit'], $idstart);
}
else
{
	$startads = $listads::findbyitem($dbc,$_GET['item']);
}
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
		if (count($adsin) > 1)
		{
			$adsprice = "$".number_format((float)$adsin[$i]["price"], 2, '.', '');
			$adsnum = $adsin[$i]['id'];
			$adsout[$i] = "<div id='ad" . $adsnum . "' class='adcontainer font1'><div class='triangle-right'></div><img class='imageadslist' src='" . $adsin[$i]["img_url_main"] . "'><div class='adstextcontainer'><div class='adname fontlarge'><a href='?itemid=" . $adsin[$i]["id"] . "'>".$adsin[$i]["item"]."</a></div><div class='fontmedium'> From: <a href='?user=".$adsin[$i]['user']."'>". $adsin[$i]['user'] ."</a></div><div class='addescription fontmidsmall'>".
			$adsin[$i]["description"]."</div><div class='pricecontiner'>Price: ". $adsprice ."</div></div></div>";
			$i++;
		}
		else
		{
			$adsprice = "$".number_format((float)$adsin[$i]["price"], 2, '.', '');
			$adsnum = $adsin[$i]['id'];
			if (!empty($adsin[$i]['img_url_second']) && !empty($adsin[$i]['img_url_third']))
			{	
			$adsout[$i] = "<div id='ad" . $adsnum . "' class='adcontainerfail lazysolomargin font1'><div id=imageadscontainer><img class='imageadssolo imageadsdisplayed' src='" . $adsin[$i]["img_url_main"] . "'><img class='imageadssolo imageadshidden' src='" . $adsin[$i]["img_url_second"] . "'><img class='imageadssolo imageadshidden' src='" . $adsin[$i]["img_url_third"] . "'></div><div id='adsimgmodal'><img class='imageadssolomodal imageadssoloborder' src='" . $adsin[$i]["img_url_main"] . "'><img class='imageadssolomodal' src='" . $adsin[$i]["img_url_second"] . "'><img class='imageadssolomodal' src='" . $adsin[$i]["img_url_third"] . "'></div><div class='stuffseperator'></div><div class='adstextcontainersolo'><div class='adname fontlarge'>".$adsin[$i]["item"]."</div><div class='fontmedium'> From: <a href='?user=".$adsin[$i]['user']."'>". $adsin[$i]['user'] ."</a></div><div class='addescription fontmidsmall'>".
			$adsin[$i]["description"]."</div><div class='pricecontiner'>Price: ". $adsprice ."</div></div></div>";
			}
			elseif (empty($adsin[$i]['img_url_third']) && !empty($adsin[$i]['img_url_second']))
			{
				$adsout[$i] = "<div id='ad" . $adsnum . "' class='adcontainerfail lazysolomargin font1'><div id=imageadscontainer><img class='imageadssolo imageadsdisplayed' src='" . $adsin[$i]["img_url_main"] . "'><img class='imageadssolo imageadshidden' src='" . $adsin[$i]["img_url_second"] . "'></div><div id='adsimgmodal'><img class='imageadssolomodal imageadssoloborder' src='" . $adsin[$i]["img_url_main"] . "'><img class='imageadssolomodal' src='" . $adsin[$i]["img_url_second"] . "'></div><div class='stuffseperator'></div><div class='adstextcontainersolo'><div class='adname fontlarge'>".$adsin[$i]["item"]."</div><div class='fontmedium'> From: <a href='?user=".$adsin[$i]['user']."'>". $adsin[$i]['user'] ."</a></div><div class='addescription fontmidsmall'>".
			$adsin[$i]["description"]."</div><div class='pricecontiner'>Price: ". $adsprice ."</div></div></div>";
			}
			elseif (!empty($adsin[$i]['img_url_third']) && empty($adsin[$i]['img_url_second']))
			{
				$adsout[$i] = "<div id='ad" . $adsnum . "' class='adcontainerfail lazysolomargin font1'><div id=imageadscontainer><img class='imageadssolo imageadsdisplayed' src='" . $adsin[$i]["img_url_main"] . "'><img class='imageadssolo imageadshidden' src='" . $adsin[$i]["img_url_third"] . "'></div><div id='adsimgmodal'><img class='imageadssolomodal imageadssoloborder' src='" . $adsin[$i]["img_url_main"] . "'><img class='imageadssolomodal' src='" . $adsin[$i]["img_url_third"] . "'></div><div class='stuffseperator'></div><div class='adstextcontainersolo'><div class='adname fontlarge'>".$adsin[$i]["item"]."</div><div class='fontmedium'> From: <a href='?user=".$adsin[$i]['user']."'>". $adsin[$i]['user'] ."</a></div><div class='addescription fontmidsmall'>".
			$adsin[$i]["description"]."</div><div class='pricecontiner'>Price: ". $adsprice ."</div></div></div>";
			}
			else
			{
				$adsout[$i] = "<div id='ad" . $adsnum . "' class='adcontainerfail lazysolomargin font1'><div id=imageadscontainer><img class='imageadssolo imageadsdisplayed' src='" . $adsin[$i]["img_url_main"] . "'><div class='stuffseperator'></div><div class='adstextcontainersolo'><div class='adname fontlarge'>".$adsin[$i]["item"]."</div><div class='fontmedium'> From: <a href='?user=".$adsin[$i]['user']."'>". $adsin[$i]['user'] ."</a></div><div class='addescription fontmidsmall'>".
			$adsin[$i]["description"]."</div><div class='pricecontiner'>Price: ". $adsprice ."</div></div></div>";
			}
			$i++;
		}
	}
	return $adsout;

}
if (!is_null($startads))
{
	$testads = adsArray($startads);
	$realads = adsList($testads);
	$adsexist = true;

}
else
{
	$realads[0] = "<div class='adcontainerfail font2'><img class='imgoops' src='/img/site/shrug.gif'><div class='failtext font1 fontlarge fontcenter'>OOPS!<br>We couldn't find what you're looking for dude.</div></div>";
	$adsexist = false;
}
$footer = new Footer();
$footer->userControls();
if (count($realads) == 1 and $adsexist == true)
{
	echo $testads[0]['user'];
	$footer->editcheck($_SESSION['user'], $testads[0]['user']);
}
function pageController()
{
	if (!isset($_GET["page"]))
	{
		$_GET["page"] = 0;
	}
	if ($_GET["page"] < 0)
	{
		$_GET["page"] = 0;
	}
	return $_GET;
}
extract(pageController());
?>
<!DOCTYPE html>
<html>
<head>
	<title>Konbini, The World's Premire Online Store for all things Japanese</title>
	<link rel="stylesheet" href="/css/main.css">
	<link rel="stylesheet" href=<?= $cssnav ?>>
	<link rel="stylesheet" href=<?= $footer->footcss ?>>
	<link rel="stylesheet" href="/css/list.css">
</head>
<body>
	<?= $contentnav ?>
	<main>
		<div class="mainadscontainer">
			<?php
				$range = (count($realads));
				for ($i=0; $i < $_GET["limit"]; $i++)
				{
					if ($i >= $range)
					{
						$endposts = true; 
						break;
					}
					else
					{
						echo $realads[$i];
						$endposts = false;
					}
						
				}
			 ?>
		</div>
		<?php
			if (!isset($_GET["itemid"]))
			{
				if (isset($_GET["user"]))
				{
					if($_GET['page'] > 0 and $endposts == false)
					{
						echo '<div class="link-container font1 fontmidsmall"><a href="/ads.show.php?page='. ($page - 1) .'&user='.$_GET['user'].'"><button class="pagelink font1 fontmidsmall">Previous Page</button></a>'.'<a href="/ads.show.php?page='. ($page + 1). '&user='.$_GET['user'].'"><button class="pagelink font1 fontmidsmall">Next Page</button></a></div>';
					}
					elseif($_GET["page"] > 0 and $endposts == true)
					{
						echo '<div class="link-container font1 fontmidsmall"><a href="/ads.show.php?page='. ($page - 1) .'&user='.$_GET['user'].'"><button class="pagelink font1 fontmidsmall">Previous Page</button></a></div>';
					}
					elseif($endposts == false)
					{	
						echo '<div class="link-container"><a href="/ads.show.php?page='. ($page + 1). '&user='.$_GET['user'].'"><button class="pagelink font1 fontmidsmall">Next Page</button></a></div>';
					}
				}
				else
				{
					if($_GET['page'] > 0 and $endposts == false)
					{
						echo '<div class="link-container font1 fontmidsmall"><a href="/ads.show.php?page='. ($page - 1) .'"><button class="pagelink font1 fontmidsmall">Previous Page</button></a>'.'<a href="/ads.show.php?page='. ($page + 1). '"><button class="pagelink font1 fontmidsmall">Next Page</button></a></div>';
					}
					elseif($_GET["page"] > 0 and $endposts == true)
					{
						echo '<div class="link-container font1 fontmidsmall"><a href="/ads.show.php?page='. ($page - 1) .'"><button class="pagelink font1 fontmidsmall">Previous Page</button></a></div>';
					}
					elseif($endposts == false)
					{	
						echo '<div class="link-container"><a href="/ads.show.php?page='. ($page + 1). '"><button class="pagelink font1 fontmidsmall">Next Page</button></a></div>';
					}
			}	}
		?>
		<div id='response'><?= $responseText ?></div>
	</main>
	<?= $footer->getFooter() ?>
	<script src="/js/jquery-1.12.0.js"></script>
	<script src="/js/jquery-ui.min.js"></script>
	<script type="text/javascript" src="/js/main.js"></script>
</body>
</html>
