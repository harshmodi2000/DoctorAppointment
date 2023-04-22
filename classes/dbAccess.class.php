<?php
class DbAccess{
	private $host = "localhost";
	private $user = "root";
	private $pwd = "test1234";
	private $dbname = "docare";

	protected function connect()
	{
		try{
		$dsn = 'mysql:host='.$this->host.';dbname='.$this->dbname;
		$pdo = new PDO($dsn,$this->user,$this->pwd);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
		return $pdo;
		}
		catch(PDOException $e){
			error_log("Database connection error:".$e->getMessage(), 0);
			die("Database connection error:".$e->getMessage());
		}
	}
}