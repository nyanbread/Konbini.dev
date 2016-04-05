<?php

class Footer
{
	public $footcss = "\"/css/footer.css\"";
	public $contentfoot; 
	public $adpost;
	public $adedit;

	public function userControls($realuser)
	{
		if(isset($_SESSION['user']))
		{
			$this->adpost = "<div id='postad' class='bottomlinks'><a href='/ads.create.php'>Post</div>";
		}
		else
		{
			$this->adpost = '';
		}
		if((isset($_GET['itemid'])) && ($_SESSION['user'] == $realuser))
		{
			$this->adedit = "<div id='editad' class='bottomlinks'>Edit</div>";
		}
		else
		{
			$this->adedit = '';
		}
	}
	public function getFooter()
	{
		$this->contentfoot = "<footer id='subnav' class='font1 fontmedium'><div id='bottomlinkcontainer'>".$this->adpost.$this->adedit."</div><div id='logout'>Logout</div></div></footer>";
		return $this->contentfoot;
	}
}
?>