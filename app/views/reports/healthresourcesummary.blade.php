@extends('layouts.reports')

@section('filters')

	{{ View::make('widget.reports.sector') }}

@stop

@section('report')
	<h3>Health Resource Summary Report</h3>

	@if(Auth::user())
	<div class='report-section'>Patient Volume</div>

	{{ View::make('partials.reportTable', array(
		'rows' => $data['patient_volume'],
		'headers' => ['Out-patient Visits per Week', 'In-patient Admissions per Week'],
		'fields' => ['outpatient', 'inpatient']
	)) }}
	@endif

	<div class='report-section'>{{ ucfirst($instance->facility_term) }} Infrastructure</div>

	{{ View::make('partials.reportTable', array(
		'rows' => $data['facility_infrastructure'],
		'headers' => ['Examination Rooms', 'Operating Rooms', 'In-patient Beds'],
		'fields' => ['facilityexam', 'facilityop', 'facilityin']
	)) }}

	<div class='report-section'>Types of {{ ucfirst (str_plural($instance->facility_term)) }}</div>

	{{ View::make('partials.reportTable', array(
		'rows' => $data['types_of_facilities'],
		'headers' => ["Type of ".ucfirst($instance->facility_term)."", 'Number'],
		'fields' => ['facilitytype', 'number']
	)) }}

	<div class='report-section'>Services Offered</div>

	{{ View::make('partials.reportTable', array(
		'rows' => $data['services_offered'],
		'headers' => ['Services', "Number of ".ucfirst(str_plural($instance->facility_term)).""],
		'fields' => ['label', 'number']
	)) }}

	<div class='report-section'>Staffing</div>

	{{ View::make('partials.reportTable', array(
		'rows' => $data['full_time_staff'],
		'headers' => ['Full Time Staff', 'Number'],
		'fields' => ['label', 'number']
	)) }}
	{{ View::make('partials.reportTable', array(
		'rows' => $data['part_time_staff'],
		'headers' => ['Part Time Staff', 'Number'],
		'fields' => ['label', 'number']
	)) }}

	<div class='report-section'>Equipment Available</div>

	{{ View::make('partials.reportTable', array(
		'rows' => $data['equipment'],
		'headers' => ['Equipment', "Number of ".ucfirst(str_plural($instance->facility_term)).""],
		'fields' => ['label', 'number']
	)) }}

	<div class='report-section'>Payment Accepted</div>
   {{ View::make('partials.reportTableThree', array(
        'rows' => $data['payment_mechanisms'],
        'headers' => ['Type of Payment', 'Yes', 'No'],
        'fields' => ['yes', 'no']
    )) }}

	@if(Auth::user())
	<div class='report-section'>Internet Connectivity and Computer Use</div>
	{{ View::make('partials.reportTable', array(
		'rows' => $data['facilities_with_internets'],
		'headers' => ["".ucfirst(str_plural($instance->facility_term))." with Internet Connections", "Number of ".ucfirst(str_plural($instance->facility_term)).""],
		'fields' => ['label', 'number']
	)) }}
	@endif

@stop