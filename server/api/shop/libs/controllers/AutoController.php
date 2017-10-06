<?php
namespace controllers;


class AutoController extends \core\Controller
{

    protected $model;

    public function __construct ()
    {
        $this->model = new \models\AutoModel();
    }

    public function getAuto ()
    {<?php
//echo base64_decode('YWxhZGRpbjpvcGVuc2VzYW1l');
//
//$length = 10;
//$token = bin2hex(random_bytes($length));
//function getToken($length){
//     $token = "";
//          $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
//               $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
//                    $codeAlphabet.= "0123456789";
//                         $max = strlen($codeAlphabet); // edited
//
//                             for ($i=0; $i < $length; $i++) {
//                                     $token .= $codeAlphabet[random_int(0, $max-1)];
//                                         }
//
//                                             return $token;
//                                             }
//                                             echo getToken(32);
//                                             //d3Bh0HZhSr4R4-rI4oqIk21eWDdK5mpf
//                                             //YYgGRfutK08n74DwXEXSaGdXnBLju713
        print_r(getallheaders());
        $data = $this->model->getAuto();
        if ($data)
        {
            return $this->getServerAnswer(200, true, 'getting auto was success', $data);
        }
        else
        {
            return $this->getServerAnswer(500, false, 'failed get auto');
        }
        
        return $this->getServerAnswer(500, false, 'failed get auto'); 
    }

   
    public function getAutoById ($id)
    {
        
        if (!empty($id)) 
        {
            $data = $this->model->getAutoById($id);
            if ($data)
            {
                return $this->getServerAnswer(200, true, 'getting auto was success', $data);
            }
            else
            {
                return $this->getServerAnswer(500, false, 'failed get auto');
            }
        }
        return $this->getServerAnswer(400, false, 'Bad Request'); 
    }

    
    public function postAuto ($data)
    {
        if (!empty($data))
        {
            $dataDecode = json_decode($data);
            $aData = $this->model->filterAuto($dataDecode);
            if ($aData)
            {
                $result = ['status' => true, 'data' => $aData, 'message' => 'filtering auto was success'];
            }
            else
            {
                $result = ['status' => false, 'message' => 'failed get auto'];
            }
            
            return $result;
        }
        return $this->getServerAnswer(400, false, 'Bad Request');  
    }
}
