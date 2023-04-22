<?php
class Admin extends DbAccess
{
	private $pdo;
	private $roleTable;
	private $table;
	private $name,$email,$password,$username;

	public function __construct()
	{
		$this->roleTable="role";
		$this->table="admin";
	}

	public function addRole($name,$service)
	{
		$sql="INSERT INTO $this->serviceTable(name,service) VALUES(:name,:service)";
		$stmt=$this->pdo->prepare($sql);
		if($stmt->execute(array(':name' =>$name ,':service'=>$service)))
		{
			return true;
		}else
		{
			return false;
		}
	}

	public function getTable()
	{
		return $this->table;
	}

	public function setUser($name,$email,$username,$password){
        $this->name=$name;
        $this->password=password_hash($password, PASSWORD_DEFAULT);
        $this->email=$email;
        $this->username=$username;
    }

    public function addUserToDatabase(){
    	$sql = "INSERT INTO $this->table(name,email,username,password) VALUES(:name,:email,:username,:password)";
    	$stmt=$this->pdo->prepare($sql);
        $stmt->execute( array(':name' => $this->name,
    		':email' =>$this->email,':username' =>$this->username,':password' =>$this->password));
    	if($stmt!==false)
    	{
    		return true;
    	}
    	else
    		return false;
    }
    public function updatePasswordByEmail($email,$password)
    {

        $sql="UPDATE $this->table SET password=:password WHERE email=:email";
        $stmt=$this->pdo->prepare($sql);
        if($stmt->execute( array(':password' => password_hash($password, PASSWORD_DEFAULT),':email'=>$email )))
        {
            return true;
        }else return false;
    }

	

	
}