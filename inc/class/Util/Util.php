<?php

class util
{
    public function objToArray($obj, $arr)
    {

        if(!is_object($obj) && !is_array($obj)){
            $arr = $obj;
            return $arr;
        }

        foreach ($obj as $key => $value)
        {
            if (!empty($value))
            {
                $arr[$key] = array();
                static::objToArray($value, $arr[$key]);
            }
            else
            {
                $arr[$key] = $value;
            }
        }
        return $arr;
    }

    public static function traverseArray($array)
    {
        // Loops through each element. If element again is array, function is recalled. If not, result is echoed.
        foreach ($array as $key => $value)
        {
            if (is_array($value))
            {
                static::traverseArray($value); // Or
                // traverseArray($value);
            }
            else
            {
                echo $key . " = " . $value . "<br />\n";
            }
        }
    }
}