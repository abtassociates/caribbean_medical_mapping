<?php

class PublicController extends BaseController
{
	
    public function index()
    {
      return View::make('index')
        ->with('breadcrumbs', $this->breadcrumbs);
    }

    public function setCurrentPosition()
    {

        Session::put('currentPosition', [
            'lat' => Input::get('lat'),
            'lng' => Input::get('lng')
        ]);

        return Redirect::back();
    }

}
