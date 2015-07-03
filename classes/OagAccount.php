<?php
class OagAccount{
	
	private $username;
	private $password;
	private $wsdl;
	
	
	public function __construct($username, $password, $wsdl){
		$this->$username = $username;
		$this->password  = $password;
		$this->wsdl      = $wsdl;
	}
	
	
	public function getUserName(){
		return $this->username;
	}
	
	public function setUserName($username){
		$this->username = $username;
	}
	
	public function getPassword(){
		return $this->password;
	}
	
	public function setPassword($password){
		$this->password = $password;
	}
	
}