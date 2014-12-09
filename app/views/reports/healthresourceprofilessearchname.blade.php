@extends('layouts.reports')

@section('filters')

	<div class="col-xs-11 col-sm-4 col-md-3">
		<div class="form-group filterFormGroup">
		  {{ Form::label('name', 'Name') }}
		  {{ Form::select('name', $names, $name, array('class'=>'chosen filterSelect')) }}
		</div>
	</div>

	<div class="col-xs-11 col-sm-4 col-md-3">
		<div class="form-group filterFormGroup">
		  {{ Form::label('service', 'Service') }}
		  {{ Form::select('service', $services, $service, array('class'=>'chosen filterSelect')) }}
		</div>
	</div>

	<div class="col-xs-11 col-sm-4 col-md-3">
		<div class="form-group filterFormGroup">
		  {{ Form::label('specialty', 'Specialty') }}
		  {{ Form::select('specialty', $specialties, $specialty, array('class'=>'chosen filterSelect')) }}
		</div>
	</div>

@stop

@section('report')

	@if(count($facilities))
		@include('partials.multiProfile', ['facilities' => $facilities])
	@else
		@include('partials.noResults')
	@endif

@stop