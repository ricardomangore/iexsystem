<?php
class OAGSoapClient extends SoapClient{
	
	private $client;
	private $username;
	private $password;

	
	public function __construct( $oag_account ){
			parent::__construct($oag_account->getWsdl(),array('login'=>$oag_account->getUserName(),'password'=>$oag_account->getPassword(),'trace'=>1));
			$this->username = $oag_account->getUserName();
			$this->password = $oag_account->getPassword();
	}
	
	/**
	 * searchDirectFlights(  $directFlight )
	 * 
	 * Consulta los vuelos directos en el OAG Web Service
	 * 
	 * 
	 * @param $direcFlight object  Objecto con los paremetros de busqueda de vuelos directos solicitados por OAG Web Service
	 */
	public function searchDirectFlights(  $directFlight ){
		$arg = array('arg0'=>array(
									'destinationCriteria'             => $directFlight->getDestinationCriteria(),
									'destinationCriteriaLocationType' => $directFlight->getDestinationCriteriaLocationType(),
									'originCriteria'                  => $directFlight->getOriginCriteria(),
									'originCriteriaLocationType'      => $directFlight->getOriginCriteriaLocationType(),
									'requestDate'                     => $directFlight->getRequestDate(),
									'requestTime'                     => $directFlight->getRequestTime(),
									'requestDateEffectiveFrom'        => $directFlight->getRequestDateEffectiveFrom(),
									'requestDateEffectiveTo'          => $directFlight->getRequestDateEffectiveFrom(),			
									'carrier1Criteria'			      => $directFlight->getCarrier1Criteria(), 
									'sortOrder'						  => $directFlight->getSortOrder(), 
									'includeFreighter'				  => $directFlight->getIncludeFreighter(), 
									'includeRoadFeederService'        => $directFlight->getIncludeRoadFeederService(), 
									'wideToNarrowIndicator'			  => $directFlight->getWideToNarrowIndicator(), 
									'cargoCarrierDupePriority'		  => $directFlight->getCargoCarrierDupePriority(),
									'password'                        => $this->getPassword(),
									'username'                        => $this->getUserName()
								)
					);
								
					



		try{
			$result = $this->getDirectFlights($arg);
			return simplexml_load_string($result->return->cbXmlResponse);
		}
			catch(Exception $e){
			throw $e;
		}
	}/**/
	
	
	
	/**
	 * searchConnectionFlights(  $connectionFlight )
	 * 
	 * Consulta los vuelos directos en el OAG Web Service
	 * 
	 * 
	 * @param $direcFlight object  Objecto con los paremetros de busqueda de vuelos directos solicitados por OAG Web Service
	 */
	public function searchConnectionFlights( $connectionFlight ){
		$arg = array('arg0'=>array(
									'destinationCriteria'             => $connectionFlight->getDestinationCriteria(),
									'destinationCriteriaLocationType' => $connectionFlight->getDestinationCriteriaLocationType(),
									'originCriteria'                  => $connectionFlight->getOriginCriteria(),
									'originCriteriaLocationType'      => $connectionFlight->getOriginCriteriaLocationType(),
									'requestDate'                     => $connectionFlight->getRequestDate(),
									'requestTime'                     => $connectionFlight->getRequestTime(),
									'requestDateEffectiveFrom'        => $connectionFlight->getRequestDateEffectiveFrom(),
									'requestDateEffectiveTo'          => $connectionFlight->getRequestDateEffectiveFrom(),			
									'carrier1Criteria'			      => $connectionFlight->getCarrier1Criteria(),
									'carrier2Criteria'   			  => $connectionFlight->getCarrier2Criteria(), 
									'sortOrder'						  => $connectionFlight->getSortOrder(), 
									'includeFreighter'				  => $connectionFlight->getIncludeFreighter(), 
									'includeRoadFeederService'        => $connectionFlight->getIncludeRoadFeederService(), 
									'wideToNarrowIndicator'			  => $connectionFlight->getWideToNarrowIndicator(), 
									'cargoCarrierDupePriority'		  => $connectionFlight->getCargoCarrierDupePriority(),
									'via1Criteria' 					  => $connectionFlight->getVia1Criteria(),
									'via1CriteriaLocationType'		  => $connectionFlight->getVia1CriteriaLocationType(),
									'enableOnline'				      => $connectionFlight->getEnableOnline(),
									'interAirportConnections'         => $connectionFlight->getInterAirportConnections(),
									'lowCostConnectionsIndicator'	  => $connectionFlight->getLowCostConnectionsIndicator(),
									'maxCT1'						  => $connectionFlight->getMaxCT1(),
									'maxElapsedTime'				  => $connectionFlight->getMaxElapsedTime(),
									'maxCircuity'					  => $connectionFlight->getMaxCircuity(),
									'overrideMinCT1'				  => $connectionFlight->getOverrideMinCT1(),
									'maxSingleRoute'				  => $connectionFlight->getMaxSinglesRoute(),
									'password'                        => $this->getPassword(),
									'username'                        => $this->getUserName()
								)
					);
								
					



		try{
			$result = $this->getConnections($arg);
			return simplexml_load_string($result->return->cbXmlResponse);
		}
			catch(Exception $e){
			throw $e;
		}		
	}
	
	
	private function getUserName(){
		return $this->username;
	}
	
	private function getPassword(){
		return $this->password;
	}
	
}//Termina la clase OAGSoapClient