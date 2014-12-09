@extends('layouts.default')

@section('content')

	{{ Form::open(array(
		'url' => "/facilities/{$facility->id}",
		'method' => 'put',
		'class'=>'form-horizontal',
		'id' => 'facility-form',
		'role'=>'form'
	)) }}

		<div class="page-header">
			<h1 style="dislay:block">
				<strong><i class="icon-edit"></i> Edit {{ ucfirst($instance->facility_term) }}</strong> 
			</h1>
			<div class="facButtons">
			 <div class="pull-right show-edit-bt">
					<input type="submit" class="btn btn-custom-blue" value="Save">
					@if(Auth::user()->canDeleteFacility($facility))
					<a class="btn btn-custom-danger" data-method='delete' href="/facilities/{{ $facility->id }}">Remove</a>
					@endif
				</div>
				<div style="clear:both;"></div>
			</div>
		</div>

		@if($errors->count())

			<table class="table table-responsive table-striped table-bordered" style="margin-bottom: 20px">
				<thead>
					<tr>
						<th class="col-md-1">Errors</th>
						<th class="col-md-2">Submitted</th>
						<th class="col-md-2">Reporter</th>
						<th class="col-md-6">Issue</th>
						<th class="col-md-1">Resolved</th>
					</tr>
				</thead>
				<tbody>

					@foreach($errors as $error)
					<tr>
						<td><i class="icon-flag red"></i></td>
						<td>{{ HTML::date($error['created_at']) }}</td>
						<td>
							{{ $error['name'] }},
							{{ $error['email'] }},
							{{ $error['phone'] }}
						</td>
						<td>{{ $error['issue'] }} </td>
						<td>{{ Form::checkbox("errors[".$error['id']."]", 1) }}
					</tr>
					@endforeach

				</tbody>
			</table>

		@endif

		@include('partials.facilityEditCreate')

	{{ Form::close() }}

@stop


@section('scripts')

	<script src="/assets/js/custom/facility/map.js"></script>
	<script src="/assets/js/custom/facility/edit_helper.js"></script>
	<script src="/assets/js/custom/facility/edit.js"></script>

@stop


@section('styles')

	<link rel="stylesheet" href="/assets/css/custom/facilities.css" />

@stop