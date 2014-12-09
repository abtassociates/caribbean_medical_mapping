<?php

class ProprietorInformation extends \Eloquent {
	
	protected $table = 'proprietor_information';
	protected $guarded = array('id');
	public $timestamps = false;

	public function getJobCategoryList(){
		$list = array(
			"Physician - general practitioner",
			"Physician - specialist",
			"Dentist",
			"Nurse",
			"Pharmacist",
			"Pharmacy Technician",
			"Executive Director/Administrator",
			"Lab Technician",
			"Other"
		);
		return $list;
	}

  public static function getProprietorList($first_blank=false){
      $result = self::orderBy('fullname')->get(['fullname']);
      $props = $first_blank ? array(''=>'') : array();
      foreach($result->toArray() as $row){
      	$props[$row['fullname']] = $row['fullname'];
      }
      return $props;

  }
}