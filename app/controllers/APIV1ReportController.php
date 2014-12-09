<?php

class APIV1ReportController extends APIV1Controller {

	private function reportResponse($data, $filters=array()){

        $response = [
            "filters" => $this->buildFilters($filters, Input::all()),
            "data" => $data
        ];

        return Response::json($response)->setCallback(Input::get('callback'));
	}

	public function getIndex(){

        $response = [
            "resources" => [
                [
                    "name" => "Health Resource Profiles - All Profiles",
                    "uri" => $this->uri("reports/healthresourceprofilesall")
                ],
                // [
                //     "name" => "Health Resource Profiles - Search by Name",
                //     "uri" => $this->uri("reports/healthresourceprofilessearchname")
                // ],
                // [
                //     "name" => "Health Resource Profiles - Search by Equipment",
                //     "uri" => $this->uri("reports/healthresourceprofilessearchequip")
                // ],
                // [
                //     "name" => "Health Resource Profiles - Search by Services Offered",
                //     "uri" => $this->uri("reports/healthresourceprofilessearchservices")
                // ],
                // [
                //     "name" => "Health Resource Profiles - Specialists in Country",
                //     "uri" => $this->uri("reports/healthresourceprofilesspecialists")
                // ],
                // [
                //     "name" => "Health Resource Profiles - Local Specialty Services",
                //     "uri" => $this->uri("reports/healthresourceprofileslocal")
                // ],
                // [
                //     "name" => "Health Resource Profiles - Visiting Specialty Services",
                //     "uri" => $this->uri("reports/healthresourceprofilesvisiting")
                // ],
                // [
                //     "name" => "Pharmacy Profiles - All Profiles",
                //     "uri" => $this->uri("reports/pharmacyprofilesall")
                // ],
                // [
                //     "name" => "Pharmacy Profiles - Search by Facility Name",
                //     "uri" => $this->uri("reports/pharmacyprofilessearchname")
                // ],
                // [
                //     "name" => "HIV/AIDS Services Profiles - HIV Counseling Providers",
                //     "uri" => $this->uri("reports/hivprofilescounsel")
                // ],
                // [
                //     "name" => "HIV/AIDS Services Profiles - HIV Testing Providers",
                //     "uri" => $this->uri("reports/hivprofilestest")
                // ],
                [
                    "name" => "Health Resource Summary",
                    "uri" => $this->uri("reports/healthresourcesummary")
                ],
                [
                    "name" => "HIV / AIDS Resource Summary",
                    "uri" => $this->uri("reports/hivaidsresourcesummary")
                ],
            ]
        ];

        return Response::json($response)->setCallback(Input::get('callback'));
    }


	public function getHealthresourceprofilesall(){

        $filters = ['sector'];

 		$data = Reports::facilitiesBySector(Input::get('sector'), $this->uri("facilities"));

        return $this->reportResponse($data->toArray(), $filters);
	}


	public function getHealthresourcesummary(){

        $filters = ['sector'];

 		$data = Reports::healthResourseSummary(Input::get('sector'));

 		unset($data['facilities_with_internets']);

        return $this->reportResponse($data, $filters);
	}


	public function getHivaidsresourcesummary(){

        $filters = ['sector'];

 		$data = Reports::hivAidsResourseSummary(Input::get('sector'));

        return $this->reportResponse($data, $filters);
	}


}