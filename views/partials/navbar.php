<?php
	session_start();
	function userSet()
	{
		if (!isset($_SESSION["user"]))
		{
			$_SESSION["user"] = null;
		}
		if (!isset($_SESSION['is_logged_in']))
		{
			$_SESSION['is_logged_in'] = false;
		}
	}	
	function userMessage()
	{
		if (isset($_SESSION['user']) and ($_SESSION['is_logged_in'] == true))
		{
			return "Welcome Home, ". $_SESSION["user"];
		}
		else
		{
			return "Please <a href='/auth.login.php'>Login</a>";
		}
	}
	userSet();
	$usermess = userMessage();
	$cssnav = "\"/css/navbar.css\"";
	$contentnav = '<header id="mainnav"><div id="navright"><div id="titlestuff"><img id="sitetitleimage" src="/img/site/IMG_1029.jpg"><div id="sitetitle" class="font1 fontlarge fontcenter"><a href="/ads.index.php">Konbini</a></div></div></div><div id="navbar"><div id="userecho"><p id="usertitle" class="font1 fontmedium">'.$usermess.'</p></div><div id="toplinkscontainer" class="font1 fontmedium"><div id="categories" class="toplinks"><p class="toplinkcenter">Categories</p></div><div id="stuff" class="toplinks"><a href="/ads.show.php"><p class="toplinkcenter">Stuff</p></a></div><div id="blog" class="toplinks"><p class="toplinkcenter">Blog</p></div><div id="search" class="toplinks"><p id="searchtext" class="toplinkcenter">Search</p></div></div></div></header>'

?>
