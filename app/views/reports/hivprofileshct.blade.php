@extends('layouts.reports')

@section('filters')

	{{ View::make('widget.reports.sector') }}

@stop

@section('report')

	@if(count($facilities))
		<h3>HIV / AIDS HCT Profiles: List of {{ucfirst(str_plural($instance->facility_term))}} with Staff Trained in HCT</h3><br>
		{{ View::make('partials.reportFacilityTabular', array( 
			'facilities' => $facilities, 
			'headers' => ['Time Since Training:',"".ucfirst($instance->facility_term)." Name:","".ucfirst($instance->facility_term)." Address:","".ucfirst($instance->facility_term)." Type:", 'Contact Person:', 'Title:', 'Telephone:', 'Email:'],
			'fields' => [['hivAidsServices','hcttraintime'],'facilityname','facilityaddress',['facilityInformation','facilitytype'],['proprietorInformation','fullname'],['proprietorInformation','title'],['proprietorInformation','telephone'],['proprietorInformation','email']]
		 )) }}
	@else
		@include('partials.noResults')
	@endif

@stop
