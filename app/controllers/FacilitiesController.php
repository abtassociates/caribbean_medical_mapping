<?php

class FacilitiesController extends \BaseController {

	public function __construct()
	{
		parent::__construct();

		$this->beforeFilter('auth', array('except' => ['index', 'show', 'error', 'missing']));
 	}


	// accepts the error report submissions through POST. No auth required
	public function error($id)
	{
		if(!$facility = Clinic::find($id))
		{
			return null;
		}

		$error_data = array_merge(Input::all(), ['clinic_id' => $id]);
		$error = Error::create($error_data);

		// if no problems, then email the admins
		if(!$errors = $error->getErrors())
		{
			$error->alertAdmins();
		}

		return $errors;
	}

	// accepts the missing facility report data through post. No auth required
	public function missing()
	{
		$error = Error::create(Input::all());

		// if no problems, then email the admins
		if(!$errors = $error->getErrors())
		{
			$error->alertAdmins();
		}

		return $errors;
	}

	// landing page for links to fix reported errors
	public function corrections($id)
	{

		// if error doesn't exist
		if(!$error = Error::find($id))
		{
			return View::make('error/404');
		}

		// if it's already resolved
		if($error->resolved_on)
		{
			$this->addCrumb(
				"Corrections",
				''
			);

			return View::make('facilities/error_resolved')
             ->with('error', $error)
             ->with('resolved_by', User::find($error->resolved_by));
		}

		// if it's an error for an existing facility
		if($error->clinic_id)
		{
			return Redirect::to("facilities/{$error->clinic_id}/edit");
		}

		// if it's an error to report a missing facility
		return Redirect::to("facilities/create?error_id={$id}");

	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

		return View::make('facilities/index')
            ->with('input', Input::all())
            ->with('proprietors', ProprietorInformation::getProprietorList($first_blank=true))
            ->with('specialties', Clinic::getSpecialtiesList())
            ->with('services', Clinic::getServiceList())
            ->with('equipment', Clinic::getEquipmentList())
            ->with('facilities', Clinic::filtered(Input::all(), Session::get('currentPosition')));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		if(!Auth::user()->can('insert_facilities'))
		{
			return Response::view('error.403', array(), 403);
		}

		$this->addCrumb(
			"Create",
			'/facilities/create'
		);

		// look for any creation notes. This will just be null if no
		// error_id was provided in the query string
		$error = Error::find(Input::get('error_id'));

		return View::make('facilities/create')
			->with("specialties", Clinic::getSpecialtiesArray())
    		->with("facility", Clinic::getNew())
    		->with("error", $error);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		if(!Auth::user()->can('insert_facilities'))
		{
			return Response::view('error.403', array(), 403);
		}

		$facility = Clinic::saveAll(Input::get('subtable'));

		$facility->last_updated_by = Auth::user()->id;
		$facility->save();

		// if this is being created in association with a 'missing facility'
		// error notice
		if($error_id = Input::get('error_id'))
		{
			$error = Error::find($error_id);
			$error->resolved_on = date('Y-m-d');
			$error->resolved_by = Auth::user()->id;
			$error->clinic_id = $facility->id;
			$error->save();
		}

    	return Redirect::to('/')->with('message', "{$facility->facilityname} added");
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		if(!$facility = Clinic::findFull($id)){
			return View::make('error/404');
		}

		$this->addCrumb(
			$facility->facilityname,
			"/facilities/{$facility->id}"
		);

		return View::make('facilities/show')
    	->with("facility", $facility);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($facility_id)
	{

		// if the facility doesn't exist...
		if(!$facility = Clinic::find($facility_id))
		{
			return View::make('error/404');
		}

		// if they don't have permission on this facility...
		if(!Auth::user()->canEditFacility($facility))
		{
			return Response::view('error.403', array(), 403);
		}

		$errors = Error::getUnresolved($facility_id);

		$this->addCrumb(
			$facility->facilityname,
			"/facilities/{$facility->id}"
		);

		$this->addCrumb(
			'edit',
			"/facilities/{$facility->id}/edit"
		);

		return View::make('facilities/edit')
    		->with("facility", $facility)
			->with("specialties", Clinic::getSpecialtiesArray())
    		->with('errors', $errors);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($facility_id)
	{

		// if the facility doesn't exist...
		if(!$facility = Clinic::find($facility_id))
		{
			return View::make('error/404');
		}

		// if they don't have permission on this facility...
		if(!Auth::user()->canEditFacility($facility))
		{
			return Response::view('error.403', array(), 403);
		}

		// clean empty string responses into nulls
		$subtables = Input::get('subtable');
		foreach($subtables as $subtable => $vals){
			foreach($vals as $key => $val){
				if($val === ""){
					$subtables[$subtable][$key] = null;
				}
			}
		}

		// update all the subtables
		// TODO: make ti work even if subtable doesn't exist yet
		foreach($subtables AS $model => $vals){
			if($model === "Clinic"){
				$facility->update($vals);
			}
			else{
				$facility->{$model}->update($vals);
			}
		}

		$facility->last_updated_by = Auth::user()->id;
		$facility->save();

		$errors = Input::get('errors');

		Error::resolve($errors, Auth::user()->id);

		$message = "{$facility->facilityname} updated.";
		if($number_resolved = count($errors)){
			$message .= "{$number_resolved} issues resolved.";
		}

    	return Redirect::to('/')->with('message', $message);
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($facility_id)
	{
		if(!$facility = Clinic::find($facility_id))
		{
			return View::make('error/404');
		}

		// if they don't have permission on this facility...
		if(!Auth::user()->canDeleteFacility($facility))
		{
			return Response::view('error.403', array(), 403);
		}

  		$facility->delete();

    	return Redirect::to('/')->with('message', "{$facility->facilityname} deleted");
	}


}
