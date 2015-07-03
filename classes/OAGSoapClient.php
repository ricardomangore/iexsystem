<?php
class OAGSoapClient{
	
	private $wsdl;
	private $username;
	private $password;
	
	
	public function __construct( $oag_account ){
		$this->wsdl = $oag_account['wsdl'];
		$this->username = $oag_account['username'];
		$this->password = $oag_account['password'];
	}
	
	public function getWSDL(){
		return $this->wsdl;
	}
	
	public function getUserName(){
		return $this->username;
	}
	
	public function getPassword(){
		return $this->password;
	}
	
}//Termina la clase OAGSoapClient