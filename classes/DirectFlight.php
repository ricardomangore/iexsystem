<?php

class DirectFlight{
	
	
	private $origin_criteria;
	private $destination_criteria;
	private $request_date;
	private $origin_criteria_location_type;
	private $destination_criteria_location_type;
	private $request_time;
	private $carrier1_criteria;
	private $sort_order;
	private $include_freighter;
	private $include_road_feeder_service;
	private $wide_to_narrow_indicator;
	private $cargo_carrier_dupe_priority;
	
	
	
	
	public function __construct( $options ){
								 	
		$this->origin_criteria_location_type       = $options['origin_criteria_location_type'];
		$this->destination_criteria_location_type  = $options['destination_criteria_location_type'];
		$this->request_time					       = $options['request_time'];
	    $this->carrier1_criteria				   = $options['carrier1_criteria'];
	    $this->sort_order						   = $options['sort_order'];
		$this->include_freighter				   = $options['include_freighter'];
		$this->include_road_feeder_service         = $options['include_road_feeder_service'];
		$this->wide_to_narrow_indicator			   = $options['wide_to_narrow_indicator'];
		$this->cargo_carrier_dupe_priority         = $options['cargo_carrier_dupe_priority'];
		 
	}
	
	public function getOriginCriteria(){
		return $this->origin_criteria;
	}
	
	public function setOriginCriteria($origin_criteria){
		$this->origin_criteria = $origin_criteria;
	}
	
	public function getDestinationCriteria(){
		return $this->destination_criteria;
	}
	
	public function setDestinationCriteria($destination_criteria){
		$this->destination_criteria = $destination_criteria;
	}
	
	public function getRequestDate(){
		return $this->request_date;
	}
	
	public function setRequestDate($request_date){
		$this->request_date = $request_date;
	}
		
	public function getOriginCriteriaLocationType(){
		return $this->origin_criteria_location_type;
	}
	
	public function setOriginCriteriaLocationType($origin_criteria_location_type){
		$this->origin_criteria_location_type = $origin_criteria_location_type;
	}	
	
	public function getDestinationCriteriaLocationType(){
		return $this->destination_criteria_location_type;
	}						 
	
	public function setDestinationCriteriaLocationType($destination_criteria_location_type){
		$this->destination_criteria_location_type = $destination_criteria_location_type;
	}
	
	public function getRequestTime(){
		return $this->request_time;
	}
	
	public function setRequestTime($request_time){
		$this->request_time = $request_time;
	}	
	
	public function getCarrier1Criteria(){
		return $this->carrier1_criteria;
	}						 
	
	public function setCarrier1Criteria($carrier1_criteria){
		$this->carrier1_criteria = $carrier1_criteria;
	}
	
	public function getSortOrder(){
		return $this->sort_order;
	}
	
	public function setSortOrder($sort_order){
		$this->sort_order = $sort_order;
	}
	
	public function getIncludeFreighter(){
		return $this->include_freighter;
	}
	
	public function setIncludeFreighter($include_freighter){
		$this->include_freighter = $include_freighter;
	}
	
	public function getIncludeRoadFeederService(){
		return $this->include_road_feeder_service;
	}
	
	public function setIncludeRoadFeederService($include_road_feeder_service){
		$this->include_road_feeder_service = $include_road_feeder_service;
	}
	
	public function getWideToNarrowIndicator(){
		return $this->wide_to_narrow_indicator;
	}
	
	public function setWideToNarrowIndicator($wide_to_narrow_indicator){
		$this->wide_to_narrow_indicator = $wide_to_narrow_indicator;
	}
	
	public function getCargoCarrierDupePriority(){
		return $this->cargo_carrier_dupe_priority;
	}
	
	public function setCargoCarrierDupePriority($cargo_carrier_dupe_priority){
		$this->cargo_carrier_dupe_priority = $cargo_carrier_dupe_priority;
	}							 
								 
}