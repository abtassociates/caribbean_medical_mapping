@extends('layouts.reports')

@section('filters')

	{{ View::make('widget.reports.sector') }}

@stop

@section('report')

	@if(count($facilities))
		@include('partials.multiProfile', ['facilities' => $facilities])
	@else
		@include('partials.noResults')
	@endif

@stop