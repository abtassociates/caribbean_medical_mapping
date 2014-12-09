@extends('layouts.reports')

@section('filters')

	{{ View::make('widget.reports.sector') }}

@stop

@section('report')

	@if(count($facilities))
		<h3>HIV / AIDS HCT Profiles: HIV Testing {{ucfirst(str_plural($instance->facility_term))}}</h3><br>

		{{ View::make('partials.hivProfileTestTable', array( 
			'facilities' => $facilities, 
			'headers' => ["Rapid Test:","Western Blot:","ELISA:","Blood Draw:","".ucfirst($instance->facility_term). " Name:","".ucfirst($instance->facility_term). " Address:","".ucfirst($instance->facility_term). " Type:", "Contact Person:", "Title:", "Telephone:", "Email:"],
			'fields' => [['hivAidsServices','rapidtest'], ['hivAidsServices','westernblot'],['hivAidsServices','elisa'],['hivAidsServices','blooddraw'],'facilityname','facilityaddress',['facilityInformation','facilitytype'],['proprietorInformation','fullname'],['proprietorInformation','title'],['proprietorInformation','telephone'],['proprietorInformation','email']]
		 )) }}
	@else
		@include('partials.noResults')
	@endif

@stop
