<?php

abstract class Model
{
    protected $columns = [];

    protected static $dbc;

    protected $attributes;

    public function __construct(array $attributes = array('id' => null))
    {

        self::dbConnect();
        $this->attributes = $attributes;

    }

    protected static function dbConnect()
    {
        if (!self::$dbc) {
            self::$dbc = new PDO('mysql:host=127.0.0.1;dbname=konbini_db', 'isurus', 'isurus');
        }
    }

    /**
     * Get a value from attributes based on its name
     *
     * @param string $name key for attributes array
     *
     * @return mixed|null value from the attributes array or null if it is undefined
     */
    public function __get($name)
    {

        return isset($this->attributes[$name]) ? $this->attributes[$name] : null;
    }

    /**
     * Set a new value for a key in attributes
     *
     * @param string $name  key for attributes array
     * @param mixed  $value value to be saved in attributes array
     */
    public function __set($name, $value)
    {

        $this->attributes[$name] = $value;  
    }

    public function save()
    {

        if (count($this->attributes) < count($this->columns)) {
            $difference = array_diff($this->columns, array_keys($this->attributes));
            throw new InvalidArgumentException(
                "The following missing keys were found: " . implode(', ', $difference)
            );
        }

        if(!is_null($this->attributes['id'])){
            $this->update();
        } else {
            $this->insert();
        }
        
    }

    protected abstract function insert();

    protected abstract function update();
}
