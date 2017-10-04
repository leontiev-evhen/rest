<?php
namespace helpers;

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
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }

    private function convertXML ($data)
    {
        header('Content-Type: application/xml; charset=utf-8');
        print_r($data);
    }

    private function convertTXT ($data)
    {
        header('Content-Type: text/javascript; charset=utf-8');
        print_r($data);
    }

    private function convertHTML ($data)
    {
        header('Content-Type: text/html; charset=utf-8');
        if (isset($data['data']))
        {
            $html = '<table><tbody>';
            
            foreach ($data['data'] as $key=>$items) 
            {
                $html .='<tr>';
                foreach (array_unique($items) as $item)
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
