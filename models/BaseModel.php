<?php
abstract class Model
{
    protected $attributes = [];
    public function __get($key)
    {
        if (array_key_exists($key, $this->ad_attributes))
        {
            return $this->attributes[$key];
        }
        return null;
    }
    
    public function __set($name, $value)
    {
        $this->attributes[$name] = $value;
    }
    
    public function savenew($dbc)
    {
        $this->insert($dbc);
    }
    public function saveold($dbc)
    {
        $this->update($dbc);
    }
    public function rmthing($dbc)
    {
        $this->delete($dbc);
    }
    protected abstract function insert($dbc);
    protected abstract function update($dbc);
    protected abstract function delete($dbc);
}
?>