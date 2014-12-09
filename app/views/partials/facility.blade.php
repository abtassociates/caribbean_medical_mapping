@if($facility)

<div class="facility-wrapper" facility_id="{{ $facility->id }}">	
	<div class="row">
		<div class="col-md-6">
			<div class="widget-header widget-header-small">
				<h3 class="blue smaller">
					<i class="icon-building grey"></i>
					{{ ucfirst($instance->facility_term) }} Profile
				</h3>
			</div>
			
			<div class="widget-body  profile-user-info-striped">

				<div class="profile-info-row">
					<div class="profile-info-name"> Name </div>
					<div class="profile-info-value">
						<span>{{ $facility->facilityname }} &nbsp;</span>
					</div>
				</div>
				@if($facility->specialty)
				<div class="profile-info-row">
					<div class="profile-info-name"> Specialty </div>
					<div class="profile-info-value">
						<span>{{ $facility->specialty }} &nbsp;</span>
					</div>
				</div>
				@endif
				<div class="profile-info-row">
					<div class="profile-info-name"> Type of {{ ucfirst($instance->facility_term) }} </div>
					<div class="profile-info-value">
						<span>{{ $facility->facilityInformation->facilitytype }} &nbsp;</span>
					</div>
				</div>		
				<div class="profile-info-row">
					<div class="profile-info-name"> Parish/Island </div>
					<div class="profile-info-value">
						<span>{{ $facility->parishisland }} &nbsp;</span>
					</div>
				</div>		
				<div class="profile-info-row">
					<div class="profile-info-name"> Address </div>
					<div class="profile-info-value">
						<span>{{ $facility->facilityaddress }} &nbsp;</span>
					</div>
				</div>			
				<div class="profile-info-row">
					<div class="profile-info-name"> Last Updated </div>
					<div class="profile-info-value">
						<span>
							{{ HTML::date($facility->updated_at) }}
							@if($facility->lastUpdatedBy)
								by {{ $facility->lastUpdatedBy->fullName() }}
							@endif
							&nbsp;
						</span>
					</div>
				</div>			
			</div>
			
			<div class="space-20"></div>
					
			<div class="widget-header widget-header-small">
				<h3 class="blue smaller">
					<i class="icon-phone grey"></i>
					Contact Information
				</h3>
			</div>
					
			<div class="widget-body  profile-user-info-striped">
				<div class="profile-info-row">
					<div class="profile-info-name"> Contact Person </div>
					<div class="profile-info-value">
						<span>{{ $facility->proprietorInformation->title }} {{ $facility->proprietorInformation->fullname }} &nbsp;</span>
					</div>
				</div>					
				<div class="profile-info-row">
					<div class="profile-info-name"> Telephone </div>
					<div class="profile-info-value">
						<span>
							<a class="email" href="tel:+{{ $facility->proprietorInformation->telephone }}">
								{{ HTML::formatPhone($facility->proprietorInformation->telephone) }}
							</a>&nbsp;
						</span>
					</div>
				</div>
				<div class="profile-info-row">
					<div class="profile-info-name"> Email </div>
					<div class="profile-info-value">
						<span><a class="email" href="mailto:{{ $facility->proprietorInformation->email }}">{{ $facility->proprietorInformation->email }}</a> &nbsp;</span>
					</div>
				</div>
			</div>	

		</div>
		<div id="mapWrap" class="col-sm-12 col-md-6">
			<div
				facility_id="{{ $facility->id }}"
				class="map-canvas"
				style="height: 437px; border: 1px solid #CCC;"
				lat="{{ $facility->lat }}"
				lng="{{ $facility->lng }}"
			>
			</div>

			@include('partials.mapLegend')
		</div>
	</div>

	<div class="space-20"></div>
		
	<div class="widget-header widget-header-small">
		<h3 class="blue smaller">
			<i class="icon-time grey"></i>
			Hours of Operation
		</h3>
	</div>
	<div class="widget-body  profile-user-info-striped">
		<table class="table table-responsive table-bordered">
				<thead>
					<tr>
						<th>&nbsp;</th>
						<th>Monday</th>
						<th>Tuesday</th>
						<th>Wednesday</th>
						<th>Thursday</th>
						<th>Friday</th>
						<th>Saturday</th>
						<th>Sunday</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Status</td>
						<td>{{ $facility->facilityInformation->mon }}</td>
						<td>{{ $facility->facilityInformation->tue }}</td>
						<td>{{ $facility->facilityInformation->wed }}</td>
						<td>{{ $facility->facilityInformation->thur }}</td>
						<td>{{ $facility->facilityInformation->fri }}</td>
						<td>{{ $facility->facilityInformation->sat }}</td>
						<td>{{ $facility->facilityInformation->sun }}</td>
					</tr>
					<tr>
						<td>Opening Hour</td>
						<td>{{ HTML::time($facility->facilityInformation->monopen) }}</td>
						<td>{{ HTML::time($facility->facilityInformation->tueopen) }}</td>
						<td>{{ HTML::time($facility->facilityInformation->wedopen) }}</td>
						<td>{{ HTML::time($facility->facilityInformation->thuropen) }}</td>
						<td>{{ HTML::time($facility->facilityInformation->friopen) }}</td>
						<td>{{ HTML::time($facility->facilityInformation->satopen) }}</td>
						<td>{{ HTML::time($facility->facilityInformation->sunopen) }}</td>
					</tr>
					<tr>
						<td>Closing Hour</td>
						<td>{{ HTML::time($facility->facilityInformation->monclose) }}</td>
						<td>{{ HTML::time($facility->facilityInformation->tueclose) }}</td>
						<td>{{ HTML::time($facility->facilityInformation->wedclose) }}</td>
						<td>{{ HTML::time($facility->facilityInformation->thurclose) }}</td>
						<td>{{ HTML::time($facility->facilityInformation->friclose) }}</td>
						<td>{{ HTML::time($facility->facilityInformation->satclose) }}</td>
						<td>{{ HTML::time($facility->facilityInformation->sunclose) }}</td>
					</tr>
				</tbody>
			</table>
	</div>

	<div class="space-20"></div>
		
	<div class="row">

		@if($facility->facilityInformation->facilitytype == "Pharmacy")

		<div class="col-xs-12 col-md-6">
			<div class="widget-header widget-header-small">
				<h3 class="blue smaller">
					<i class="icon-plus-sign-alt grey"></i>
					Medicines Available
				</h3>
			</div>
			<div class="widget-body  profile-user-info-striped">
				<div class="profile-info-row">
					<div class="facility-profile-">
						<table class="table table-responsive table-bordered table-striped">
							<tbody>
								@foreach($facility->medicineList() as $medicine)
									@if($medicine['val'])
									<tr>
										<td>
											{{ $medicine['name'] }}
										</td>
									</tr>
									@endif
								@endforeach
							</tbody>
						</table>
					</div>
				</div>					
			</div>
		</div>

		@else

		<div class="col-xs-12 col-md-6">
			<div class="widget-header widget-header-small">
				<h3 class="blue smaller">
					<i class="icon-stethoscope grey"></i>
					Services Provided
				</h3>
			</div>
			<div class="widget-body  profile-user-info-striped">
				<div class="profile-info-row">
					<div class="facility-profile-">
						<table class="table table-responsive table-bordered table-striped">
							<tbody>
								@foreach($facility->serviceList() as $service)
									@if($service['val'])
									<tr>
										<td>
											{{ $service['name'] }}
										</td>
									</tr>
									@endif
								@endforeach
							</tbody>
						</table>
					</div>
				</div>					
			</div>
		</div>

		@endif

		<div class="col-xs-12 col-md-6">
			<div class="widget-header widget-header-small">
				<h3 class="blue smaller">
					<i class="icon-medkit grey"></i>
					Equipment Available
				</h3>
			</div>
			<div class="widget-body  profile-user-info-striped">
				<div class="profile-info-row">
					<div class="facility-profile-">
					<table class="table table-responsive table-bordered table-striped">
						<tbody>
							@foreach($facility->equipmentList() as $equipment)
								@if($equipment['val'])
								<tr>
									<td>
										{{ $equipment['name'] }}
									</td>
								</tr>
								@endif
							@endforeach
						</tbody>
					</table>
					</div>
				</div>					
			</div>
		</div>
	</div>
	
	<div class="space-20"></div>
		
	<div class="row">
		<div class="col-xs-12 col-md-6">
			<div class="widget-header widget-header-small">
				<h3 class="blue smaller">
					<i class="icon-group grey"></i>
					Full-Time Staff Members
				</h3>
			</div>
			<div class="widget-body  profile-user-info-striped">
				<div class="profile-info-row">
					<div class="facility-profile-">
					<table class="table table-responsive table-bordered table-striped">
						<tbody>
							@foreach($facility->fullTimeList() as $position)
								@if($position['val'])
								<tr>
									<td>
										{{ $position['name'] }}
									</td>
									<td>
										{{ $position['val'] }}
									</td>
								</tr>
								@endif
							@endforeach
						</tbody>
					</table>
					</div>
				</div>					
			</div>
		</div>
		<div class="col-xs-12 col-md-6">
			<div class="widget-header widget-header-small">
				<h3 class="blue smaller">
					<i class="icon-group grey"></i>
					Part-Time Staff Members
				</h3>
			</div>
			<div class="widget-body  profile-user-info-striped">
				<div class="profile-info-row">
					<div class="facility-profile-">
					<table class="table table-responsive table-bordered table-striped">
						<tbody>
							@foreach($facility->partTimeList() as $position)
								@if($position['val'])
								<tr>
									<td>
										{{ $position['name'] }}
									</td>
									<td>
										{{ $position['val'] }}
									</td>
								</tr>
								@endif
							@endforeach
						</tbody>
					</table>
					</div>
				</div>					
			</div>
		</div>
	</div>
</div>
@endif