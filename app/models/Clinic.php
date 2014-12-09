<?php

class Clinic extends \Eloquent {

	protected $table = 'clinic';
	protected $guarded = array('id');
    protected $softDelete = true;

    public function users()
    {
        return $this->belongsToMany('User');
    }

    public static function getNew(){

        $facility = new Clinic;
        $facility->facilityInformation = new FacilityInformation;
        $facility->healthRecordsAndReporting = new HealthRecordsAndReporting;
        $facility->hivAidsServices = new HivAidsServices;
        $facility->laboratoryAndPharmacyServices = new LaboratoryAndPharmacyServices;
        $facility->paymentForHealthServices = new PaymentForHealthServices;
        $facility->proprietorInformation = new ProprietorInformation;
        $facility->serviceAvailabilityAndUtilization = new ServiceAvailabilityAndUtilization;
        $facility->staffingAndEquipment = new StaffingAndEquipment;

        return $facility;

    }

    public static function findFull($id, $columns = array())
    {
        $facility = parent::with(array(
            'facilityInformation', 
            'ProprietorInformation',
            'lastUpdatedBy',
            'errors' => function($query){
                $query->whereNull('resolved_by');
            }
        ))->find($id);

        if($facility){
            $f = clone $facility;
            $facility->status = $f->facilityInformation->getStatus();
            $facility->phone = HTML::formatPhone($f->ProprietorInformation->telephone);
        }

        return $facility;

    }

    public static function saveAll($models)
    {
        if(!$models['Clinic']['lat']){$models['Clinic']['lat'] = null;}
        if(!$models['Clinic']['lng']){$models['Clinic']['lng'] = null;}
        $facility = Clinic::create($models['Clinic']);
        unset($models['Clinic']);
        foreach($models as $model => $vals)
        {   
            $vals['clinic_id'] = $facility->id;
            $str = "return {$model}::create(\$vals);";
            $m = eval($str);
        }

        return $facility;
    }

    // link up the relationship of all the flags on this issue
    public function errors()
    {
        return $this->hasMany('Error');
    }

    public function facilityInformation()
    {
        return $this->hasOne('FacilityInformation');
    }

    public function lastUpdatedBy()
    {
        return $this->belongsTo('User', 'last_updated_by');
    }

    public function getLastUpdated()
    {
        $date = date("M Y", strtotime($this->updated_at));
        return $date;
    }

    public function getLastUpdatedBy()
    {
        $name = ($p = $this->lastUpdatedBy) ?
                $p->fullName() :
                null;

        return $name;
    }

    public function getUpdateString(){

        $str = $this->getLastUpdated();

        if($name = $this->getLastUpdatedBy()){
            $str .= " by {$name}";
        }

        return $str;
    }

	public function healthRecordsAndReporting()
    {
        return $this->hasOne('HealthRecordsAndReporting');
    }

	public function hivAidsServices()
    {
        return $this->hasOne('HivAidsServices');
    }

	public function laboratoryAndPharmacyServices()
    {
        return $this->hasOne('LaboratoryAndPharmacyServices');
    }

	public function paymentForHealthServices()
    {
        return $this->hasOne('PaymentForHealthServices');
    }

	public function proprietorInformation()
    {
        return $this->hasOne('ProprietorInformation');
    }

	public function serviceAvailabilityAndUtilization()
    {
        return $this->hasOne('ServiceAvailabilityAndUtilization');
    }

	public function staffingAndEquipment()
    {
        return $this->hasOne('StaffingAndEquipment');
    }

    public function nextId()
    {
        return self::where('id', '>', $this->id)->min('id');
    }

    public function prevId()
    {
        return self::where('id', '<', $this->id)->max('id');
    }

    public static function getSectorList($add_blank = false){

        $array = Sector::orderBy('name')->get()->lists('name', 'id');

        if($add_blank){
            $array = [''=>''] + $array;
        }
        return $array;
    }

