<?php
namespace models;
use \PDO;

class UsersModel extends \core\Model
{
	private $table = 'users';

	public function createUser ($data)
    {
    	if (!$this->checkUniqueEmail($data->email))
    	{
    		$sql = $this->insert()
            ->from($this->table)
            ->values([
            'name' 		 => '<?>',
            'surname' 	 => '<?>',
            'email' 	 => '<?>',
            'password' 	 => '<?>',
            'created_at' => '<?>'
            ])
           ->execute();
	        $sql = str_replace(["'<", ">'"], '', $sql);
	        
	        $STH = $this->connect->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
	       
	        $date = date("Y-m-d H:i:s");
	        $date = strtotime($date);

	        $STH->bindParam(1, $data->name);
	        $STH->bindParam(2, $data->surname);
	        $STH->bindParam(3, $data->email);
	        $STH->bindParam(4, $data->password);
	        $STH->bindParam(5, $date);
	        if ($STH->execute())
	        {
	            return ['result' => true, 'message' => 'user was added successful'];
	        }  
	        return ['result' => false, 'message' => 'Operation is failed'];
    	}
    	else
    	{
    		return ['result' => false, 'message' => 'Email already exist'];
    	}
    }

    public function checkUser ($data)
    {
    	$sql = $this->select([
    			'id',
    			'name',
    			'surname',
    			'email',
    			'password'])
            ->from($this->table)
            ->where(['email' => "<:email>"])
           ->execute();
        $sql = str_replace(["'<", ">'"], '', $sql);
        
        $STH = $this->connect->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        if ($STH->execute([':email' => $data->email]))
        {
            return $STH->fetch();
        }  
        return false;
    }

    private function checkUniqueEmail ($email)
    {
    	$sql = $this->select([
    			'email'])
            ->from($this->table)
            ->where(['email' => "<:email>"])
           	->execute();
        $sql = str_replace(["'<", ">'"], '', $sql);
        
        $STH = $this->connect->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $STH->execute([':email' => $email]);
       
        if ($STH->rowCount() > 0)
        {
            return true;
        }  
        return false;
    }

    public function updateToken ($data)
    {
		$sql = $this->update()
	        ->from($this->table)
	        ->set([
	        	'token' => '<?>',
	         	'token_create_at' => '<?>'])
	        ->where(['id' => '<?>'])
	       	->execute();
        $sql = str_replace(["'<", ">'"], '', $sql);
        
        $STH = $this->connect->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        
        $date = date("Y-m-d H:i:s", strtotime('1 hour'));
        $date = strtotime($date);
        $STH->bindParam(1, $data['access_token']);
        $STH->bindParam(2, $date);
        $STH->bindParam(3, $data['id']);

        if ($STH->execute())
        {
            return true;
        }  
        return false;
    }

    public function checkAuthUser ($id, $token)
    {
    	$sql = $this->select([
    			'id'])
            ->from($this->table)
            ->where(['id' => "<:id>"])
            ->where(['token' => "<:token>"], "and")
            ->where(['token_create_at' => "<:token_create_at>"], "and", ">=")
           	->execute();
        $sql = str_replace(["'<", ">'"], '', $sql);
        
        $STH = $this->connect->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

        $date = strtotime('now');

        $STH->execute([':id' => $id, ':token' => $token, ':token_create_at' => $date]);
       
        if ($STH->rowCount() > 0)
        {
            return true;
        }  
        return false;
    }
}