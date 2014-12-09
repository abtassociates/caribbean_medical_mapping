@extends('layouts.default')

@section('content')

<?php 
/*
* Stored all profile/summary links and titles in $profiles array. 
* This condense the HTML and made editing much easier. Anchor 
* links are generated in the foreach loops.
*/
$profiles = array(
	ucfirst($instance->facility_term).' Profiles' => array(
		'All Profiles' => 'healthresourceprofilesall',
		'Search by Name, Service, and Specialty' =>'healthresourceprofilessearchname',
		'Search by Equipment' => 'healthresourceprofilessearchequip',
		'Search by Services Offered' => 'healthresourceprofilessearchservices',
		'Specialists in Country' => 'healthresourceprofilesspecialists',
		'Local Specialty Services' => 'healthresourceprofileslocal',
		'Visiting Specialty Services' => 'healthresourceprofilesvisiting'
		),
	'Pharmacy Profiles' => array(	
		'All Profiles' => 'pharmacyprofilesall',
		'Search by Name' =>'pharmacyprofilessearchname'
		),
	'HIV / AIDS Counselling and Testing Profiles' => array(	
		ucfirst(str_plural($instance->facility_term))." with Staff Trained in HCT" => 'hivprofileshct',
		"HIV Counseling ".ucfirst(str_plural($instance->facility_term)) =>'hivprofilescounsel',
		"HIV Testing ".ucfirst(str_plural($instance->facility_term)) =>'hivprofilestest'
		)
	);

?>

<div class="page-header font-style-1">
    <h1>Reports</h1>
</div>

<div class="row">

	<!-- Start Profile Sets -->
	@foreach($profiles AS $profile_name => $profile_data)
		<div class="col-xs-12 col-sm-4 widget-container-span ui-sortable">
			<div class="widget-box">
				<div class="widget-header">
					<h5 class="smaller font-style-2">{{ $profile_name }}</h5>
				</div>
				<div class="widget-body">
					<div class="widget-main padding-6">
						<div class="alert alert-info report-profile-info">

							<!-- Start Report Link -->
							@foreach($profile_data as $title => $value)

								@if($value!='hivprofileshct' || Auth::check())
									<i class="icon-double-angle-right"></i>
									<a class="font-style-2" href="/reports/{{ $value }}">
										{{ $title }}
									</a>
									<br>
								@endif

							@endforeach
							<!-- End Report Link -->

						</div>
					</div>
				</div>
			</div>
		</div>
	@endforeach
	<!-- End  Profile Sets -->
</div>

<div class="row" id="resource-summary-row">
	<div class="col-sm-12">
		<p>
			<a class="btn btn-custom-blue btn-lg" href="/reports/healthresourcesummary">
				<i class="icon-double-angle-right"></i>
				Health Resource Summary
			</a>
			<label
				class="popup"
				data-toggle="popover"
				data-placement="right"
				data-content="This report is a summary of the health service network in {{ $instance->country }}, including facilities available, services offered and equipment available at these facilities as well as average volume of patients using services."
			>
				<i class="icon-info-sign"></i>
			</label>

			<a style="margin-left: 20px" class="btn btn-custom-blue btn-lg" href="/reports/hivaidsresourcesummary">
				<i class="icon-double-angle-right"></i>
				HIV / AIDS Resource Summary
			</a>
			<label
				class="popup"
				data-toggle="popover"
				data-placement="right"
				data-content="This report provides a summary of the facilities available with trained personnel to provide HIV testing and counseling services."
			>
				<i class="icon-info-sign"></i>
			</label>
		</p>
	</div>
</div>

@stop


