<?php
class OAGSoapClient extends SoapClient{
	
	private $wsdl;
	private $username;
	private $password;
	private $client;

	
	
	public function __construct( $oag_account ){
		$this->client    = parent::__construct('http://ondemand.oagcargo.com/CBCargoWebServicePublic/CBCargoWSPubliclPort?wsdl', array('login'=>'10344608','password'=>'xyrhvs3','trace'=>1));
		$this->wsdl      = $oag_account->getWsdl();
		$this->username  = $oag_account->getUserName();
		$this->password  = $oag_account->getPassword();
		var_dump($this->client);
		
	}
	
	public function searchDirectFlights( $args ){
		try{
			
			
			/*$result = $client->getDirectFlights(array(
				'arg0' =>array(
				    'username'						  => '10344608',//$this->username,
				    'password'						  => 'xyrhvs3',//$this->password,
					'originCriteria'                  => 'CHI',//$args->getOriginCriteria(),
					'originCriteriaLocationType'      => 'M',//$args->getOriginCriteriaLocationType(),
					'detinationCriteria'		      => 'LON',//$args->getDestinationCriteria(),
					'destinationCriteriaLocationType' => 'M',//$args->getDestinationCriteriaLocationType(),
					'requestDate'					  => '2015-07-09',//$args->getRequestDate(),
					'requestTime'					  => '00:00:00',//$args->getRequestTime(),
					'requestDateEffectiveFrom'		  => '',
					'requestDateEffectiveTo'          => '',
				)
			));
			return $result->return->cbXmlResponse;*/
		}
			catch(Exception $e){
			throw $e;
		}
	}
	
	public function searchConnectionFlights( $args ){
		
	}
	

}//Termina la clase OAGSoapClient