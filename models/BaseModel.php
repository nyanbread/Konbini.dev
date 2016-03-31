<?php

abstract class Model
{
	protected $ad_attributes = [];

	public function __get($key)
	{
		if (array_key_exists($key, $this->ad_attributes))
		{
			return $this->ad_attributes[$key];
		}
		return null;
	}
	
	public function __set($name, $value)
    {
    	$this->attributes[$name] = $value;
    }
    
    public function savenew()
    {
    	$this->insert();
    }
        public function saveold()
    {
    	$this->update();
    }

    protected abstract function insert();

    protected abstract function update();

}

?>