<?php

class Input
{

    public static function getString($value){
        if (!is_string($value) || is_null($value)){
            throw new Exception('This is not a string!');
        }
        return $value;
        }
    public static function getNumber($number){
        if (!is_numeric($number) || is_null($number)){
            throw new Exception("This is not a number.");
        }
        return $number;

    }
    public static function getImage($key)
    {
        $test = $key;
        $directory = "img/uploads/ads/";
        $targetImage = $directory . basename($key['name']);
        $imageType = pathinfo($targetImage, PATHINFO_EXTENSION);

        $acceptedfiles = ["jpg","png","gif","jpeg"];
        // checks if the image is an allowed file type
        for ($i=0; $i < count($acceptedfiles); $i++)
        { 
            if($imageType == $acceptedfiles[$i])
            {
                $imageFiletrue = true;
                break;
            }
            $imageFiletrue = false;
        }
        if (!$imageFiletrue) {
            return false;
        }
        

        // checks if the image is too big (1000000 = 1MB)
        if ($key['size'] > 1000000){
            return false;
        }

        // checks if the file uploaded is even an image with getimagesize

        $check = getimagesize($key['tmp_name']);
        if($check == false)
        {
            return false;
        }
        else
        {
            move_uploaded_file($key['tmp_name'], $targetImage);
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
