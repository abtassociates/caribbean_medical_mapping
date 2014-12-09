<?php

class FacilityInformation extends \Eloquent {
	
	protected $table = 'facility_information';
	protected $guarded = array('id');
	public $timestamps = false;
	private $tz = null;

	// get the current status of the facility as 'open', 'closed', 'on-call', or null
	// this uses the app's timezone (set in app/config/local/app.php) compared to the
	// listed hours for the facility. It always considers whether current time is
	// between open and close times unless, there are no open or close AND the status
	// is listed as "on call" in which case it let's status be "on call"
	public function getStatus(){

		$current_day_abbrev = strtolower(date("D", time()));

		// fix diff between how this app abbreviates "thursday" and how php does it
		if($current_day_abbrev=="thu"){$current_day_abbrev = "thur";}

		$current_time = date("G:i", time()).":00";
		$todays_status = $this->{$current_day_abbrev};
		$todays_open = $this->{$current_day_abbrev.'open'};
		$todays_close = $this->{$current_day_abbrev.'close'};

		// start assuming place is closed
		$status = "Closed";

		// if we're with in timeframe...
		if(strtotime($todays_open)<=strtotime($current_time) && strtotime($current_time)<=strtotime($todays_close)){

			// and it's supposed to be open or on call...
			if($todays_status=="Open" || $todays_status=="On Call"){
				$status = $todays_status;
			}

		}

		// if we were given no time frame parameters, but it's got a listed status of "on call"...
		if(is_null($todays_open) && is_null($todays_close) && $todays_status=="On Call"){
			$status = "On Call";
		}


		return $status;

	}
}