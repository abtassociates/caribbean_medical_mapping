<?php

class APIV1Controller extends \BaseController {

    public function __construct()
    {
        parent::__construct();
        $this->beforeFilter('api');
    }

    protected function uri($path)
    {
        return URL::to("/api/v1/{$path}");
    }

    protected function buildFilters($options, $set){

        $filters = array();

        foreach($options as $option){
            $filters[$option] = isset($set[$option]) ? $set[$option] : null;
        }

        return $filters;
    }

    public function index(){

        $response = [
            "resources" => [
                ['name'=>'facilities', 'uri'=>$this->uri("facilities")],
                ['name'=>'reports', 'uri'=>$this->uri("reports")],
                ['name'=>'filter-options', 'uri'=>$this->uri("filter-options")]
            ]
        ];

        return Response::json($response)->setCallback(Input::get('callback'));
    }

    public function facilities(){

        $facilities = Clinic::filtered(Input::all(), $current_position=null, $this->uri("facilities"));

        $filter_options = ['services[]', 'equipment[]', 'staff[]', 'proprietor'];

        $response = [
            "filters" => $this->buildFilters($filter_options, Input::all()),
            "resources" => $facilities->toArray()
        ];

        return Response::json($response)->setCallback(Input::get('callback'));
    }

    public function filterOptions(){

        $response = [
            "resources" => [
                ['name'=>'sectors', 'uri'=>$this->uri("filter-options/sectors")],
                ['name'=>'services', 'uri'=>$this->uri("filter-options/services")],
                ['name'=>'equipment', 'uri'=>$this->uri("filter-options/equipment")],
                ['name'=>'positions', 'uri'=>$this->uri("filter-options/positions")],
                ['name'=>'proprietors', 'uri'=>$this->uri("filter-options/proprietors")],
            ]
        ];

        return Response::json($response)->setCallback(Input::get('callback'));

    }

    public function sectors(){
        return Response::json(Clinic::getSectorList())->setCallback(Input::get('callback'));
    }

    public function services(){
        return Response::json(Clinic::getServiceList())->setCallback(Input::get('callback'));
    }

    public function equipment(){
        return Response::json(Clinic::getEquipmentList())->setCallback(Input::get('callback'));
    }

    public function positions(){
        return Response::json(Clinic::getPositionList())->setCallback(Input::get('callback'));
    }


    public function proprietors(){
        return Response::json(ProprietorInformation::getProprietorList())->setCallback(Input::get('callback'));
    }


    public function facility($id){

        $facility = Clinic::getFull($id);

        return Response::json($facility)->setCallback(Input::get('callback'));

    }



}