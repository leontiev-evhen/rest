<?php
namespace helpers;
use \SimpleXMLElement;

class ConverterHelper
{
    private $type = '';

    public static function chooseTypeOutput ($data, $type)
    {
        switch ($type)
        {
                case '.json':
                $data = self::convertJSON($data);
                break;

            case '.xml':
                $data = self::convertXML($data);
                break;

            case '.txt':
                $data = self::convertTXT($data);
                break;

            case '.html':
                $data = self::convertHTML($data);
                break;
        }
        return $data;
    }

    private function convertJSON ($data)
    {
        header( "HTTP/1.1 200 OK" );
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }

    private function convertXML ($data)
    {
        header( "HTTP/1.1 200 OK" );
        header('Content-Type: application/xml; charset=utf-8');
        $xml = new SimpleXMLElement('<xml/>');

        if (isset($data['data']))
        {
            foreach ($data['data'] as $items) 
            {
                if (is_array($items)) 
                {
                    $element = $xml->addChild('item');
                    foreach (array_unique($items) as $key=>$item)
                    {
                        $element->addChild($key, $item);
                    }   
                }  
                else 
                {
                    $arr[] = $items;
                } 
            }
            if (!empty($arr))
            {
                $element = $xml->addChild('item');
                foreach (array_unique($arr) as $key=>$item)
                {
                    $element->addChild('element', $item);
                }   
            }
                 
           echo $xml->asXML();
        }
    }

    private function convertTXT ($data)
    {
        header( "HTTP/1.1 200 OK" );
        header('Content-Type: text/javascript; charset=utf-8');

        print_r($data);
    }

    private function convertHTML ($data)
    {
        header( "HTTP/1.1 200 OK" );
        header('Content-Type: text/html; charset=utf-8');
        if (isset($data['data']))
        {
            $html = '<table border="1" cellspacing="0" cellpadding="5"><tbody>';
            
            foreach ($data['data'] as $items) 
            {
                if (is_array($items)) 
                { 
                    $html .='<tr>';
                    foreach (array_unique($items) as $item)
                    {
                        $html .='<td>'.$item.'</td>';
                    }   

                    $html .='</tr>';
                }  
                else 
                {
                    $arr[] = $items;
                } 
            }
            if (!empty($arr))
            {
                $html .='<tr>';
                foreach (array_unique($arr) as $key=>$item)
                {
                    $html .='<td>'.$item.'</td>';
                }   
                $html .='</tr>';
            }
                 
            $html .= '</tbody></table>';
        }
        echo $html;
    }
}
