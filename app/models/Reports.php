<?php

class Reports {

    private static function pivot($category_label, $tally_label, $data){

        if(is_array($data)){$data = $data[0];}

        $response = array();
        foreach($data as $prop => $val){
            $row = new stdClass();
            $row->{$category_label} = str_replace("_", " ", $prop);
            $row->{$tally_label} = $val;
            $response[] = $row;
        }
        return $response;
    }

	public static function getList(){
		$reports_path = app_path()."/views/reports";
        $reports = scandir($reports_path);

        // get only files
        $reports = array_filter($reports, function($el) use ($reports_path){
            return is_file("{$reports_path}/{$el}");
        });

        // remove index file
        $reports = array_filter($reports, function($el) use ($reports_path){
            return strpos($el, "index") === false;
        });

        $reports = array_map(function($el){
        	return substr($el, 0, stripos($el, "."));
        }, $reports);

        return $reports;
	}

    public static function facilityByEquipment($sector_id = null, $equipment = null){

        $f = Clinic::select('clinic.*');
        $f->join('staffing_and_equipment', 'staffing_and_equipment.clinic_id', '=', 'clinic.id');
        $f->orderBy('clinic.facilityname');

        if($sector_id){
            $f->where('clinic.sector_id', '=', $sector_id);
        }

        if($equipment){
            $f->where("staffing_and_equipment.{$equipment}", '=', 1);
        }

        $facilities = $f->get();

        return $facilities;
    }

    public static function facilityByService($sector_id = null, $service = null){

        $f = Clinic::select('clinic.*');
        $f->join('service_availability_and_utilization', 'service_availability_and_utilization.clinic_id', '=', 'clinic.id');
        $f->orderBy('clinic.facilityname');

        if($sector_id){
            $f->where('clinic.sector_id', '=', $sector_id);
        }

        if($service){
            $f->where("service_availability_and_utilization.{$service}", '=', 1);
        }

        $facilities = $f->get();

        return $facilities;
    }

    public static function facilitiesBySector($sector_id, $base_uri = null){

        $filters = ['sector_id'=>$sector_id];

        $facilities = Clinic::filtered($filters, $currentPosition = null, $base_uri);

        return $facilities;

    }

    public static function addStatus($facilities)
    {
        foreach($facilities as $i => $facility){
            $facilities[$i]->status = $facility->FacilityInformation->getStatus();
        }

        return $facilities;

    }

    public static function facilitiesByNameServiceAndSpecialty($name, $service, $specialty){

        $f = Clinic::select('clinic.*');

        if($name){
            $f->where('facilityname', '=', $name);
        }

        if($specialty){
            $f->where('clinic.specialty', '=', $specialty);
        }

        if($service){
            $f->leftJoin('service_availability_and_utilization', 'clinic.id', '=', 'service_availability_and_utilization.clinic_id');
            $f->where("service_availability_and_utilization.{$service}", '=', 1);
        }

        if($name || $service || $specialty){
            $facilities = $f->get();
        }else{
            $facilities = array();
        }

        return $facilities;
    }

    public static function facilitiesByName($name){

        $facility = Clinic::where('facilityname', '=', $name)->get();

        return $facility;
    }

    public static function facilitiesWithSpecialists($sector_id = null){

        $f = Clinic::select('clinic.*');
        $f->join('staffing_and_equipment', 'staffing_and_equipment.clinic_id', '=', 'clinic.id');
        $f->whereNotNull('staffing_and_equipment.empphysspectypes');
        $f->orderBy('clinic.facilityname');

        if($sector_id){
            $f->where('clinic.sector_id', '=', $sector_id);
        }

        $facilities = $f->get();

        return $facilities;
    }

