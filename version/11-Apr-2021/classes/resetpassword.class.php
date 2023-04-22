<?php
class ResetPassword extends DbAccess{
	private $pdo;
	private $token;
	private $selector;
	private $table;
	private $email;
	private $today;

	public function __construct(){
		$this->token=random_bytes(32);
		$this->selector=bin2hex(random_bytes(8));
		$this->pdo=$this->connect();
		$this->table="passwordreset";
		$this->today=date('U');

	}
	private function deleteExistingRequest($email){
		$sql="DELETE FROM $this->table WHERE email=:email";
		$stmt=$this->pdo->prepare($sql);
		if(!$stmt->execute(array(':email'=>$email)))
			return false;
	}
	private function deleteSelector($selector){
		$sql="DELETE FROM $this->table WHERE selector=:s";
		$stmt=$this->pdo->prepare($sql);
		if(!$stmt->execute(array(':s'=>$selector)))
			return false;
		else return true;
	}
	public function getLink($key,$email,$expiry)
	{	

		$this->expiry=$this->today+$expiry;
		$this->email=$email;

		if($this->deleteExistingRequest($this->email)!==false)
		{
		$sql="INSERT INTO $this->table(user,email,selector,token,expiry) VALUES(:key,:email,:selector,:token,:expiry)";
		$stmt=$this->pdo->prepare($sql);
		if(!$stmt->execute(array(':key'=>$key,':email'=>$this->email,':selector'=>$this->selector,':token'=>password_hash($this->token, PASSWORD_DEFAULT),':expiry'=>$this->expiry))) return false;
		$link='localhost/docare/reset-password/newpassword.php?key='.$key.'&selector='.$this->selector.'&validator='.bin2hex($this->token);
		return  $link;
		}
	}

	public function validateRequest($selector,$validator){
		$sql="SELECT * FROM $this->table WHERE selector=:selector";
		$stmt=$this->pdo->prepare($sql);
		$stmt->execute(array(':selector'=>$selector));
		$result=$stmt->fetch();
		if(empty($result))
		{

			return false;
		}
		else {	
			if($this->today>$result['expiry'])
			{	
				$this->deleteSelector($selector);
				return false;
			}
			else{	
				if (password_verify($validator, $result['token'])) 
					{
						if($this->deleteSelector($selector)!==false)
						{

							return $result['email'];
						}
						else 
							{
								return false;}
					}
					else{

						return false;}
					}
				}	
			
	}


}