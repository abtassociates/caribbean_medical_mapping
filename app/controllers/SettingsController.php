<?php

class SettingsController extends BaseController
{

	public function __construct()
	{
		parent::__construct();
		$this->beforeFilter('allowed:alter_settings');
 		$this->addCrumb('Settings', '/settings');
	}

  public function getIndex()
  {
    return View::make('settings/index')
      ->with('instance', Instance::get());
	}

	public function postIndex()
	{

		$instance = Instance::get();
		if($instance->update(Input::all()))
		{
			//return update_facility_term_dependent_responses($instance->$facility_term);
			Clinic::update_facility_term_dependent_responses($instance->facility_term);
			return Redirect::to('settings')->with('message', 'Settings Updated');
		}
		return Redirect::back()
			->withInput()
			->withErrors($instance->getErrors())
			->with('error', 'Failed to save. Check for errors');
	}



}