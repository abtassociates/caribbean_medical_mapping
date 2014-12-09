@extends('layouts.default')

{{-- Content --}}
@section('content')
<div class="page-header font-style-1">
    <h1>Users	
		<div class="pull-right">
			<a href="{{{ URL::to('/users/create') }}}" class="btn btn-custom-blue"> Create</a>
		</div>
	</h1>
</div>

	<?php if ( Session::get('message') ): ?>
	<div class="alert alert-success">{{ Session::get('message') }}</div>
	<?php endif; ?>

	<div class="row">
		<div class="col-sm-12">
		<h3>
		
		</h3>
		</div>
	</div>
	
	<div class="row">
		<div class="col-sm-12">
		<table class="table table-striped">
			<thead>
				<tr>
					<th class='col-md-2'>Name</th>
					<th class="col-md-3">Email</th>
					<th class="col-md-2">Role</th>
					<th class="col-md-3">Facility Editting Priveleges</th>
					<th class="col-md-2">Actions</th>
				</tr>
			</thead>
			<tbody>
			@foreach($users as $user)
				<tr>
					<td>{{ $user->last_name }}, {{ $user->first_name }}</td>
					<td>{{ $user->email }}</td>
					<td>{{ $user->currentRoleList() }}</td>
					<td>
						@if($user->can('edit_all_facilities'))
							All Facilities
						@else
							{{ implode($user->getAllowedSectorsList(), ", ") }}


						@endif

					</td>
					<td class="">
						<a href="/users/{{ $user->id }}/edit" class="btn btn-xs btn-default cboxElement">Edit</a>
			  <a href="/users/{{ $user->id }}" class="delete btn btn-xs btn-danger cboxElement" data-method='delete' type="user">Delete</a>
			</td>

				</tr>
			@endforeach
			</tbody>
		</table>
		</div>
	</div>
@stop

{{-- Scripts --}}
@section('scripts')


@stop