<?php 

class Doctor extends DbAccess{

    private $pdo;
    private $table;
	private $id;
    private $name;
    private $phone;
    private $speciality;
    private $username;
    private $gender;
    private $email;
    private $profileImage;
    private $password;

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
            echo "user could not be found";
            exit();
        }else{
        $this->id=$id;
    	$this->name=$result['name'];
    	$this->speciality=$result['speciality'];
    	$this->phone=$result['phone'];
    	$this->gender=$result['gender'];
    	$this->email=$result['email'];
    	$this->username=$result['username'];
    	$this->profileImage=$result['profileImage'];
        $this->password=$result['password'];}
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
    public function getSpeciality()
    {
        return $this->speciality;
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
    public function setSpeciality($speciality)
    {
        $this->speciality=$speciality;
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

    public function setUser($name,$gender,$speciality,$phone,$email)
    {
        $this->name=$name;
        $this->gender=$gender;
        $this->speciality=$speciality;
        $this->phone=$phone;
        $this->email=$email;
    }

    public function addUserToDatabase(){
    	$sql = "INSERT INTO $this->table(name,gender,speciality,profileImage,phone,email,username,password) VALUES(:name,:gender,:speciality,:profileImage,:phone,:email,:username,:password)";
    	$stmt=$this->pdo->prepare($sql);
        $stmt->execute( array(':name' => $this->name, ':gender' =>$this->gender,':speciality' =>$this->speciality,':profileImage' =>$this->profileImage,
    		':phone' =>$this->phone,':email' =>$this->email,':username' =>$this->username,':password' =>$this->password));
    	if($stmt!==false)
    	{
    		return true;
    	}
    	else
    		return false;
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

    public function updateSpeciality($speciality)
    {
        $sql="UPDATE $this->table SET speciality=:speciality WHERE id=:id";
        $stmt=$this->pdo->prepare($sql);
        if ($stmt->execute(array(':speciality'=>$speciality,':id'=>$this->id))) {
            $this->speciality=$speciality;
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

   	public function deleteAccount()
   	{

   	}
    
}
?>