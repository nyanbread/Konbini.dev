<?php
	require_once '../db_connect.php';

	function contentsExplode($array, $kind)
	{
		foreach ($array as $key => $value)
		{
			$miniarray = explode(',', $value);
			if ($kind == "ads")
			{
				$miniarray = adsArray($miniarray);
			}
			elseif ($kind == "users")
			{
				$miniarray = usersArray($miniarray);
			}
			elseif ($kind == "posts")
			{
				$miniarray = postsArray($miniarray);
			}
			$array[$key] = $miniarray;
		}
		array_pop($array);
		return $array;
	}
	function adsArray($miniarray)
	{
		$miniarray["id"] = $miniarray[0];
		$miniarray["user"] = $miniarray[1];
		$miniarray["item"] = $miniarray[2];
		$miniarray["description"] = $miniarray[3];
		$miniarray["price"] = $miniarray[4];
		$miniarray["img_url_main"] = $miniarray[5];
		for ($i=0; $i < count($miniarray)/2+2; $i++)
		{ 
			array_shift($miniarray);
		}
		return $miniarray;
	}
	function usersArray($miniarray)
	{
		$options = [
    		'cost' => 12,
		];
		$miniarray["id"] = $miniarray[0];
		$miniarray["user"] = $miniarray[1];
		$miniarray["password"] = password_hash($miniarray[2], PASSWORD_BCRYPT, $options);
		$miniarray["e_mail"] = $miniarray[3];
		$miniarray["location"] = $miniarray[4];
		$miniarray["userlevel"] = $miniarray[5];
		for ($i=0; $i < count($miniarray)/2+1; $i++)
		{ 
			array_shift($miniarray);
		}
		return $miniarray;
	}
	function postsArray($miniarray)
	{
		$miniarray["id"] = $miniarray[0];
		$miniarray["user"] = $miniarray[1];
		$miniarray["title"] = $miniarray[2];
		$miniarray["post_date"] = $miniarray[3];
		$miniarray["post_content"] = $miniarray[4];
		$miniarray["img_url_main"] = $miniarray[5];
		for ($i=0; $i < count($miniarray)/2+1; $i++)
		{ 
			array_shift($miniarray);
		}
		return $miniarray;
	}
	function fileKind()
	{
		$arraychoices = ["ads","users","posts"];
		$kind = trim(fgets(STDIN));
		for ($i=0; $i < count($arraychoices); $i++)
		{ 
			if ($kind == $arraychoices[$i])
			{
				echo $arraychoices[$i];
				return $arraychoices[$i];
			}
		}
		fwrite(STDOUT, "Sorry, but please type in one of the choices. ( ads, users, or posts )");
		fileKind();
	}
	fwrite(STDOUT, "Type in the file that you want to open.\t");
	$filename = trim(fgets(STDIN));
	$handle = fopen($filename, "r");
	$contents = fread($handle, filesize($filename));
	$contentsarray = explode(PHP_EOL, $contents);
	fwrite(STDOUT, "Alright, what kind of file is this? ( ads, users, or posts )");
	$filekind = fileKind();
	fwrite(STDOUT, "Alright, now we're going to make this database readable!");
	$readlist = contentsExplode($contentsarray, $filekind);
	print_r($readlist);



	$query = "INSERT INTO ".$filekind." (id, user, item, description, price, img_url_main) 
				VALUES (:id, :user, :item, :description, :price, :img_url_main)";
	$stmt = $dbc->prepare($query);
	foreach ($readlist as $partlist => $partarray)
	{
		print_r($partarray);
		foreach ($partarray as $key => $value)
		{
			echo $key.PHP_EOL.$value.PHP_EOL;
			$stmt->bindValue(':'.$key, $value, PDO::PARAM_STR);
			echo "Inserted ID" . $dbc->lastInsertId() . PHP_EOL;
		}
		$stmt->execute();
	}
?>
