@extends('layouts.default')

@section('content')

	{{ Form::open(array('method'=>'get')) }}

		<div class="row" id="filters">
		  <div class="col-xs-12">
		    <div class="row">

				@yield('filters')

				<div class="col-xs-11 col-sm-4 col-md-3">
					<div class="form-group filterFormGroup">
					<!-- blank label bumps buttons down to same hight as filters -->
					<label>&nbsp;</label>
					<a class="btn btn-custom-blue" id="reset-button" href="{{ Request::url() }}">Reset</a>
					<input type="submit" id="submit" class="btn btn-custom-blue" value="Generate">
					</div>
				</div>

		    </div>
		  </div>
		</div>

	{{ Form::close() }}

	<div class="row" id="report">
	  <div class="col-xs-12">
			@yield('report')
		</div>
	</div>

@stop