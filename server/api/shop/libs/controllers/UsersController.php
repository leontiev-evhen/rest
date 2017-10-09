<?php
namespace controllers;


class UsersController extends \core\Controller
{

    protected $model;
    protected $orders_model;
    private $headers;

    protected $rules = [
        'name'      => 'string',
        'surname'   => 'string',
        'email'     => 'string',
        'password'  => 'string',
    ];

    public function __construct ()
    {
        $this->model = new \models\UsersModel();
        $this->orders_model = new \models\OrdersModel();

        $this->headers = getallheaders();
    }

    public function getUsers ($params = false) 
    {
        if (!empty($params)) 
        {
            $param = explode('/', $params);
            $id = (int)$param[0];
            $value = $param[1];
            $aData = null;
         
            if ($this->checkAuthUser($id, $this->headers['Authorization']))
            {
                switch ($value) 
                {
                    case 'orders':
                        $aData = $this->orders_model->getUserOrders($id);
                        break;
                    
                    default:
                        return $this->getServerAnswer(400, false, 'Bad Request');
                        break;
                }

                if ($aData)
                {
                    return $this->getServerAnswer(200, true, 'orders received successfully', $aData);
                }
                else
                {
                    return $this->getServerAnswer(200, true, 'Don\'t found orders');
                }
            }
            else
            {
                return $this->getServerAnswer(200, false, 'authentication false');
            }
        }
        return $this->getServerAnswer(400, false, 'Bad Request');
    }

    public function putUsers ($id = false) 
    {
        if ($this->validate()) 
        {

            $password =  base64_decode($this->data->password);
    
            if ($aData = $this->model->checkUser($this->data))
            {
                if (password_verify($password, $aData['password'])) {

                    $aData = array_unique($aData);
                    unset($aData['password']);

                    $aData['access_token'] = $this->createToken($aData['id']);

                    return $this->getServerAnswer(200, true, 'user authentication successful', $aData);
                } 
                return $this->getServerAnswer(200, false, 'invalid email or password');
            }
            else
            {
                return $this->getServerAnswer(500, false, 'Internal Server Error');
            }
        }

        return $this->getServerAnswer(400, false, 'Bad Request');
    }


    public function postUsers () 
    {
        if ($this->validate()) 
        {

            $password =  base64_decode($this->data->password);
            $this->data->password = password_hash($password, PASSWORD_DEFAULT);
            
            $aData = $this->model->createUser($this->data);
            if ($aData['result'])
            {
                return $this->getServerAnswer(200, $aData['result'], $aData['message']);
            }
            else
            {
                return $this->getServerAnswer(200, $aData['result'], $aData['message']);
            }
        }

        return $this->getServerAnswer(400, false, 'Bad Request');
    }

    private function checkAuthUser ($id, $access_token)
    {
        return $this->model->checkAuthUser($id, $access_token);
    }

    private function createToken ($id) 
    {
        $data['access_token'] = $this->getToken();
        $data['id'] = $id;
        $this->model->updateToken($data);
        return $data['access_token'];
    }

    private function getToken()
    {
        $token = "";
        $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
        $codeAlphabet.= "0123456789";
        $max = strlen($codeAlphabet);

        for ($i = 0; $i < 32; $i++) 
        {
            $token .= $codeAlphabet[random_int(0, $max-1)];
        }

        return $token;
    }
}