    public static function getMedicineList($add_blank = false){
        $array = array(
            'availdic' => 'Diclofenac',
            'availpara' => 'Paracetamol',
            'availcotri' => 'Cotrimoxazole',
            'availpeni' => 'Penicillin',
            'availcipro' => 'Ciprofloxacin',
            'availamox' => 'Amoxicillin',
            'availmetro' => 'Metronidazole',
            'availsalbu' => 'Salbutamol Inhaler',
            'availgilb' => 'Glibenclamide',
            'availateno' => 'Atenolol',
            'availsimva' => 'Simvastatin',
            'availcap' => 'Captopril',
            'availome' => 'Omeprazole'
        );
        asort($array);

        if($add_blank){
            $array = array_merge([''=>''], $array);
        }
        
        return $array;
    }

    public function medicineList()
    {
        $obj = $this->laboratoryAndPharmacyServices;
        if(!$obj){return array();}
        $props = self::getMedicineList();
        return $this->setValArray($obj, $props);;
    }

    public static function getServiceList($add_blank = false){
        $array = array(
            'pedcare' => 'Pediatric Care',
            'rep' => 'Reproductive Health and Family Planning',
            'ante' => 'Antenatal care',
            'labor' => 'Labor and Delivery services',
            'hyper' => 'Hypertension care',
            'diab' => 'Diabetes care',
            'cancer' => 'Cancer detection',
            'cancertreat' => 'Cancer treatment',
            'drug' => 'Drug/Alcohol abuse prevention or treatment services',
            'stidiag' => 'Sexually Transmitted Infections diagnosis',
            'stitreat' => 'Sexually Transmitted Infections treatment',
            'hct' => 'HIV counseling',
            'hivtest' => 'HIV testing',
            'social' => 'Social services/support',
            'hivout' => 'HIV information, education, and outreach',
            'condom' => 'Condom distribution/or social marketing of condoms',
            'nutri' => 'Nutrition/dietary services',
            'surgerylocal' => 'Surgery (local anesthesia)',
            'surgerygen' => 'Surgery (general anesthesia)',
            'oral' => 'Oral hygiene and dental care'
        );
        asort($array);

        if($add_blank){
            $array = array_merge([''=>''], $array);
        }
        
        return $array;
    }

    public function serviceList()
    {
        $obj = $this->serviceavailabilityAndUtilization;
        if(!$obj){return array();}
        $props = self::getServiceList();
        return $this->setValArray($obj, $props);;
    }

    public static function getSpecialtiesList()
    {
        $list = Clinic::orderBy('specialty')
            ->groupBy('specialty')
            ->where('specialty', '!=', '')
            ->lists('specialty', 'specialty');

        $list = array(""=>"")+$list;

        return $list;
    }

    public static function getSpecialtiesArray()
    {
        $list = Clinic::orderBy('specialty')
            ->groupBy('specialty')
            ->where('specialty', '!=', '')
            ->lists('specialty');

        return $list;
    }

    public function getDistance($currentPosition, $unit = "miles")
    {
        if(!$this->lat || !$this->lng){
            return "unknown";
        }

        $lat1 = $currentPosition['lat'];
        $lng1 = $currentPosition['lng'];
        $lat2 = $this->lat;
        $lng2 = $this->lng;

        $theta = $lng1 - $lng2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;

        if($unit == "miles"){
            $distance = $miles;
        }
        if($unit == "kilometers"){
            $distance = $miles * 1.609344;
        }

        $distance = round($distance, 1);

        return "{$distance} {$unit}";
    }

