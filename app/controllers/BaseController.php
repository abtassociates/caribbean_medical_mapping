<?php

class BaseController extends Controller {

  /**
   * Initializer.
   *
   * @access   public
   * @return \BaseController
   */
  public function __construct()
  {
    $this->beforeFilter('csrf', array('on' => 'post', 'except' => 'setCurrentPosition'));
    $this->beforeFilter('ajax', array('on' => array('delete', 'put')));
    $this->breadcrumbs = array();
    $this->instance = Instance::get();
    View::share('breadcrumbs', $this->breadcrumbs);
    View::share('instance', $this->instance);
  }

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

	protected function addCrumb($name, $url='')
	{
		$this->breadcrumbs[] = array(
 			'name' => $name,
 			'url' => $url
 		);
    View::share('breadcrumbs', $this->breadcrumbs);
 		return $this->breadcrumbs;
	}

}