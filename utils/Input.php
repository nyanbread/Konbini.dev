<?php

class Input
{
    /**
     * Check if a given value was passed in the request
     *
     * @param string $key index to look for in request
     * @return boolean whether value exists in $_POST or $_GET
     */
    public static function has($key)
    {
        return isset($_REQUEST[$key]);
    }

    /**
     * Get a requested value from either $_POST or $_GET
     *
     * @param string $key index to look for in index
     * @param mixed $default default value to return if key not found
     * @return mixed value passed in request
     */
    public static function get($key, $default = null)
    {
        return self::has($key) ? trim($_REQUEST[$key]) : $default ;
    }
    public static function getString($key){
        $string = self::get($key);
        if (($string == mull | is_resource($string)) || is_bool($string) || is_numeric($string) || is_array($string) || is_object($string)){
            throw new Exception('This is not a string or is null!')
        }
        return $string
        }
    public static function getNumber($key){
        $number = self::get($key);
        if (!is_numeric($number) || $number == null){
            throw new Exception('This is not a number, or it\'s null.')
        }
        return (float) $number;

    }
    }

    ///////////////////////////////////////////////////////////////////////////
    //                      DO NOT EDIT ANYTHING BELOW!!                     //
    // The Input class should not ever be instantiated, so we prevent the    //
    // constructor method from being called. We will be covering private     //
    // later in the curriculum.                                              //
    ///////////////////////////////////////////////////////////////////////////
    private function __construct() {}
}
