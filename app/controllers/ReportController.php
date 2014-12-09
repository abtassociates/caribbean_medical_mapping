<?php

class ReportController extends BaseController
{

	public function __construct()
	{
		parent::__construct();
 		$this->addCrumb('Reports', '/reports');
 		$this->beforeFilter('auth', array('only' => array('getHivprofileshct')));
    	View::share('sectors', Clinic::getSectorList($add_blank=true));
	}
	

  	public function getIndex()
  	{
    	return View::make('reports/index');
	}

	// ------------------------------------------------------------------ //

  	// put in a 'get' for each possible report
	public function getHivaidsresourcesummary()
	{
 		$this->addCrumb(
 			'HIV / Aids Resource Summary',
 			'/reports/hivaidsresourcesummary'
 		);

 		$data = Reports::hivAidsResourseSummary(Input::get('sector_id'));

		return View::make('reports/hivaidsresourcesummary')
						->with('data', $data);
	}

	// ------------------------------------------------------------------ //

	public function getHealthresourcesummary()
	{
 		$this->addCrumb(
 			'Health Resource Summary',
 			'/reports/healthresourcesummary'
 		);

 		$data = Reports::healthResourseSummary(Input::get('sector_id'));

		return View::make('reports/healthresourcesummary')
						->with('data', $data);
	}

	// ------------------------------------------------------------------ //

	public function getHealthresourceprofilesall()
	{
 		$this->addCrumb(
 			'All Profiles',
 			'/reports/healthresourceprofilesall'
 		);

 		$facilities = Reports::facilitiesBySector(Input::get('sector_id'));

		return View::make('reports/healthresourceprofilesall')
				->with('facilities', $facilities);

	}

	// ------------------------------------------------------------------ //

	public function getHealthresourceprofilessearchname()
	{
 		$this->addCrumb(
 			'Search by Name, Service, and Specialty',
 			'/reports/healthresourceprofilessearchname'
 		);

		$facilities = Reports::facilitiesByNameServiceAndSpecialty(
			Input::get('name'),
			Input::get('service'),
			Input::get('specialty')
		);

		return View::make('reports/healthresourceprofilessearchname')
						->with('names', Clinic::getAllNames())
						->with('name', Input::get('name'))
            ->with('services', Clinic::getServiceList(true))
						->with('service', Input::get('service'))
						->with('specialties', Clinic::getSpecialtiesList())
						->with('specialty', Input::get('specialty'))
						->with('facilities', $facilities);
	}

	// ------------------------------------------------------------------ //

	public function getHealthresourceprofilessearchequip()
	{
 		$this->addCrumb(
 			'Search by Equipment',
 			'/reports/healthresourceprofilessearchequip'
 		);

 		$equipmentList = Clinic::getEquipmentList($add_blank = true);

 		$equipment = Input::get('equipment');

 		$sector_id = Input::get('sector_id');

 		$facilities = Reports::facilityByEquipment($sector_id, $equipment);

		return View::make('reports/healthresourceprofilessearchequip')
						->with('equipmentList', $equipmentList)
						->with('equipment', $equipment)
						->with('facilities', $facilities);
	}

	// ------------------------------------------------------------------ //

	public function getHealthresourceprofilessearchservices()
	{
 		$this->addCrumb(
 			'Search by Services Offered',
 			'/reports/healthresourceprofilessearchservices'
 		);

 		$serviceList = Clinic::getServiceList($add_blank = true);

 		$service = Input::get('service');

 		$sector_id = Input::get('sector_id');

 		$facilities = Reports::facilityByService($sector_id, $service);

		return View::make('reports/healthresourceprofilessearchservices')
						->with('serviceList', $serviceList)
						->with('service', $service)
						->with('facilities', $facilities);
	}

	// ------------------------------------------------------------------ //

	public function getHealthresourceprofilesspecialists()
	{
 		$this->addCrumb(
 			'Specialists in Country',
 			'/reports/healthresourceprofilesspecialists'
 		);

 		$sector_id = Input::get('sector_id');

 		$facilities = Reports::facilitiesWithSpecialists($sector_id);

		return View::make('reports/healthresourceprofilesspecialists')
						->with('facilities', $facilities);
	}

	// ------------------------------------------------------------------ //

	public function getHealthresourceprofileslocal()
	{
 		$this->addCrumb(
 			'Local Specialty Services',
 			'/reports/healthresourceprofileslocal'
 		);

 		$sector_id = Input::get('sector_id');

 		$facilities = Reports::facilitiesWithSpecialServices($sector_id);
 		
		return View::make('reports/healthresourceprofileslocal')
						->with('facilities', $facilities);
	}

	// ------------------------------------------------------------------ //

	public function getHealthresourceprofilesvisiting()
	{
 		$this->addCrumb(
 			'Visiting Specialty Services',
 			'/reports/healthresourceprofilesvisiting'
 		);

 		$sector_id = Input::get('sector_id');

 		$facilities = Reports::facilitiesWithVisitingSpecialists($sector_id);

		return View::make('reports/healthresourceprofilesvisiting')
						->with('facilities', $facilities);
	}

	// ------------------------------------------------------------------ //
// /
	public function getPharmacyprofilesall()
	{
 		$this->addCrumb(
 			'All Profiles',
 			'/reports/pharmacyprofilesall'
 		);

 		$sector_id = Input::get('sector_id');

 		$facilities = Reports::pharmaciesAll($sector_id);

		return View::make('reports/pharmacyprofilesall')
						->with('facilities', $facilities);
	}

	// ------------------------------------------------------------------ //

	public function getPharmacyprofilessearchname()
	//
	{
 		$this->addCrumb(
 			'Search by Name',
 			'/reports/pharmacyprofilessearchname'
 		);

		$facilities = Reports::pharmaciesByName(Input::get('name'));

		return View::make('reports/pharmacyprofilessearchname')
						->with('names', Clinic::getAllPharmacies())
						->with('name', Input::get('name'))
						->with('facilities', $facilities);
	}

	// ------------------------------------------------------------------ //

	public function getHivprofileshct()
	{
 		$this->addCrumb(
 			'List of Providers with Staff Trained in HCT',
 			'/reports/hivprofileshct'
 		);

 		$sector_id = Input::get('sector_id');

 		$facilities = Reports::hivHctProviders($sector_id);

		return View::make('reports/hivprofileshct')
						->with('facilities', $facilities);
	}

	// ------------------------------------------------------------------ //

	public function getHivprofilescounsel()
	{
 		$this->addCrumb(
 			'HIV Counseling Providers',
 			'/reports/hivprofilescounsel'
 		);

 		$sector_id = Input::get('sector_id');
 		
 		$facilities = Reports::hivCounselingProviders($sector_id);

		return View::make('reports/hivprofilescounsel')
						->with('facilities', $facilities);
	}

	// ------------------------------------------------------------------ //

	public function getHivprofilestest()
	{
 		$this->addCrumb(
 			'HIV Testing Providers',
 			'/reports/hivprofilestest'
 		);

 		$sector_id = Input::get('sector_id');
 		
 		$facilities = Reports::hivTrainingProviders($sector_id);

		return View::make('reports/hivprofilestest')
						->with('facilities', $facilities);
	}

	// ------------------------------------------------------------------ //


}