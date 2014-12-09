<?php

class AdminBaseController extends \BaseController
{

	public function __construct()
	{
		parent::__construct();
		$this->addCrumb('Admin');
	}



}