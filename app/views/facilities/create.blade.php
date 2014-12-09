@extends('layouts.default')

@section('content')

	{{ Form::open(array(
		'url' => "/facilities",
		'method' => 'post',
		'class'=>'form-horizontal',
		'id' => 'facility-form',
		'role'=>'form'
	)) }}

		<div class="page-header">
			<h1 style="dislay:block">
				<strong><i class="icon-edit"></i> Create {{ ucfirst($instance->facility_term) }}</strong> 
				<div class="pull-right show-edit-bt">
					<input type="submit" class="btn btn-primary" value="Save">
				</div>
			</h1>
		</div>

		@if($error)
		<input type="hidden" name="error_id" value="{{ $error->id }}">
		<table class="table table-responsive table-striped table-bordered" style="margin-bottom: 20px">
			<thead>
				<tr>
					<th class="col-md-2">Submitted</th>
					<th class="col-md-2">Reporter</th>
					<th class="col-md-2">{{ ucfirst($instance->facility_term) }} Name</th>
					<th class="col-md-6">Notes</th>
				</tr>
			</thead>
			<tbody>

				<tr>
					<td>{{ HTML::date($error['created_at']) }}</td>
					<td>
						{{ $error['name'] }},
						{{ $error['email'] }},
						{{ $error['phone'] }}
					</td>
					<td>{{ $error['facilityname'] }} </td>
					<td>{{ $error['issue'] }} </td>
				</tr>

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