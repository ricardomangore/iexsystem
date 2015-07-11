<?php

class ConnectionFlight extends DirectFlight{
	
	
	private $via1_criteria;                      
	private $via1_criteria_location_type;        
	private $carrier2_criteria; 
	private $enable_online;						 
	private $inter_airport_connections;          
	private $low_cost_connections_indicator;    
	private $max_ct1;							 
	private $max_elapsed_time;					 
	private $max_circuity;						 
	private $override_min_ct1;					 
	private $max_singles_route;  
	
	public function __construct( $options ){
															 	
		parent::__construct( $options );
		$this->via1_criteria                  = $options['via1_criteria'];
		$this->via1_criteria_location_type    = $options['via1_criteria_location_type'];
		$this->carrier2_criteria              = $options['carrier2_criteria'];
		$this->enable_online                  = $options['enable_online'];
		$this->inter_airport_connections      = $options['inter_airport_connections'];
		$this->low_cost_connections_indicator = $options['low_cost_connections_indicator'];
		$this->max_ct1						  = $options['max_ct1'];
		$this->max_elapsed_time				  = $options['max_elapsed_time'];
		$this->max_circuity					  = $options['max_circuity'];
		$this->override_min_ct1			      = $options['override_min_ct1'];
		$this->max_singles_route			  = $options['max_singles_route'];	
		 
	}//Finaliza el constructor
	
	public function getVia1Criteria(){
		return $this->via1_criteria;
	}
	
	public function setVia1Criteria($via1_criteria){
		$this->via1_criteria = $via1_criteria;
	}
	
	public function getVia1CriteriaLocationType(){
		return $this->via1_criteria_location_type;
	}
	
	public function setVia1CriteriaLocationType($via1_criteria_location_type){
		$this->via1_criteria_location_type = $via1_criteria_location_type;
	}
	
	public function getCarrier2Criteria(){
		return $this->carrier2_criteria;
	}
	
	public function setCarrier2Criteria($carrier2_criteria){
		$this->carrier2_criteria = $carrier2_criteria;
	}
	
	public function getEnableOnline(){
		return $this->enable_online;
	}
	
	public function setEnableOnline($enable_online){
		$this->enable_online = $enable_online;
	}
	
	public function getInterAirportConnections(){
		return $this->inter_airport_connections;
	}
	
	public function setInterAirportConnections($inter_airport_connections){
		$this->inter_airport_connections = $inter_airport_connections;
	}
	
	public function getLowCostConnectionsIndicator(){
		return $this->low_cost_connections_indicator;
	}
	
	public function setLowCostConnectionIndicator($low_cost_connections_indicator){
		$this->low_cost_connections_indicator = $low_cost_connections_indicator;
	}
	
	public function getMaxCt1(){
		return $this->max_ct1;
	}
	
	public function setMaxCt1($max_ct1){
		$this->max_ct1 = $max_ct1;
	}
	
	public function getMaxElapsedTime(){
		return $this->max_elapsed_time;
	}
	
	public function setMaxElapsedTime($max_elapsed_time){
		$this->max_elapsed_time = $max_elapsed_time;
	}
	
	public function getMaxCircuity(){
		return $this->max_circuity;
	}
	
	public function setMaxCircuity($max_circuity){
		$this->max_circuity = $max_circuity;
	}
	
	public function getOverrideMinCt1(){
		return $this->override_min_ct1;
	}
	
	public function setOverrideMinCt1($override_min_ct1){
		$this->override_min_ct1 = $override_min_ct1;
	}
	
	public function getMaxSinglesRoute(){
		return $this->max_singles_route;
	}
	
	public function setMaxSingleRoute($max_singles_route){
		$this->max_singles_route = $max_singles_route;
	}
								 
}//Finaliza la clase ConnectionFLight