    public static function getEquipmentList($add_blank = false){

        $array = array(
            'eqherecent' => 'Centrifuge',
            'eqheretherm' => 'Thermocycler',
            'eqherestab' => 'Stabilizer',
            'eqheretemp' => 'Temperature Control Refrigerator',
            'eqheredead' => 'Dead Box',
            'eqherexfilm' => 'X-ray Machine (Film)',
            'eqherexdig' => 'X-ray Machine (Digital)',
            'eqherect' => 'CT Scan',
            'eqheremri' => 'MRI',
            'eqhereecg' => 'ECG',
            'eqhereaed' => 'Automated External Defibrillator (AED)',
            'eqheredef' => 'Defibrillator',
            'eqhereult' => 'Ultrasound',
            'eqheredia' => 'Dialysis Machine',
            'eqherecd4' => 'CD4 machine',
            'eqherepcr' => 'PCR viral load machine',
            'eqhereanes' => 'Anesthesia equipment',
            'eqherehema' => 'Hematology Analyzer',
            'eqhererapid' => 'HIV Rapid Tests',
            'eqhereuri' => 'Urinalysis test strips',
            'eqhereglu' => 'Glucose strips'
        );
        asort($array);

        if($add_blank){
            $array = array_merge([''=>''], $array);
        }
        return $array;
    }

    public function equipmentList(){
        $obj = $this->staffingAndEquipment;
        if(!$obj){return array();}
        $props = self::getEquipmentList();

        $array = array();
        foreach($props as $slug => $name){
            $funcprop = str_replace('here', 'func', $slug);
            $array[] = array(
                "slug" => $slug,
                "name" => $name,
                "val" => $obj->{$slug} && $obj->{$funcprop}
            );
        }
        return $array;

    }

    public static function getPositionList(){
        $array = array(
            'empphys' => 'Physicians',
            'empphysassist' => 'Physician Assistants',
            'empphysspec' => 'Physician, Specialists',
            'empnurse' => 'Nurses',
            'empnursassist' => 'Nurse Assistants',
            'emppharm' => 'Pharmacists',
            'emppharmtech' => 'Pharmacy Technicians',
            'emplabtech' => 'Laboratory Technicians',
            'empdentist' => 'Dentists',
            'empdentassist' => 'Dental Assistants',
            'emptech' => 'Technical/Clerical Assistants',
            'empadmin' => 'Administrative/Clerical Staff',
            'empnonadmin' => 'Non-administrative Staff',
            'empout' => 'Outreach Workers',
            'empvolun' => 'Volunteers'
        );
        asort($array);
        return $array;
    }

    public function fullTimeList(){
        $obj = $this->staffingAndEquipment;
        $props = self::getPositionList();
        return $this->setValArray($obj, $props);
    }

    public function partTimeList(){
        $obj = $this->staffingAndEquipment;
        $props = self::getPositionList();
        $propspart = array();
        foreach($props as $key => $prop){
            $propspart[$key."part"] = $prop;
        }
        return $this->setValArray($obj, $propspart);
    }

    private function setValArray($obj, $props)
    {
        $array = array();
        foreach($props as $slug => $name){
            $array[] = array(
                "slug" => $slug,
                "name" => $name,
                "val" => $obj->{$slug}
            );
        }
        return $array;
    }

    public static function getAllPharmacies(){
        $f = Clinic::select('clinic.*');
        $f->join('facility_information', 'facility_information.clinic_id', '=', 'clinic.id');
        $f->where('facility_information.facilitytype','=','Pharmacy');
        $f->orderBy('clinic.facilityname');

//        $facilities = Clinic::orderBy('facilityname')->get();
        $facilities = $f->get();

        $names = array(''=>'');
        foreach($facilities as $facility){
            $names[$facility->facilityname] = $facility->facilityname;
        }
        return $names;
    }

    public static function getAllNames(){

        $facilities = Clinic::orderBy('facilityname')->get();

        $names = array(''=>'');
        foreach($facilities as $facility){
            $names[$facility->facilityname] = $facility->facilityname;
        }
        return $names;
    }

    public static function getAllIdsAndNames(){

        $facilities = Clinic::orderBy('facilityname')->get();

        $names = array(''=>'');
        foreach($facilities as $facility){
            $names[$facility->id] = $facility->facilityname;
        }
        return $names;
    }

