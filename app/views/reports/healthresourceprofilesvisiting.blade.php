@extends('layouts.reports')

@section('filters')

	{{ View::make('widget.reports.sector') }}

@stop

@section('report')

	@if(count($facilities))
		<h3>Health Resource Profiles: Visiting Specialty Services</h3><br>
		{{ View::make('partials.reportFacilityTabular', array( 
			'facilities' => $facilities, 
			'headers' => ['Visiting Specialty Services and Frequency:',"".ucfirst($instance->facility_term). " Name:","".ucfirst($instance->facility_term). " Address:","".ucfirst($instance->facility_term). " Type:", 'Contact Person:', 'Title:', 'Telephone:', 'Email:'],
			'fields' => ['specialtyBullets','facilityname','facilityaddress',['facilityInformation','facilitytype'],['proprietorInformation','fullname'],['proprietorInformation','title'],['proprietorInformation','telephone'],['proprietorInformation','email']]
		 )) }}
	@else
		@include('partials.noResults')
	@endif

@stop
