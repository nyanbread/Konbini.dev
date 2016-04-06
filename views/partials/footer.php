<?php

class Footer
{
	public $footcss = "\"/css/footer.css\"";
	public $contentfoot; 
	public $adpost;
	public $adedit;
	public $logout;

	public function userControls($realuser)
	{
		if(isset($_SESSION['user']))
		{
			$this->adpost = "<div id='postad' class='bottomlinks'><a href='/ads.create.php'>Post</div>";
			$this->logout = "<div id='logout'><a href='/auth.logout.php'>Logout</a></div>";
		}
		else
		{
			$this->adpost = '';
			$this->logout = '';
		}
		if((isset($_GET['itemid'])) && ($_SESSION['user'] == $realuser))
		{
			$itemid = $_GET['itemid'];
			$this->adedit = "<div id='editad' class='bottomlinks'><a href='/ads.edit.php?itemid=".$itemid."'>Edit</div>";
		}
		else
		{
			$this->adedit = '';
		}

	}
	public function getFooter()
	{
		$this->contentfoot = "<footer id='subnav' class='font1 fontmedium'><div id='bottomlinkcontainer'>".$this->adpost.$this->adedit."</div>".$this->logout."</div></footer>";
		return $this->contentfoot;
	}
}
?>