    public static function filtered($filters = null, $currentPosition = null, $base_uri="/facilities"){

        $clinic = Clinic::with(array(
            'facilityInformation', 
            'ProprietorInformation',
            'lastUpdatedBy',
            'errors' => function($query){
                $query->whereNull('resolved_by');
            }
        ))->select('clinic.*');


        if($filters){

            if(isset($filters['sector_id']) && $filters['sector_id']){

                $clinic->where("clinic.sector_id", '=', $filters['sector_id']);

            }

            if(isset($filters['facilityname']) && $filters['facilityname']){

                $clinic->where("clinic.facilityname", '=', $filters['facilityname']);

            }

            if(isset($filters['specialty']) && $filters['specialty']){

                $clinic->where("clinic.specialty", '=', $filters['specialty']);

            }

            if(isset($filters['proprietor']) && $filters['proprietor']){

                $clinic->leftJoin('proprietor_information', 'clinic.id', '=', 'proprietor_information.clinic_id');
                $clinic->where("proprietor_information.fullname", '=', $filters['proprietor']);

            }

            if(isset($filters['services']) && $filters['services']){

                $clinic->leftJoin('service_availability_and_utilization', 'clinic.id', '=', 'service_availability_and_utilization.clinic_id');

                foreach($filters['services'] as $service){
                    $clinic->where("service_availability_and_utilization.{$service}", '=', 1);
                }

            }

            if((isset($filters['equipment']) && $filters['equipment']) || (isset($filters['positions']) && $filters['positions'])){

                $clinic->leftJoin('staffing_and_equipment', 'clinic.id', '=', 'staffing_and_equipment.clinic_id');

                if(isset($filters['equipment']) && $filters['equipment']){
                    foreach($filters['equipment'] as $equipment){
                        $funcfield = str_replace('eqhere', 'eqfunc', $equipment);
                        $clinic->where("staffing_and_equipment.{$equipment}", '=', 1);
                        $clinic->where("staffing_and_equipment.{$funcfield}", '=', 1);
                    }
                }

                if(isset($filters['positions']) && $filters['positions']){
                    foreach($filters['positions'] as $position){
                        $clinic->where(function ($query) use ($position) {
                            $query->where("staffing_and_equipment.{$position}", '=', 1)
                                  ->orWhere("staffing_and_equipment.{$position}part", '=', 1);
                        });
                    }
                }
            }

        } 

        $clinic->orderBy('clinic.facilityname');

        $clinics = $clinic->get();

        // loop through and add in position and status info
        foreach($clinics as $i => $clinic){
            $c = clone $clinic;
            $clinics[$i]->uri = "{$base_uri}/{$clinic->id}";
            if($currentPosition){
                $clinics[$i]->distance = $clinic->getDistance($currentPosition);
            }
            $clinics[$i]->status = $c->facilityInformation->getStatus();
            $clinics[$i]->phone = HTML::formatPhone($c->ProprietorInformation->telephone);
        }

        return $clinics;

    }


    public static function getFull($id){

        $clinic = self::find($id);

        $response = $clinic->toArray();
        $response["last_updated_by"] = $clinic->getLastUpdatedBy();
        $response["facilityInformation"] = $clinic->facilityInformation->toArray();
        $response["healthRecordsAndReporting"] = $clinic->healthRecordsAndReporting->toArray();
        $response["hivAidsServices"] = $clinic->hivAidsServices->toArray();
        $response["laboratoryAndPharmacyServices"] = $clinic->laboratoryAndPharmacyServices->toArray();
        $response["paymentForHealthServices"] = $clinic->paymentForHealthServices->toArray();
        $response["proprietorInformation"] = $clinic->proprietorInformation->toArray();
        $response["staffingAndEquipment"] = $clinic->staffingAndEquipment->toArray();

        return $response;
    }

    public static function update_facility_term_dependent_responses($facility_term){
        
        $records = ServiceAvailabilityAndUtilization::where('referhow', 'LIKE', 'Contact prospective %/provider by phone')->get();
        foreach($records as $record){
            $record->referhow = "Contact prospective " . $facility_term  . " by phone";
            $record->save();
        }

        $records = ServiceAvailabilityAndUtilization::where('refertohow', 'LIKE', 'Contacted by % by phone')->get();
        foreach($records as $record){
            $record->refertohow = "Contacted by " . $facility_term  . " by phone";
            $record->save();
        }

    }
}