    public static function facilitiesWithSpecialServices($sector_id = null){

        $f = Clinic::select('clinic.*');
        $f->join('service_availability_and_utilization', 'service_availability_and_utilization.clinic_id', '=', 'clinic.id');
        $f->whereNotNull('service_availability_and_utilization.specialtyspec');
        $f->orderBy('clinic.facilityname');

        if($sector_id){
            $f->where('clinic.sector_id', '=', $sector_id);
        }

        $facilities = $f->get();

        $facilities = self::attachBulletList(
            $facilities,
            "specialtyBullets",
            ['serviceAvailabilityAndUtilization', 'specialtyspec']
        );

        return $facilities;
    }

    public static function facilitiesWithVisitingSpecialists($sector_id = null){

        $f = Clinic::select('clinic.*');
        $f->join('service_availability_and_utilization', 'service_availability_and_utilization.clinic_id', '=', 'clinic.id');
        $f->whereNotNull('service_availability_and_utilization.specialtyvisitspec');
        $f->orderBy('clinic.facilityname');

        if($sector_id){
            $f->where('clinic.sector_id', '=', $sector_id);
        }

        $facilities = $f->get();

        $facilities = self::attachBulletList(
            $facilities,
            'specialtyBullets',
            ['serviceAvailabilityAndUtilization','specialtyvisitspec']
        );

        return $facilities;
    }

    private static function attachBulletList($facilities, $newProp, $old_prop){

        if(is_string($old_prop)){$old_prop = [$old_prop];}

        foreach($facilities as $i => $facility){
            $text = $facility;
            foreach($old_prop as $prop){$text = $text->$prop;}
            $specialtyBullets = "<ul>";
            foreach(explode(",", $text) as $piece){
                $specialtyBullets.= "<li>".trim($piece)."</li>";
            }
            $specialtyBullets.= "</ul>";
            $facilities[$i]->$newProp = $specialtyBullets;
        }
        return $facilities;
    }


    public static function pharmaciesAll($sector_id = null){

        $f = Clinic::select('clinic.*');
        $f->join('facility_information', 'facility_information.clinic_id', '=', 'clinic.id');
        $f->where('facility_information.facilitytype','=','Pharmacy');

        if($sector_id){
            $f->where('clinic.sector_id', '=', $sector_id);
        }

        $facilities = $f->get();

        return $facilities;
    }

    public static function pharmaciesByName($name){

        $facility = Clinic::where('facilityname', '=', $name)->get();

        return $facility; 
     }

    public static function hivHctProviders($sector_id = null){

        $f = Clinic::select('clinic.*');
        $f->join('hiv_aids_services', 'hiv_aids_services.clinic_id', '=', 'clinic.id');
        $f->where('hiv_aids_services.hcttrain', '=', 1);
        $f->whereNotNull('hiv_aids_services.hcttraintime');
        $f->orderBy('hiv_aids_services.hcttraintime');
        $f->orderBy('clinic.facilityname');

        if($sector_id){
            $f->where('clinic.sector_id', '=', $sector_id);
        }

        $facilities = $f->get();

        return $facilities;
    }

    public static function hivTrainingProviders($sector_id = null){

        $f = Clinic::select('clinic.*');
        $f->join('hiv_aids_services', 'hiv_aids_services.clinic_id', '=', 'clinic.id');
        $f->where('hiv_aids_services.testing', '=', 1);
        $f->orderBy('clinic.facilityname');

        if($sector_id){
            $f->where('clinic.sector_id', '=', $sector_id);
        }

        $facilities = $f->get();

        return $facilities;
    }

    public static function hivCounselingProviders($sector_id = null){

        $f = Clinic::select('clinic.*');
        $f->join('hiv_aids_services', 'hiv_aids_services.clinic_id', '=', 'clinic.id');
        $f->where('hiv_aids_services.hc', '=', 1);
        $f->orderBy('clinic.facilityname');

        if($sector_id){
            $f->where('clinic.sector_id', '=', $sector_id);
        }

        $facilities = $f->get();

        return $facilities;
    }


