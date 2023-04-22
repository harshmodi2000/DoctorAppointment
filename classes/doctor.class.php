<?php 

class Doctor extends DbAccess{

    private $pdo;
    private $table;
	private $id;
    private $name;
    private $phone;
    private $username;
    private $gender;
    private $email;
    private $profileImage;
    private $password;
    private $role;

    public function __construct()
    {
        $this->pdo=$this->connect();
        $this->table='doctor';
        $this->password=password_hash(random_bytes(32), PASSWORD_DEFAULT);
    }

    public function setUserById($id)
    {	
    	
    	$sql="SELECT * FROM $this->table Where id=:id";
    	$stmt=$this->pdo->prepare($sql);
        $stmt->execute(array(':id' => $id));
    	$result = $stmt->fetch();
        if(empty($result)){
            
            return false;
        }else{
        $this->id=$id;
    	$this->name=$result['name'];
    	$this->phone=$result['phone'];
    	$this->gender=$result['gender'];
    	$this->email=$result['email'];
    	$this->username=$result['username'];
    	$this->profileImage=$result['profileImage'];
        $this->password=$result['password'];
        return true;
        }
    }

    public function getProfileImageLink()
    {
        $image = $this->profileImage;
        $location="../uploads/profileImage/";

    	if(strtolower($this->gender)==='m')
    	{
            $default= $location.'default_male_doctor.jpg'; 
    	}
    	else
    	{
    		$default = $location.'default_female_doctor.png'; 
    	}

    	if (empty($image)) 
        {
    		return $default;
    	}
    	else
    		{
                return $location.$image;
            }

    }
    public function getTable()
    {
        $x=$this->table;
        return $x;
    }
    public function getId()
    {
        return $this->id;
    }
    public function getName()
    {
        return $this->name;
    }
    public function getPhone()
    {
        return $this->phone;
    }
        public function getUsername()
    {
        return $this->username;
    }
    public function getGender()
    {
        return $this->gender;
    }
        public function getEmail()
    {
        return $this->email;
    }
    public function getProfileImage()
    {
        return $this->profileImage;
    }
    public function setName($name)
    {
         $this->name=$name;
    }
    public function setPhone($phone)
    {
        $this->phone=$phone;
    }
        public function setUsername($username)
    {
        $this->username=$username;
    }
    public function setGender($gender)
    {
         $this->gender=$gender;
    }
        public function setEmail($email)
    {
        $this->email=$email;
    }
    public function setProfileImage($image)
    {
        $this->profileImage=$image;
    }
        public function setPassword($password)
    {
        $this->password=password_hash($password, PASSWORD_DEFAULT);
    }
        public function updatePasswordByEmail($email,$password)
    {

        $sql="UPDATE $this->table SET password=:password WHERE email=:email";
        $stmt=$this->pdo->prepare($sql);
        if($stmt->execute( array(':password' => password_hash($password,PASSWORD_DEFAULT),':email'=>$email )))
        {
            return true;
        }else return false;
    }

   	public function uploadProfileImage($image)
   	{
   		$destination= '../uploads/profileImage/';
        $name = 'd'.$this->id;
   		$imagelink=Basic::moveFile($image,$destination,$name);
   		return $imagelink;
   	}

    public function updateProfileImage($image)
    {
        $image=$this->uploadProfileImage($image);
        if($image!==false)
        {
        $sql="UPDATE $this->table SET profileImage=:profile WHERE id=:id";
        $stmt=$this->pdo->prepare($sql);
        if ($stmt->execute(array(':profile'=>$image,':id'=>$this->id))) {
             $this->profileImage=$image;
            return true;
        }
        else return false;
        }else{
            return false;
        }
    }

    public function setUser($name,$gender,$phone,$email)
    {
        $this->name=$name;
        $this->gender=$gender;
        $this->phone=$phone;
        $this->email=$email;
    }

    public function addUserToDatabase(){
        try{
    	$sql = "INSERT INTO $this->table(name,gender,profileImage,phone,email,username,password) VALUES(:name,:gender,:profileImage,:phone,:email,:username,:password)";
    	$stmt=$this->pdo->prepare($sql);
        $stmt->execute( array(':name' => $this->name, ':gender' =>$this->gender,':profileImage' =>$this->profileImage,
    		':phone' =>$this->phone,':email' =>$this->email,':username' =>$this->username,':password' =>$this->password));
        }catch(PDOException $e)
        {
            error_log("error truncating the default partition".$e->getMessage(),0);
            return false;
        }
        return true;
    	
    }

     public function updatePassword($password)
    {
        $password=password_hash($password, PASSWORD_DEFAULT);
        $sql="UPDATE $this->table SET password=:password WHERE email=:email";
        $stmt=$this->pdo->prepare($sql);
        if ($stmt->execute(array(':password'=>$password,':email'=>$this->email))) {
            return true;
        }
        else return false;
    }
    public function updateName($name)
    {
        $sql="UPDATE $this->table SET name=:name WHERE id=:id";
        $stmt=$this->pdo->prepare($sql);
        if ($stmt->execute(array(':name'=>$name,':id'=>$this->id))) {
            return true;
        }
        else return false;
    }

    public function updatePhone($phone)
    {
        $sql="UPDATE $this->table SET phone=:phone WHERE id=:id";
        $stmt=$this->pdo->prepare($sql);
        if ($stmt->execute(array(':phone'=>$phone,':id'=>$this->id))) {
            $this->phone=$phone;
            return true;
        }
        else return false;
    }
    public function updateEmail($email)
    {
        $sql="UPDATE $this->table SET email=:email WHERE id=:id";
        $stmt=$this->pdo->prepare($sql);
        if ($stmt->execute(array(':email'=>$email,':id'=>$this->id))) {
            $this->email=$email;
            return true;
        }
        else return false;
    }

    public function updateGender($gender)
    {
        $sql="UPDATE $this->table SET gender=:gender WHERE id=:id";
        $stmt=$this->pdo->prepare($sql);
        if ($stmt->execute(array(':gender'=>$gender,':id'=>$this->id))) {
            $this->gender=$gender;
            return true;
        }
        else return false;

    }
    public function updateUsername($username)
    {
        $sql="UPDATE $this->table SET username=:username WHERE id=:id";
        $stmt=$this->pdo->prepare($sql);
        if ($stmt->execute(array(':username'=>$username,':id'=>$this->id))) {
            $this->username=$username;
            return true;
        }
        else return false;

    }


   	public function deleteProfileImage()
   	{

   	}

   	public function deleteAccount($id)
   	{
        try{
            $sql="DELETE FROM doctor WHERE id=:id";
            $stmt=$this->pdo->prepare($sql);
            $stmt->execute(array('id'=>$id));

        }catch(PDOException $e)
        {
            error_log($e->getMessage(),0);
            return false;
        }
        return true;

   	}
    public function getIdByMail($email)
    {
        $sql="SELECT id FROM $this->table Where email=:mail";
        $stmt=$this->pdo->prepare($sql);
        $stmt->execute(array(':mail' => $email));
        $result=$stmt->fetch();
        if(empty($result))
        {
            return false;
        }else return $result['id'];
    }

    public function getAll()
    {
        $sql="SELECT * FROM $this->table";
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
    public function getIds()
    {
        $sql="SELECT id FROM $this->table";
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

    public function setRole($rolename)
    {
        $this->role=$rolename;
    }
    public function getRole()
    {
        return $this->role;
    }
    
}
?>