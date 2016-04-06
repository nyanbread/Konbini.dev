<?php
require_once "BaseModel.php";
class Ad extends Model
{
	protected function insert($dbc)
	{
		if (array_key_exists("imgurlthird", $this->attributes))
		{
			$insert = 'INSERT INTO ads (user, item, description, price, img_url_main, img_url_second, img_url_third)
						VALUES (:user, :item, :description, :price, :img_url_main, :img_url_second, :img_url_third)';
		}
		elseif (array_key_exists("imgurlsecond", $this->attributes))
		{
			$insert = 'INSERT INTO ads (user, item, description, price, img_url_main, img_url_second)
						VALUES (:user, :item, :description, :price, :img_url_main, :img_url_second)';						
		}
		else
		{
			$insert = 'INSERT INTO ads (user, item, description, price, img_url_main)
						VALUES (:user, :item, :description, :price, :img_url_main)';
		}
		$stmt = $dbc->prepare($insert);
		$arraymess = ["imgurlthird","imgurlsecond","imgurlmain"];
		foreach ($this->attributes as $key => $value)
		{
			for ($i=0; $i < count($arraymess); $i++)
			{ 

				if ($key == $arraymess[$i])
				{
					$newkey = substr($key, 0, 3)."_".substr($key, 3, 3)."_".substr($key, 6);
					echo $newkey.PHP_EOL;
            		$stmt->bindValue(':'.$newkey, $value, PDO::PARAM_STR);
        		}
        		elseif ($key !== "price")
        		{
        			$stmt->bindValue(':'.$key, $value, PDO::PARAM_STR);
        		}
        		elseif ($key == "price")
        		{
        			$stmt->bindValue(":".$key, $value, PDO::PARAM_STR);
        		}
			}
			
        }
        $stmt->execute();
	}
	protected function update($dbc)
	{
		if (array_key_exists("img_url_third", $this->attributes))
		{
			$update = 'UPDATE ads SET user = :user, item = :item, description = :description, price = :price, img_url_main = :img_url_main, img_url_second = :img_url_second, img_url_third = :img_url_third WHERE id = :id';
		}
		elseif (array_key_exists("img_url_second", $this->attributes))
		{
			$update = 'UPDATE ads SET user = :user, item = :item, description = :description, price = :price, img_url_main = :img_url_main, img_url_second = :img_url_second WHERE id = :id';
		}
		else
		{
			$update = 'UPDATE ads SET user = :user, item = :item, description = :description, price = :price, img_url_main = :img_url_main WHERE id = :id';	
		}
		$stmt = $dbc->prepare($update);
		foreach ($this->attributes as $key => $value) {
            $stmt->bindValue(':'.$key, $value, PDO::PARAM_STR);
        }
        $stmt->execute();
	}
	public static function findbyid($id, $dbc)
	{
		$search = 'SELECT * FROM ads where id = :id';
        $stmt = $dbc->prepare($search);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
	}
	public static function headlist($dbc)
	{

		$search = 'SELECT * FROM ads order by id desc limit 3';
		$stmt = $dbc->prepare($search);
        $stmt->execute();
        while ($resultrow = $stmt->fetch(PDO::FETCH_ASSOC))
        {
        	$result[] = $resultrow;
        }
        return $result;
	}
	public static function baselist($dbc, $limit, $idstart)
	{
		if (isset($limit))
		{
			$search = 'SELECT * FROM ads where id >= '.$idstart.' limit ' . $limit;
		}
		else
		{
			$search = 'SELECT * FROM ads where id >= '.$idstart.' limit 10';
		}
		$stmt = $dbc->prepare($search);
        $stmt->execute();
        while ($resultrow = $stmt->fetch(PDO::FETCH_ASSOC))
        {
        	$result[] = $resultrow;
        }
        return @$result;
	}
	public static function findbyitem($dbc,$item)
	{
		$item = '%'.$item.'%';
		$search = 'SELECT * FROM ads where item like :item';
        $stmt = $dbc->prepare($search);
        $stmt->bindValue(":item", $item, PDO::PARAM_STR);
        $stmt->execute();
        while ($resultrow = $stmt->fetch(PDO::FETCH_ASSOC))
        {
        	$result[] = $resultrow;
        }
        if (!is_null(@$result))
        {
        	return $result;
    	}
    	else
    	{
    		return null;
    	}
	}
	public static function findbyuser($dbc,$user,$idstart)
	{
		$search = 'SELECT * FROM ads where user = :user and id >= :id limit 10';
		$stmt = $dbc->prepare($search);
        $stmt->bindValue(":user", $user, PDO::PARAM_STR);
        $stmt->bindValue(":id", $idstart, PDO::PARAM_INT);
        $stmt->execute();
        while ($resultrow = $stmt->fetch(PDO::FETCH_ASSOC))
        {
        	$result[] = $resultrow;
        }
        if (!is_null(@$result))
        {
        	return $result;
    	}
	}
}
?>