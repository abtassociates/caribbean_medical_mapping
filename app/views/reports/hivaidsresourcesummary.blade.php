@extends('layouts.reports')

@section('filters')

	{{ View::make('widget.reports.sector') }}

@stop

@section('report')
	<h3>HIV/AIDS Resource Summary</h3>

	<div class='report-section'>Number of {{ ucfirst(str_plural($instance->facility_term)) }} Providing HIV/AIDS Services, by HIV Service Type</div>

	{{ View::make('partials.reportTable', array(
		'rows' => $data['hiv_aids_services_type'],
		'headers' => ['Type of Service', 'Number'],
		'fields' => ['label', 'number']
	)) }}

	<div class='report-section'>Number of {{ ucfirst(str_plural($instance->facility_term)) }} with HIV/AIDS-related Equipment, by Equipment Type</div>

	{{ View::make('partials.reportTable', array(
		'rows' => $data['hiv_equipment'],
		'headers' => ['Type of Equipment', 'Number'],
		'fields' => ['label', 'number']
	)) }}

	<div class='report-section'>Number of {{ ucfirst(str_plural($instance->facility_term)) }} with Staff Trained on HIV/AIDS Testing and Counseling, by Time Since Training</div>

	{{ View::make('partials.reportTable', array(
		'rows' => $data['hiv_time_since_training'],
		'headers' => ['Time Since Training', 'Number'],
		'fields' => ['label', 'number']
	)) }}

	<div class='report-section'>Number of {{ ucfirst(str_plural($instance->facility_term)) }} offering HIV Testing, by Type of Testing</div>

	{{ View::make('partials.reportTable', array(
		'rows' => $data['hiv_test_types'],
		'headers' => ['Type of HIV Testing', 'Number'],
		'fields' => ['label', 'number']
	)) }}

	<div class='report-section'>Number of {{ ucfirst(str_plural($instance->facility_term)) }} offering Testing for Opportunistic Infections, by OI Type</div>
   {{ View::make('partials.reportTableThree', array(
        'rows' => $data['oi_services'],
        'headers' => ['Type of Opportunistic Infection', 'Conduct Test', 'Collect Sample'],
        'fields' => ['Conduct Test', 'Collect Sample']
    )) }}


	<div class='report-section'>Number of {{ ucfirst(str_plural($instance->facility_term)) }} referring for HIV Testing and Counseling, by Receiving Group</div>
	{{ View::make('partials.reportTable', array(
		'rows' => $data['hiv_referrals'],
		'headers' => ['Common Referrals for HIV Testing and Counseling', 'Number'],
		'fields' => ['label', 'number']
	)) }}

	{{ View::make('partials.reportTable', array(
		'rows' => $data['hiv_referrals_other'],
		'headers' => ['Common Other Referrals', 'Number'],
		'fields' => ['label', 'number']
	)) }}

	<div class='report-section'>Number of {{ ucfirst(str_plural($instance->facility_term)) }} offering HIV/AIDS Laboratory Services, by Service Type</div>
   {{ View::make('partials.reportTableThree', array(
        'rows' => $data['hiv_lab_services'],
        'headers' => ['Type of Laboratory Service', 'Collect', 'Analyze'],
        'fields' => ['Collect', 'Analyze']
    )) }}

	

	<div class='report-section'>Number of {{ ucfirst(str_plural($instance->facility_term)) }} offering ARVs, by ARV Type</div>

	{{ View::make('partials.reportTable', array(
		'rows' => $data['hiv_arv'],
		'headers' => ['Type of ARV', 'Number'],
		'fields' => ['label', 'number']
	)) }}

@stop