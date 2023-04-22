<?php
class Validator
{
	public static function invalidName($name)
	{
		if(!preg_match("/^[a-zA-Z0-9\s]*$/",$name))
		{
			return true;
		}
		return false;
	}

	public static function invalidUsername($username)
	{
		if(!preg_match('/^\d[a-zA-Z0-9]/',$username))
		{
			if(!preg_match('/\s/',$username))
				return false;
			else 
				{return true;}
		}else{
			return true;
		}
	}

	public static function isValidMail($email)
	{
		$email=filter_var($email, FILTER_VALIDATE_EMAIL);
    		return $email;
	}

	public static function isNotMatched($pswd,$pswdconfirm)
	{
		if ($pswd!==$pswdconfirm) {
			return true;
		}
		return false;
	}

	public static function isValidPhonenumber($phone)
	{

	$valid_number = filter_var($phone, FILTER_SANITIZE_NUMBER_INT);
	$valid_number=ltrim($valid_number,"0");
	$valid_number = str_replace("-", "", $valid_number);
	if (strlen($valid_number) < 10 || strlen($valid_number) > 14) 
		{
		return false;
		}
	 else {
	return $valid_number;
		}
	}

	public static function invalidImageSize($image)
	{
		$maxsize = 5242880 ;

		if($image['size']>$maxsize)
		{
			return true;
		}
		else
			return false;
	}
	public static function invalidFileSize($image)
	{
		$maxsize = 8388608 ;

		if($image['size']>$maxsize)
		{
			return true;
		}
		else
			return false;
	}

	public static function fileUploadError($file)
	{
		if ($file['error']!==0) {
			return true;
		}
		else
			return false;
	} 

	public static function invalidImageFormat($image)
	{
		$allowedformat=array('jpg','jpeg','png');

		$x= explode('.', $image['name']);
		$file_extension=strtolower(end($x));
		if(in_array($file_extension, $allowedformat))
		{
			return false;
		}
		else return true;
	}

	public static function isEmptyfile($file){
		if($file['size']==0)
		{
			return true;
		}
		else
			return false;
	}

	public static function emptyfields(...$args)
	 {
	 	for ($i=0; $i < count($args) ; $i++) { 
	 	if(empty($args[$i])||strlen($args[$i])<1)
	 	return true;
	 	} 
	 	return false;
	}

	public static function invalidPasswordLength($password)
	{
		if (strlen($password)<6) {
			return true;
		}
		else return false;
	}

}