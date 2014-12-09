@extends('layouts.default')


@section('content')

	<div class="page-header">
		<h1 class="facPageHeader">
			<strong>{{ $facility->facilityname }}</strong>
		</h1>
		<div class="facButtons">

			 	@if(Auth::check() && Auth::user()->canEditFacility($facility))
					<div class="pull-right show-edit-bt">
						<a class="btn btn-custom-blue" href="/facilities/{{ $facility->id }}/edit">Edit</a>
					</div>
				@endif

				<div class="pull-right show-edit-bt error-button" title="Report errors in this facility's information.">
					<a class="btn btn-custom-blue" data-toggle="modal" data-target="#error-modal">
						Report Error
					</a>
				</div>
				<div style="clear:both;"></div>
			</div>
	</div>

	@include('partials.facility')

    @include('partials.errorModal')

@stop

@section('scripts')

<script>

var facility = {{ json_encode($facility->toArray()) }};

var map = map_helper.buildStandardMap($(".map-canvas"));

map_helper.addFacilityMarker(map, facility);

</script>

@stop