<label>Completing all of the fields for each entry will optimize the value of the database, but remember that all questions are completely voluntary.</label>
<div class="row">
	<div class="col-sm-12">
		<div class="tabbable tabs-left">
			<ul class="nav nav-tabs" id="myTab3">
				<li class="active popup" data-toggle="popup" data-placement="right" data-content="Gathers information on the name and location of the {{ $instance->facility_term }}">
					<a data-toggle="tab" href="#general">
						<i class="icon-list-alt"></i>
						General
					</a>
				</li>
				<li class="popup" data-toggle="popup" data-placement="right" data-content="Gathers information on the {{ $instance->facility_term }} proprietor including contact details">
					<a data-toggle="tab" href="#proprietorInformation">
						<i class="icon-list-alt"></i>
						Proprietor Information
					</a>
				</li>
				<li class="popup" data-toggle="popup" data-placement="right" data-content="Gathers information on the health {{ $instance->facility_term }}, including hours of operation">
					<a data-toggle="tab" href="#facilityInformation">
						<i class="icon-list-alt"></i>
						{{ ucfirst($instance->facility_term) }} Information
					</a>
				</li>
				<li class="popup" data-toggle="popup" data-placement="right" data-content="Gathers information on the types and number of individuals employed in the {{ $instance->facility_term }}">
					<a data-toggle="tab" href="#staffing">
						<i class="icon-group"></i>
						Staffing
					</a>
				</li>		
				<li class="popup" data-toggle="popup" data-placement="right" data-content="Gathers information on specific equipment available at that {{ $instance->facility_term }}">
					<a data-toggle="tab" href="#equipment">
						<i class="icon-stethoscope"></i>
						Equipment
					</a>
				</li>									
				<li class="popup" data-toggle="popup" data-placement="right" data-content="Gathers information on specific services available and estimated utilization rates">
					<a data-toggle="tab" href="#serviceAvailabilityAndUtilization">
						<i class="icon-medkit"></i>
						Service Availability and Utilization
					</a>
				</li>
				<li class="popup" data-toggle="popup" data-placement="right" data-content="Gathers information on the availability of HIV and AIDS counseling, testing, treatment, and referral services">
					<a data-toggle="tab" href="#hivAidsServices">
						<i class="icon-user-md"></i>
						HIV / AIDS Services
					</a>
				</li>												
				<li class="popup" data-toggle="popup" data-placement="right" data-content="Gathers information on whether the {{ $instance->facility_term }} collects and/or analyzes specific laboratory tests">
					<a data-toggle="tab" href="#laboratoryTests">
						<i class="icon-beaker	"></i>
						Laboratory Tests
					</a>
				</li>														
				<li class="popup" data-toggle="popup" data-placement="right" data-content="Gathers information on whether the {{ $instance->facility_term }} carries certain pharmaceuticals">
					<a data-toggle="tab" href="#pharmacyServices">
						<i class="icon-user-md"></i>
						Pharmacy Services
					</a>
				</li>				
				<li class="popup" data-toggle="popup" data-placement="right" data-content="Gathers information on client payment options and whether insurance is accepted">
					<a data-toggle="tab" href="#paymentForHealthServices">
						<i class="icon-money"></i>
						Payment for Health Services
					</a>
				</li>			
				<li class="popup" data-toggle="popup" data-placement="right" data-content="Gathers information on the kinds of data being reported to the Ministry of Health">
					<a data-toggle="tab" href="#healthRecordsAndReporting">
						<i class="icon-folder-open-alt"></i>
						Health Records and Reporting
					</a>
				</li>
			</ul>

			<div class="tab-content">
				<div id="general" class="tab-pane active">
					<div class="row">
						<div class="col-xs-12">
							{{ View::make('facilities.form.general', array("model" => $facility)) }}
							<div class="group-wrapper">
								<div class="form-group">
							     	<label class="col-sm-12 control-label control-title secondary">
							    		<strong>You can move the map by clicking and holding the left mouse button while moving your mouse.  Please zoom in to your location using the plus icon in top left corner, then place (by clicking once on the map) or move the existing location marker as close to your physical location as possible.</strong>
							    	</label>
									<div id="map-canvas" class="col-xs-12" style="height: 350px;"></div>
								</div>
								<div class="row">
									<div class="col-xs-6">
										<div class="form-group">
										  <label for="subtable[Clinic][lat]" class="col-sm-3 control-label">Latitude</label>
										  <div class="col-sm-8">
										  	{{ Form::text('subtable[Clinic][lat]', $facility->lat, array('id'=>'lat')) }}
										  </div>
										</div>
									</div>
									<div class="col-xs-6">
										<div class="form-group">
										  <label for="subtable[Clinic][lat]" class="col-sm-3 control-label">Longitude</label>
										  <div class="col-sm-8">
										  	{{ Form::text('subtable[Clinic][lng]', $facility->lng, array('id'=>'lng')) }}
										  </div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div id="proprietorInformation" class="tab-pane">
					{{ View::make(
						'facilities.form.proprietorInformation',
						array('model' => $facility->proprietorInformation)
					) }}
				</div>

				<div id="facilityInformation" class="tab-pane">
					{{ View::make(
						'facilities.form.facilityInformation',
						array('model' => $facility->facilityInformation)
					) }}
				</div>

				<div id="staffing" class="tab-pane">
					{{ View::make(
						'facilities.form.staffing',
						array('model' => $facility->staffingAndEquipment)
					) }}
				</div>

				<div id="equipment" class="tab-pane">
					{{ View::make(
						'facilities.form.equipment',
						array('model' => $facility->staffingAndEquipment)
					) }}
				</div>

				<div id="serviceAvailabilityAndUtilization" class="tab-pane">
					{{ View::make(
						'facilities.form.serviceAvailabilityAndUtilization',
						array('model' => $facility->serviceAvailabilityAndUtilization)
					) }}
				</div>

				<div id="hivAidsServices" class="tab-pane">
					{{ View::make(
						'facilities.form.hivAidsServices',
						array('model' => $facility->hivAidsServices)
					) }}
				</div>

				<div id="laboratoryTests" class="tab-pane">
					{{ View::make(
						'facilities.form.laboratoryTests',
						array('model' => $facility->laboratoryAndPharmacyServices)
					) }}
				</div>

				<div id="pharmacyServices" class="tab-pane">
					{{ View::make(
						'facilities.form.pharmacyServices',
						array('model' => $facility->laboratoryAndPharmacyServices)
					) }}
				</div>

				<div id="paymentForHealthServices" class="tab-pane">
					{{ View::make(
						'facilities.form.paymentForHealthServices',
						array('model' => $facility->paymentForHealthServices)
					) }}
				</div>

				<div id="healthRecordsAndReporting" class="tab-pane">
					{{ View::make(
						'facilities.form.healthRecordsAndReporting',
						array('model' => $facility->healthRecordsAndReporting)
					) }}
				</div>
			</div>
		</div>
	</div>
</div>

<script>

	var specialties = {{ json_encode($specialties) }};

	var facility_term = "{{ $instance->facility_term }}";
	var facility_term_capitalized = "{{ ucwords($instance->facility_term) }}";

</script>