@extends('layouts.reports')

@section('filters')

	{{ View::make('widget.reports.sector') }}

	<div class="col-xs-11 col-sm-4 col-md-3">
		<div class="form-group filterFormGroup">
		  {{ Form::label('service', 'Service') }}
		  {{ Form::select('service', $serviceList, $service, array(	'class'=>'chosen filterSelect')) }}
		</div>
	</div>

@stop

@section('report')

	@if(count($facilities))
		<h3>Health Resource Profiles: Search By Services Offered</h3><br>
		{{ View::make('partials.reportFacilityTabular', array( 
			'facilities' => $facilities, 
			'headers' => ["".ucfirst($instance->facility_term). " Name:","".ucfirst($instance->facility_term). " Address:","".ucfirst($instance->facility_term). " Type:", 'Contact Person:', 'Title:', 'Telephone:', 'Email:'],
			'fields' => ['facilityname','facilityaddress',['facilityInformation','facilitytype'],['proprietorInformation','fullname'],['proprietorInformation','title'],['proprietorInformation','telephone'],['proprietorInformation','email']]
		 )) }}
	@else
		@include('partials.noResults')
	@endif

@stop
