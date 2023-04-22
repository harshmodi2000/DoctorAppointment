<?php
class Authenticator extends DbAccess{

private $table;
private $pdo;

public function __construct($obj)
{
    $x=$obj->getTable();
    $this->table=$x;
    $this->pdo=$this->connect();
}
public function emailExist($email){
	$table=$this->table;
    $sql= "SELECT * FROM $table WHERE email=:d";
    $stmt=$this->pdo->prepare($sql);
    $stmt->execute(array(':d' =>$email ));
    $result=$stmt->fetch();
    if(!empty($result)){
        return $result;
    }
    else
        return false;
}

public function usernameExist($username){
	$table=$this->table;
    $sql= "SELECT * FROM $table WHERE username=:d";
    $stmt=$this->pdo->prepare($sql);
    $stmt->execute(array(':d' => $username ));
    $result = $stmt->fetch();
    if(!empty($result)){
        return $result;
    }
    else
        return false;
}

public function useridExist($username){
    $sql= "SELECT * FROM $this->table WHERE username=:a OR email=:b ";
    $stmt=$this->pdo->prepare($sql);
    $stmt->execute(array(':a' =>$username, ":b"=>$username));
    $result=$stmt->fetch();
    if(!empty($result)){
        return $result;
    }
    else
        return false;
    }

public function authenticateUser($username,$password){

    $user = $this->useridExist($username);

    if($user===false)
    {
        return -1;
    }

    $hashedpswd=$user['password'];
    $pswdverificator=password_verify($password, $hashedpswd);
    if($pswdverificator===false)
    {
        return 0;
    }
    else
        return $user['id'];
}

}
