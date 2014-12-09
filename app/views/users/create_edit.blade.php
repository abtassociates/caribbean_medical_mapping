@extends('layouts.default')

@section('content')

	{{ Form::open(array(
		'url' => isset($user) ? "/users/{$user->id}" : "/users",
		'method' => isset($user) ? 'put' : 'post',
		'class'=>'form-horizontal',
		'id' => 'facility-form',
		'role'=>'form'
	)) }}

		<div class="form-group">
		  <label for="first_name">First Name</label>
		  <div>
		    <input
		    	class="form-control"
		    	name="first_name"
		    	type="text"
		    	value="{{{ Input::old('first_name', isset($user) ? $user->first_name : null) }}}"
		    >
		    {{ $errors->first('first_name', '<span class="text-error">:message</span>') }}
		  </div>
		</div>

		<div class="form-group">
		  <label for="last_name">Last Name</label>
		  <div>
		    <input
		    	class="form-control"
		    	name="last_name"
		    	type="text"
		    	value="{{{ Input::old('last_name', isset($user) ? $user->last_name : null) }}}"
		    >
		    {{ $errors->first('last_name', '<span class="text-error">:message</span>') }}
		  </div>
		</div>

		<div class="form-group">
		  <label for="email">Email</label>
		  <div>
		    <input
		    	class="form-control"
		    	name="email"
		    	type="text"
		    	value="{{{ Input::old('email', isset($user) ? $user->email : null) }}}"
		    >
		    {{ $errors->first('email', '<span class="text-error">:message</span>') }}
		  </div>
		</div>

		<div class="form-group {{{ $errors->has('role_id') ? 'error' : '' }}}">
		  <label for="role_id">Role</label>
		  <div>
				{{ Form::select(
					'role_id',
					$roles,
					isset($user) ? $user->getRoleId() : 2,
					array('class'=>'form-control', 'id'=>'role_id')
				) }}
		    {{ $errors->first('role_id', '<span class="text-error">:message</span>') }}
		  </div>
		</div>

		<div class="form-group" id="sector-select-div">
		  <label for="role_id">Edit Privileges by Sector</label>
			<div class="control-group">

				{{ Form::superSelect(
					'sector_ids_[]',
					$sectors,
					(isset($user) ? $user->sectors : array()),
					array('multiple'=>true, 'class'=>'form-control chosen')
				) }}
		    {{ $errors->first('sector_ids_', '<span class="text-error">Users with role "editor" must be associated with at least one sector.</span>') }}

			</div>
		</div>

		<div class="form-group" id="admin-privilege-div">
			<div class="control-group">
				Admin users have edit privileges on all {{ str_plural($instance->facility_term) }}.
			</div>
		</div>

		<div class="form-group">
		  <div>
			<input type="submit" value="Save">
		  </div>
		</div>

	{{ Form::close() }}

@stop

@section('scripts')

<script>

function show_proper_sector_div(){

	var val = $("#role_id").val();

	console.log(val);

	if(val == 1){
		$("#sector-select-div").hide();
		$("#admin-privilege-div").show();
	}

	if(val == 2){
		$("#sector-select-div").show();
		$("#admin-privilege-div").hide();
	}

}


$("document").ready(function(){
	show_proper_sector_div();
});

$("#role_id").change(function(){
	show_proper_sector_div();
});


</script>

@stop