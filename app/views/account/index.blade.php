@extends('layouts.default')

@section('content')
<div class="page-header font-style-1">
    <h1>Edit your settings</h1>
</div>


<div class="row">
  <div class="col-xs-6">

	<form class="form-horizontal" method="post" autocomplete="off">
		<!-- CSRF Token -->
		<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
		<!-- ./ csrf token -->
		<!-- General tab -->
		<div class="tab-pane active" id="tab-general">

			@if($errors->first())

				<div class="alert alert-danger alert-block">
					<button type="button" class="close" data-dismiss="alert">×</button>
					@foreach($errors->all() as $error)
						{{ $error }}<br>
					@endforeach
				</div>

			@endif
			
			@if(Session::get('message'))
				<div class="alert alert-success">{{ Session::get('message') }}</div>
			@endif

			<!-- first_name -->
			<div class="form-group">
				<label class="col-md-2 control-label" for="first_name">Role</label>
				<div class="col-md-10">
					<input disabled class="form-control" type="text" name="first_name" id="first_name" value="{{ $user->currentRoleList() }}" />
				</div>
			</div>
			<!-- ./ first_name -->

			<!-- first_name -->
			<div class="form-group {{{ $errors->has('first_name') ? 'error' : '' }}}">
				<label class="col-md-2 control-label" for="first_name">First Name</label>
				<div class="col-md-10">
					<input class="form-control" type="text" name="first_name" id="first_name" value="{{{ Input::old('first_name', $user->first_name) }}}" />
					{{ $errors->first('first_name', '<span class="help-inline">:message</span>') }}
				</div>
			</div>
			<!-- ./ first_name -->

			<!-- last_name -->
			<div class="form-group {{{ $errors->has('last_name') ? 'error' : '' }}}">
				<label class="col-md-2 control-label" for="last_name">Last Name</label>
				<div class="col-md-10">
					<input class="form-control" type="text" name="last_name" id="last_name" value="{{{ Input::old('last_name', $user->last_name) }}}" />
					{{ $errors->first('last_name', '<span class="help-inline">:message</span>') }}
				</div>
			</div>
			<!-- ./ last_name -->

			<!-- Email -->
			<div class="form-group {{{ $errors->has('email') ? 'error' : '' }}}">
				<label class="col-md-2 control-label" for="email">Email</label>
				<div class="col-md-10">
					<input class="form-control" type="text" name="email" id="email" value="{{{ Input::old('email', $user->email) }}}" />
					{{ $errors->first('email', '<span class="help-inline">:message</span>') }}
				</div>
			</div>
			<!-- ./ email -->

			<!-- Password -->
			<div class="form-group {{{ $errors->has('password') ? 'error' : '' }}}">
				<label class="col-md-2 control-label" for="password">Password</label>
				<div class="col-md-10">
					<input class="form-control" type="password" name="password" id="password" value="" />
					{{ $errors->first('password', '<span class="help-inline">:message</span>') }}
				</div>
			</div>
			<!-- ./ password -->

			<!-- Password Confirm -->
			<div class="form-group {{{ $errors->has('password_confirmation') ? 'error' : '' }}}">
				<label class="col-md-2 control-label" for="password_confirmation">Password Confirm</label>
				<div class="col-md-10">
					<input class="form-control" type="password" name="password_confirmation" id="password_confirmation" value="" />
					{{ $errors->first('password_confirmation', '<span class="help-inline">:message</span>') }}
				</div>
			</div>
			<!-- ./ password confirm -->
		</div>
		<!-- ./ general tab -->

		<!-- Form Actions -->
		<div class="form-group">
			<div class="col-md-offset-2 col-md-10">
				<button type="submit" class="btn btn-custom-blue">Update</button>
			</div>
		</div>
		<!-- ./ form actions -->
	</form>

</div>
</div>
@stop