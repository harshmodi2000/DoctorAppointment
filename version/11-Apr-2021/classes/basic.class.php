<?php
class Basic{
	public static function moveFile($file,$destination,$name)
	{
		 $filename=$file['name'];
   		$fileTempName=$file['tmp_name'];
   		$x=explode('.', $filename);
   		$extension=strtolower(end($x));
   		$newfilename=$name.'.'.$extension;
   		$destination=$destination.$newfilename;
   		$result=move_uploaded_file($fileTempName, $destination);
   		if($result!==false)
   		{
   			return $newfilename;
   		}
   		else
   			return false;
	}
}