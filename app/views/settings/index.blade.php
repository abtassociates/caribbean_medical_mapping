@extends('layouts.default')

@section('content')
<div class="page-header font-style-1">
    <h1>Settings</h1>
</div>

@if(Session::get('message'))
	<div class="alert alert-success">{{ Session::get('message') }}</div>
@endif

@if(Session::get('error'))
	<div class="alert alert-danger">{{ Session::get('error') }}</div>
@endif

	{{ Form::model($instance, array('files'=>true, 'role'=>'form', 'id'=>'settings-form')) }}

	{{ Form::hidden('map_lat') }}
	{{ Form::hidden('map_lng') }}
	{{ Form::hidden('map_distance_x') }}
	{{ Form::hidden('map_distance_y') }}

	<div class="row">

		<div class="col-xs-6">

			<div class="form-group">
				{{ Form::label('country', 'Country') . Form::text('country', null, array("class"=>"form-control")) }}
				{{ $errors->first('country', '<span class="text-error">:message</span>') }}
			</div>

			<div class="form-group">
				{{ View::make('widget.helpfulHintLabel', array(
					"input_id" => "google_maps_key",
					"label" => "Logo",
					"hint" => "Upload an image no wider than 400 pixels. It will be displayed in the upper left corner of all pages."
				)) }}
				<br>
	    		{{ HTML::image($instance->getLogoPath(), "logo", array("class"=>"logo")) }}
				{{ Form::file('logo', null, array("class"=>"form-control")) }}
				{{ $errors->first('logo', '<span class="text-error">:message</span>') }}
			</div>

			<div class="form-group">
				{{ View::make('widget.helpfulHintLabel', array(
					"input_id" => "main_color",
					"label" => "Main Color",
					"hint" => "Determines the background color behind the title at the top of all pages."
				)) }}
				{{ Form::text('main_color', null, array("class"=>"form-control colorpicker")); }}
				{{ $errors->first('main_color', '<span class="text-error">:message</span>') }}
			</div>

			<div class="form-group">
				{{ View::make('widget.helpfulHintLabel', array(
					"input_id" => "accent_color",
					"label" => "Accent Color",
					"hint" => "Determines the background color of the left sidebar and top accent line on all pages."
				)) }}
				{{ Form::text('accent_color', null, array("class"=>"form-control colorpicker")); }}
				{{ $errors->first('accent_color', '<span class="text-error">:message</span>') }}
			</div>

			<div class="form-group">
				<p>{{ Form::label('font_color', 'Site Title Font Color') }}</p>
				{{ Form::label('font_color_active', 'White', array('class'=>'plain')) . Form::radio('font_color', 1, $instance->font_color, array("id"=>"font_color_active")); }}
				{{ Form::label('font_color_not_active', 'Black', array('class'=>'plain')) . Form::radio('font_color', 0, !$instance->font_color, array("id"=>"font_color_not_active")); }}
				{{ $errors->first('font_color', '<span class="text-error">:message</span>') }}
			</div>

			<div class="form-group">
				{{ View::make('widget.helpfulHintLabel', array(
					"input_id" => "facility_term",
					"label" => "Term for Facility (e.g. facility, clinic, location)",
					"hint" => "Must be a lower-case, singular term. It will be adapted throughout the site with appropriate capitalization and pluralization to refer to listings."
				)) }}
				{{ Form::text('facility_term', null, array("class"=>"form-control", "id"=>"facility_term")); }}
				{{ $errors->first('facility_term', '<span class="text-error">:message</span>') }}
			</div>

			<div class="form-group">
				{{ View::make('widget.helpfulHintLabel', array(
					"input_id" => "google_analytics_key",
					"label" => "Google Analytics Key",
					"hint" => "Will insert Google Analytics tracking so that usage patterns may be analayzed."
				)) }}
				{{ Form::text('google_analytics_key', null, array("class"=>"form-control")); }}
				{{ $errors->first('google_analytics_key', '<span class="text-error">:message</span>') }}
			</div>

			<div class="form-group">
				{{ View::make('widget.helpfulHintLabel', array(
					"input_id" => "google_maps_key",
					"label" => "Google Maps API Key",
					"hint" => "Enter a Google Maps API V3 key. This is needed to reliably display Google maps in the application"
				)) }}
				{{ Form::text('google_maps_key', null, array("class"=>"form-control")); }}
				{{ $errors->first('google_maps_key', '<span class="text-error">:message</span>') }}
			</div>

			<div class="form-group">
				<p>
				{{ View::make('widget.helpfulHintLabel', array(
					"input_id" => "api",
					"label" => "API",
					"hint" => "Sets whether an 'Application Programming Interface' for the public data on this site should be available to third parties. Accessible at <domain>/api/v1"
				)) }}
				</p>
				{{ Form::label('api_active', 'Active', array('class'=>'plain')) . Form::radio('api', 1, $instance->api, array("id"=>"api_active")); }}
				{{ Form::label('api_not_active', 'Disabled', array('class'=>'plain')) . Form::radio('api', 0, !$instance->api, array("id"=>"api_not_active")); }}
				{{ $errors->first('api', '<span class="text-error">:message</span>') }}
			</div>

		</div>

		<div class="col-xs-6">

			<div class="form-group">
		    	<label>Default Map Position</label>
				<div style="height: 300px; width: 500px" id="map-canvas"></div>
			</div>

			<div class="form-group">
				{{ View::make('widget.helpfulHintLabel', array(
					"input_id" => "meta_description",
					"label" => "Meta Description",
					"hint" => "Will be shown in search results for Google and other search engines. Must not exceed 160 characters."
				)) }}
				{{ Form::textarea('meta_description', null, array("class"=>"form-control")); }}
				{{ $errors->first('meta_description', '<span class="text-error">:message</span>') }}
			</div>

			<div class="form-group">
				{{ View::make('widget.helpfulHintLabel', array(
					"input_id" => "version",
					"label" => "Application Version",
					"hint" => "This indicates which version of this application you are currently running. It can only be changed by a server admin retrieving a newer version if available."
				)) }}
				{{ Form::text('version', $instance->getVersion(), array("disabled"=>"disabled", "readonly"=>"readonly", "class"=>"form-control")); }}
			</div>


			<div class="form-group">
				{{ Form::submit('Save', array('class'=>"btn btn-default")) }}
			</div>

		</div>
	</div>

	

	{{ Form::close() }}

@stop

@section('scripts')

	<script src="/assets/js/custom/settings/index.js"></script>

@stop