    public static function hivAidsResourseSummary($sector_id = null){

        //HIV Services Offered, by Type
        $hivtype = DB::table('hiv_aids_services');
        $hivtype ->select(DB::raw('sum(hiv_aids_services.hc) as "HIV Counseling", 
            sum(hiv_aids_services.testing) as "HIV Testing",
            sum(hiv_aids_services.pmtct) as "PMTCT",
            sum(hiv_aids_services.hivtreat) as "HIV Treatment"
            '));
        if($sector_id){
            $hivtype->join('clinic', 'hiv_aids_services.clinic_id', '=', 'clinic.id');
            $hivtype->where('clinic.sector_id', '=', $sector_id);
        }
        $data['hiv_aids_services_type'] = self::pivot('label','number', $hivtype->get());

       //HIV Equipment
        $hivequip = DB::table('staffing_and_equipment');
        $hivequip->select(DB::raw('
            sum(staffing_and_equipment.eqherecd4) as "CD4 Machine",
            sum(staffing_and_equipment.eqhererapid) as "HIV Rapid Test",
            sum(staffing_and_equipment.eqherepcr) as "PCR Viral Load Machine"
            '));
        if($sector_id){
            $hivequip->join('clinic', 'staffing_and_equipment.clinic_id', '=', 'clinic.id');
            $hivequip->where('clinic.sector_id', '=', $sector_id);
        }
        $data['hiv_equipment'] = self::pivot('label','number', $hivequip->get());

        //HIV Time Since Training 
        $hivtst = DB::table('hiv_aids_services');
        $hivtst->select(DB::raw('hiv_aids_services.hcttraintime as label, count(*) as number'));
        $hivtst->whereNotNull('hiv_aids_services.hcttraintime');
        $hivtst->groupBy('hiv_aids_services.hcttraintime');
        if($sector_id){
            $hivtst->join('clinic', 'hiv_aids_services.clinic_id', '=', 'clinic.id');
            $hivtst->where('clinic.sector_id', '=', $sector_id);
        }
        $data['hiv_time_since_training'] = $hivtst->get();

        //HIV Test Types 
        $hivtesttype = DB::table('hiv_aids_services');
        $hivtesttype->where('hiv_aids_services.testing', '=', 1);
        $hivtesttype ->select(DB::raw('
            sum(hiv_aids_services.blooddraw) as "Blood draw sent to other facility for analysis",
            sum(hiv_aids_services.elisa) as "ELISA",
            sum(hiv_aids_services.rapidtest) as "Rapid Test",
            sum(hiv_aids_services.westernblot) as "Western Blot"
            '));
        if($sector_id){
            $hivtesttype->join('clinic', 'hiv_aids_services.clinic_id', '=', 'clinic.id');
            $hivtesttype->where('clinic.sector_id', '=', $sector_id);
        }
        $data['hiv_test_types'] = self::pivot('label','number', $hivtesttype->get());

//Number of Facilities offering Testing for Opportunistic Infections, by OI Type
 // Multiple Yes / No Counts        
        $candidiasis = DB::table('hiv_aids_services');
        $candidiasis->select(
            array(
                DB::raw('sum(candidtest) as "Conduct Test"'), 
                DB::raw('sum(candidsample) as "Collect Sample"')
                )
            );
        if($sector_id){
            $candidiasis->join('clinic', 'hiv_aids_services.clinic_id', '=', 'clinic.id');
            $candidiasis->where('clinic.sector_id', '=', $sector_id);
        }
        $data['Candidiasis'] = $candidiasis->get();
        
//
        $cytomegalovirus = DB::table('hiv_aids_services');
        $cytomegalovirus->select(
            array(
                DB::raw('sum(cytotest) as "Conduct Test"'), 
                DB::raw('sum(cytosample) as "Collect Sample"')
                )
            );
        if($sector_id){
            $cytomegalovirus->join('clinic', 'hiv_aids_services.clinic_id', '=', 'clinic.id');
            $cytomegalovirus->where('clinic.sector_id', '=', $sector_id);
        }
        $data['Cytomegalovirus'] = $cytomegalovirus->get();

//Herpes Simplex viruses
        $herpes = DB::table('hiv_aids_services');
        $herpes->select(
            array(
                DB::raw('sum(herpestest) as "Conduct Test"'), 
                DB::raw('sum(herpessample) as "Collect Sample"')
                )
            );
        if($sector_id){
            $herpes->join('clinic', 'hiv_aids_services.clinic_id', '=', 'clinic.id');
            $herpes->where('clinic.sector_id', '=', $sector_id);
        }
        $data['Herpes Simplex viruses'] = $herpes->get();

//Mycobacteria avium complex
        $myco = DB::table('hiv_aids_services');
        $myco->select(
            array(
                DB::raw('sum(mycotest) as "Conduct Test"'), 
                DB::raw('sum(mycosample) as "Collect Sample"')
                )
            );
        if($sector_id){
            $myco->join('clinic', 'hiv_aids_services.clinic_id', '=', 'clinic.id');
            $myco->where('clinic.sector_id', '=', $sector_id);
        }
        $data['Mycobacteria avium complex'] = $myco->get();

        $myco = DB::table('hiv_aids_services');
        $myco->select(
            array(
                DB::raw('sum(mycotest) as "Conduct Test"'), 
                DB::raw('sum(mycosample) as "Collect Sample"')
                )
            );
        if($sector_id){
            $myco->join('clinic', 'hiv_aids_services.clinic_id', '=', 'clinic.id');
            $myco->where('clinic.sector_id', '=', $sector_id);
        }
        $data['Mycobacteria avium complex'] = $myco->get();

//Pneumocystis pneumonia
        $pneumo = DB::table('hiv_aids_services');
        $pneumo->select(
            array(
                DB::raw('sum(pneumotest) as "Conduct Test"'), 
                DB::raw('sum(pneumosample) as "Collect Sample"')
                )
            );
        if($sector_id){
            $pneumo->join('clinic', 'hiv_aids_services.clinic_id', '=', 'clinic.id');
            $pneumo->where('clinic.sector_id', '=', $sector_id);
        }
        $data['Pneumocystis pneumonia'] = $pneumo->get();

//Toxoplasmosis
        $tox = DB::table('hiv_aids_services');
        $tox->select(
            array(
                DB::raw('sum(toxtest) as "Conduct Test"'), 
                DB::raw('sum(toxsample) as "Collect Sample"')
                )
            );
        if($sector_id){
            $tox->join('clinic', 'hiv_aids_services.clinic_id', '=', 'clinic.id');
            $tox->where('clinic.sector_id', '=', $sector_id);
        }
        $data['Toxoplasmosis'] = $tox->get();

//Tuberculosis
        $tuber = DB::table('hiv_aids_services');
        $tuber->select(
            array(
                DB::raw('sum(tubertest) as "Conduct Test"'), 
                DB::raw('sum(tubersample) as "Collect Sample"')
                )
            );
        if($sector_id){
            $tuber->join('clinic', 'hiv_aids_services.clinic_id', '=', 'clinic.id');
            $tuber->where('clinic.sector_id', '=', $sector_id);
        }
        $data['Tuberculosis'] = $tuber->get();

        $data['oi_services'] = array(
            'Candidiasis' =>  $data['Candidiasis'],
            'Cytomegalovirus' => $data['Cytomegalovirus'],
            'Herpes Simplex viruses' => $data['Herpes Simplex viruses'],
            'Mycobacteria avium complex' => $data['Mycobacteria avium complex'],
            'Pneumocystis pneumonia' => $data['Pneumocystis pneumonia'],
            'Toxoplasmosis' => $data['Toxoplasmosis'],
            'Tuberculosis' => $data['Tuberculosis']
            );

        //HIV Referrals 
        $hivrefer = DB::table('hiv_aids_services');
        $hivrefer->select(DB::raw('hiv_aids_services.hivrefer as label, count(*) as number'));
        $hivrefer->groupBy('hiv_aids_services.hivrefer');
        $hivrefer->whereNotNull('hiv_aids_services.hivrefer');
        if($sector_id){
            $hivrefer->join('clinic', 'hiv_aids_services.clinic_id', '=', 'clinic.id');
            $hivrefer->where('clinic.sector_id', '=', $sector_id);
        }
        $data['hiv_referrals'] = $hivrefer->get();

        //HIV Referrals - Other
        $hivreferother = DB::table('hiv_aids_services');
        $hivreferother->select(DB::raw('hiv_aids_services.hivreferspec as label, count(*) as number'));
        $hivreferother->whereNotNull('hiv_aids_services.hivreferspec');
        //$hivreferother->('count(hiv_aids_services.hivreferspec)','>','1');
        $hivreferother->groupBy('hiv_aids_services.hivreferspec');
        $hivreferother->where('hiv_aids_services.hivreferspec','>',1);
        if($sector_id){
            $hivreferother->join('clinic', 'hiv_aids_services.clinic_id', '=', 'clinic.id');
            $hivreferother->where('clinic.sector_id', '=', $sector_id);
        }
        $data['hiv_referrals_other'] = $hivreferother->get();


/*Number of Facilities offering HIV/AIDS Laboratory Services, by Service Type
This is a placeholder for a three part array of yes/no questions, same as OI above
need table laboratory_and_pharmacy_services
need field pairs:
 colpcr / analpcr as "PCR" 
  /  as "CD4"
*/

//HIV Lab Services

        $cd4 = DB::table('laboratory_and_pharmacy_services');
        $cd4->select(
            array(
                DB::raw('sum(colcd4) as "Collect"'), 
                DB::raw('sum(analcd4) as "Analyze"')
                )
            );
        if($sector_id){
            $cd4->join('clinic', 'laboratory_and_pharmacy_services.clinic_id', '=', 'clinic.id');
            $cd4->where('clinic.sector_id', '=', $sector_id);
        }
        $data['CD4'] = $cd4->get();

        $pcr = DB::table('laboratory_and_pharmacy_services');
        $pcr->select(
            array(
                DB::raw('sum(colpcr) as "Collect"'), 
                DB::raw('sum(analpcr) as "Analyze"')
                )
            );
        if($sector_id){
            $pcr->join('clinic', 'laboratory_and_pharmacy_services.clinic_id', '=', 'clinic.id');
            $pcr->where('clinic.sector_id', '=', $sector_id);
        }
        $data['PCR'] = $pcr->get();

        $data['hiv_lab_services'] = array(
            'CD4' =>  $data['CD4'],
            'PCR' =>  $data['PCR']
            );

       //HIV Test Types 
        $hivarv = DB::table('laboratory_and_pharmacy_services');
        $hivarv ->select(DB::raw('
            sum(laboratory_and_pharmacy_services.avail3tc) as "3TC",
            sum(laboratory_and_pharmacy_services.availatv) as "ATV/r",
            sum(laboratory_and_pharmacy_services.availazt) as "AZT",
            sum(laboratory_and_pharmacy_services.availefv) as "EFV",
            sum(laboratory_and_pharmacy_services.availftc) as "FTC",
            sum(laboratory_and_pharmacy_services.availlpv) as "LPV/r",
            sum(laboratory_and_pharmacy_services.availtdf) as "TDF"
            '));

        $data['hiv_arv'] = self::pivot('label','number', $hivarv->get());

        return $data;
    }

    public static function healthResourseSummary($sector_id = null){

        // Patient Volume
        $pv = DB::table('service_availability_and_utilization');
        $pv->select(DB::raw('sum(service_availability_and_utilization.outpatient) as outpatient, sum(service_availability_and_utilization.inpatient) as inpatient'));
        if($sector_id){
            $pv->join('clinic', 'service_availability_and_utilization.clinic_id', '=', 'clinic.id');
            $pv->where('clinic.sector_id', '=', $sector_id);
        }
        $data['patient_volume'] = $pv->get();

        // Facility Infrastructure
        $fi = DB::table('staffing_and_equipment');
        $fi->select(DB::raw('sum(staffing_and_equipment.facilityexam) as facilityexam, sum(staffing_and_equipment.facilityop) as facilityop, sum(staffing_and_equipment.facilityin) as facilityin'));
        if($sector_id){
            $fi->join('clinic', 'staffing_and_equipment.clinic_id', '=', 'clinic.id');
            $fi->where('clinic.sector_id', '=', $sector_id);
        }
        $data['facility_infrastructure'] = $fi->get();

        // Types of Facilities
        $tof = DB::table('facility_information');
        $tof->select(DB::raw('facility_information.facilitytype as facilitytype, count(*) as number'));
        $tof->groupBy('facility_information.facilitytype');
        $tof->whereNotNull('facility_information.facilitytype');
        $tof->whereNotNull('facility_information.clinic_id');
        if($sector_id){
            $tof->join('clinic', 'facility_information.clinic_id', '=', 'clinic.id');
            $tof->where('clinic.sector_id', '=', $sector_id);
        }
        $data['types_of_facilities'] = $tof->get();

        //Services Offered
        $so = DB::table('service_availability_and_utilization');
        $so ->select(DB::raw('sum(service_availability_and_utilization.ante) as "Antenatal Care", 
            sum(service_availability_and_utilization.cancer) as "Cancer Detection",
            sum(service_availability_and_utilization.cancertreat) as "Cancer Treatment",
            sum(service_availability_and_utilization.condom) as "Condom Distribution or Social Marketing of Condoms",
            sum(service_availability_and_utilization.diab) as "Diabetes Care",
            sum(service_availability_and_utilization.drug) as "Drug/Alcohol Abuse, Prevention, or Treatment Services",
            sum(service_availability_and_utilization.hivout) as "HIV Information, Education, and Outreach",
            sum(service_availability_and_utilization.hyper) as "Hypertension Care",
            sum(service_availability_and_utilization.labor) as "Labor and Delivery Services",
            sum(service_availability_and_utilization.nutri) as "Nutrition/Dietary Services",
            sum(service_availability_and_utilization.oral) as "Oral Hygiene and Dental Care",
            sum(service_availability_and_utilization.pedcare) as "Pediatric Care", 
            sum(service_availability_and_utilization.rep) as "Reproductive Health and Family Planning",
            sum(service_availability_and_utilization.stidiag) as "Sexually Transmitted Infections Diagnosis",
            sum(service_availability_and_utilization.stitreat) as "Sexually Transmitted Infections Treatment",
            sum(service_availability_and_utilization.social) as "Social Services/Support",
            sum(service_availability_and_utilization.surgerygen) as "Surgery (General Anesthesia)",
            sum(service_availability_and_utilization.surgerylocal) as "Surgery (Local Anesthesia)"
            '));
        if($sector_id){
            $so->join('clinic', 'service_availability_and_utilization.clinic_id', '=', 'clinic.id');
            $so->where('clinic.sector_id', '=', $sector_id);
        }
        $data['services_offered'] = self::pivot('label','number', $so->get());

        //Full Time Staff
        $fts = DB::table('staffing_and_equipment');
        $fts ->select(DB::raw('
            sum(staffing_and_equipment.empadmin) as "Administrative/Clerical Staff", 
            sum(staffing_and_equipment.empdentassist) as "Dental Assistants",
            sum(staffing_and_equipment.empdentist) as "Dentists",
            sum(staffing_and_equipment.emplabtech) as "Laboratory Technicians",
            sum(staffing_and_equipment.empnonadmin) as "Non-administrative Staff",
            sum(staffing_and_equipment.empnursassist) as "Nurse Assistants",
            sum(staffing_and_equipment.empnurse) as "Nurses",
            sum(staffing_and_equipment.emppharm) as "Pharmacists",
            sum(staffing_and_equipment.emppharmtech) as "Pharmacy Technicians",
            sum(staffing_and_equipment.empphysassist) as "Physician Assistants",
            sum(staffing_and_equipment.empphysspec) as "Physician, Specialists",
            sum(staffing_and_equipment.empphys) as "Physicians"
            '));
        if($sector_id){
            $fts->join('clinic', 'staffing_and_equipment.clinic_id', '=', 'clinic.id');
            $fts->where('clinic.sector_id', '=', $sector_id);
        }
        $data['full_time_staff'] = self::pivot('label','number', $fts->get());

        //Part Time Staff
        $pts = DB::table('staffing_and_equipment');
        $pts ->select(DB::raw('
            sum(staffing_and_equipment.empadminpart) as "Administrative/Clerical Staff", 
            sum(staffing_and_equipment.empdentassistpart) as "Dental Assistants",
            sum(staffing_and_equipment.empdentistpart) as "Dentists",
            sum(staffing_and_equipment.emplabtechpart) as "Laboratory Technicians",
            sum(staffing_and_equipment.empnonadminpart) as "Non-administrative Staff",
            sum(staffing_and_equipment.empnursassistpart) as "Nurse Assistants",
            sum(staffing_and_equipment.empnursepart) as "Nurses",
            sum(staffing_and_equipment.emppharmpart) as "Pharmacists",
            sum(staffing_and_equipment.emppharmtechpart) as "Pharmacy Technicians",
            sum(staffing_and_equipment.empphysassistpart) as "Physician Assistants",
            sum(staffing_and_equipment.empphysspecpart) as "Physician, Specialists",
            sum(staffing_and_equipment.empphyspart) as "Physicians"
            '));
        if($sector_id){
            $pts->join('clinic', 'staffing_and_equipment.clinic_id', '=', 'clinic.id');
            $pts->where('clinic.sector_id', '=', $sector_id);
        }
        $data['part_time_staff'] = self::pivot('label','number', $pts->get());

        //Equipment
        $equip = DB::table('staffing_and_equipment');
        $equip ->select(DB::raw('
            sum(staffing_and_equipment.eqhereanes) as "Anesthesia Equipment",
            sum(staffing_and_equipment.eqhereaed) as "Automated External Defibrillator (AED)",
            sum(staffing_and_equipment.eqherecd4) as "CD4 Machine",
            sum(staffing_and_equipment.eqherecent) as "Centrifuge", 
            sum(staffing_and_equipment.eqherect) as "CT Scan",
            sum(staffing_and_equipment.eqheredead) as "Dead Box",
            sum(staffing_and_equipment.eqheredef) as "Defribrillator",
            sum(staffing_and_equipment.eqheredia) as "Dialysis Machine",
            sum(staffing_and_equipment.eqhereecg) as "ECG Machine",
            sum(staffing_and_equipment.eqhereglu) as "Glucose Strips",
            sum(staffing_and_equipment.eqherehema) as "Hematology Analyzer",
            sum(staffing_and_equipment.eqhererapid) as "HIV Rapid Test",
            sum(staffing_and_equipment.eqheremri) as "MRI",
            sum(staffing_and_equipment.eqherepcr) as "PCR Viral Load Machine",
            sum(staffing_and_equipment.eqherestab) as "Stabilizers",
            sum(staffing_and_equipment.eqheretemp) as "Temperature Control Refrigerators",
            sum(staffing_and_equipment.eqheretherm) as "Thermocyclers",
            sum(staffing_and_equipment.eqhereult) as "Ultrasound",
            sum(staffing_and_equipment.eqhereuri) as "Urinalysis Test Strips",
            sum(staffing_and_equipment.eqherexdig) as "X-ray Machine (Digital)",
            sum(staffing_and_equipment.eqherexfilm) as "X-ray Machine (Film)"
            '));
        if($sector_id){
            $equip->join('clinic', 'staffing_and_equipment.clinic_id', '=', 'clinic.id');
            $equip->where('clinic.sector_id', '=', $sector_id);
        }
        $data['equipment'] = self::pivot('label','number', $equip->get());

        $install = DB::table('payment_for_health_services');
        $install->select(
            array(
                DB::raw('sum(install) as yes'), 
                DB::raw('count(NULLIF (install, 1 )) as no')
                )
            );
        if($sector_id){
            $install->join('clinic', 'payment_for_health_services.clinic_id', '=', 'clinic.id');
            $install->where('clinic.sector_id', '=', $sector_id);
        }
        $data['Allow for payment in installments'] = $install->get();


        $inkind = DB::table('payment_for_health_services');
        $inkind->select(
            array(
                DB::raw('sum(inkind) as yes'), 
                DB::raw('count(NULLIF (inkind, 1 )) as no')
                )
            );
        if($sector_id){
            $inkind->join('clinic', 'payment_for_health_services.clinic_id', '=', 'clinic.id');
            $inkind->where('clinic.sector_id', '=', $sector_id);
        }
        $data['Allow for payment in-kind'] = $inkind->get();


        $ffs = DB::table('payment_for_health_services');
        $ffs->select(
            array(
                DB::raw('sum(fee) as yes'), 
                DB::raw('count(NULLIF (fee, 1 )) as no')
                )
            );
        if($sector_id){
            $ffs->join('clinic', 'payment_for_health_services.clinic_id', '=', 'clinic.id');
            $ffs->where('clinic.sector_id', '=', $sector_id);
        }
        $data['Fee for Service'] = $ffs->get();


        $insurance = DB::table('payment_for_health_services');
        $insurance->select(
            array(
                DB::raw('sum(insurance) as yes'), 
                DB::raw('count(NULLIF (insurance, 1 )) as no')
                )
            );
        if($sector_id){
            $insurance->join('clinic', 'payment_for_health_services.clinic_id', '=', 'clinic.id');
            $insurance->where('clinic.sector_id', '=', $sector_id);
        }
        $data['Reimbursement from private health insurance'] = $insurance->get();
        

        $sliding = DB::table('payment_for_health_services');
        $sliding->select(
            array(
                DB::raw('sum(sliding) as yes'), 
                DB::raw('count(NULLIF (sliding, 1 )) as no')
                )
            );
        if($sector_id){
            $sliding->join('clinic', 'payment_for_health_services.clinic_id', '=', 'clinic.id');
            $sliding->where('clinic.sector_id', '=', $sector_id);
        }
        $data['Sliding fee scale based on ability to pay'] = $sliding->get();


        $data['payment_mechanisms'] = array(
            'Allow for payment in installments' =>  $data['Allow for payment in installments'],
            'Allow for payment in-kind' => $data['Allow for payment in-kind'],
            'Fee for Service' => $data['Fee for Service'],
            'Reimbursement from private health insurance' => $data['Reimbursement from private health insurance'],
            'Sliding fee scale based on ability to pay' => $data['Sliding fee scale based on ability to pay']
            );


//Facilities with Internet Connections
        $fic = DB::table('staffing_and_equipment');
        $fic->select(DB::raw('staffing_and_equipment.facinternet as label, count(*) as number'));
        $fic->whereNotNull('staffing_and_equipment.facinternet');
        $fic->groupBy('staffing_and_equipment.facinternet');
        if($sector_id){
            $fic->join('clinic', 'staffing_and_equipment.clinic_id', '=', 'clinic.id');
            $fic->where('clinic.sector_id', '=', $sector_id);
        }
        $data['facilities_with_internets'] = $fic->get();

        return $data;
    }
}