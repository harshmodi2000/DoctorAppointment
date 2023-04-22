<?php
class Patient extends DbAccess{
    private $id,$name,$address,$phone,$date_of_birth,$gender,$email,$password,$username,$table,$pdo;

    public function __construct()
    {
        $this->pdo=$this->connect();
        $this->table='patient';
    }
    public function getTable(){
        return $this->table;
    }
    
    public function setUser($name,$gender,$address,$phone,$date_of_birth,$email,$username,$password){
        $this->name=$name;
        $this->address=$address;
        $this->phone=$phone;
        $this->date_of_birth=$date_of_birth;
        $this->gender=$gender;
        $this->password=password_hash($password, PASSWORD_DEFAULT);
        $this->email=$email;
        $this->username=$username;
    }
    public function setUserById($id)
    {	
    	$sql="SELECT * FROM $this->table Where id=:id";
    	$stmt=$this->pdo->prepare($sql);
        $stmt->execute(array(':id' => $id));
    	$result = $stmt->fetch();
        if(!empty($result)){
        $this->id=$id;
    	$this->name=$result['name'];
    	$this->gender=$result['gender'];
    	$this->phone=$result['phone'];
    	$this->address=$result['address'];
    	$this->email=$result['email'];
    	$this->username=$result['username'];
    	$this->date_of_birth=$result['date_of_birth'];
        $this->password=$result['password'];
            }
            else
                echo "User not found!";
    }

    public function addUserToDatabase(){
    	$sql = "INSERT INTO $this->table(name,gender,address,phone,date_of_birth,email,username,password) VALUES(:name,:gender,:address,:phone,:date_of_birth,:email,:username,:password)";
    	$stmt=$this->pdo->prepare($sql);
        $stmt->execute( array(':name' => $this->name, ':gender' =>$this->gender,':address' =>$this->address,':phone' =>$this->phone,':date_of_birth' =>$this->date_of_birth,
    		':email' =>$this->email,':username' =>$this->username,':password' =>$this->password));
    	if($stmt!==false)
    	{
    		return true;
    	}
    	else
    		return false;
    }

    public function setName($name){
        $this->name=$name;
    }
    public function setAddress($address){
        $this->address=$address;
    }
    public function setContact($phone){
        $this->phone=$phone;
    }
    public function setDateOfBirth($date_of_birth){
        $this->date_of_birth=$date_of_birth;
    }
    public function setGender($gender){
        $this->gender=$gender;
    }
    public function setUsername($username){
        $this->username=$username;
    }
    public function setEmail($email){
        $this->email=$email;
    }
    public function setPassword($password){
        $this->password=$password;
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


    public function getId(){return $this->id;}
    public function getName(){return $this->name;}
    public function getAddress(){return $this->address;}
    public function getPhone(){return $this->phone;}
    public function getDateOfBirth(){return $this->date_of_birth;}
    public function getGender(){return $this->gender;}
    public function getEmail(){return $this->email;}
    public function getAll()
    {
        $sql="SELECT * FROM patient ORDER BY id ASC";
        $stmt=$this->pdo->prepare($sql);
        $stmt->execute();
        $result=$stmt->fetchAll();
        if(empty($result))
        {
            return false;
        }else{
            return $result;
        }
    }

    public function deleteAccount($id)
    {
        try{
            $sql="DELETE FROM patient WHERE id=:id";
            $stmt=$this->pdo->prepare($sql);
            $stmt->execute(array('id'=>$id));

        }catch(PDOException $e)
        {
            error_log($e->getMessage(),0);
            return false;
        }
        return true;

    }
}
?>