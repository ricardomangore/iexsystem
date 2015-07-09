<?php
class OagAccount{
	
	private $username;
	private $password;
	private $wsdl;
	
	
	public function __construct($options){
		$this->username  = $options['username'];
		$this->password  = $options['password'];
		$this->wsdl      = $options['wsdl'];
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
	
	public function getWsdl(){
		return $this->wsdl;
	}
	
	public function setWsdl($wsdl){
		$this->wsdl = $wsdl;
	}
	
}//Finaliza la clase
