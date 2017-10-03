<?php
class ConverterHelper
{
    private $type = '';

    public static function chooseTypeOutput ($data, $type = '')
    {
        switch ($type)
        {
            case 'json':
                self::convertJson($data);
                break;
        }
    
    }

    private static function convertJson ($data)
    {
        return json_encode($data);
    }
}
