<div class="modal fade" id="missing-modal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
	<div class="modal-dialog">
  		<div class="modal-content">
			<form class="error-form" action="/facilities/missing">

				{{ Form::token() }}

				<div style="position: absolute; left: 50%; top: 200px; z-index: 100;">
				    <div class="error-submitting">
				        submitting...
				    </div>
				</div>

	    		<div class="modal-header">
	        		<h4 class="modal-title">Report Missing {{ ucwords($instance->facility_term) }}</h4>
	    		</div>

			    <div class="modal-body">

					<div class="form-group">
						{{ Form::label('facilityname', ucfirst($instance->facility_term) . " Name*") }}
						<span class="text-error"></span>
						{{ Form::text('facilityname', null, array("class"=>"form-control")); }}
					</div>

					<div class="form-group">
						{{ Form::label('name', 'Your Name*') }} <span class="text-error"></span>
						{{ Form::text('name', null, array("class"=>"form-control")); }}
					</div>

					<div class="form-group">
						{{ Form::label('email', 'Your Email') }} <span class="text-error"></span>
						{{ Form::text('email', null, array("class"=>"form-control")); }}
					</div>

					<div class="form-group">
						{{ Form::label('phone', 'Your Phone') }} <span class="text-error"></span>
						{{ Form::text('phone', null, array("class"=>"form-control")); }}
					</div>

					<div class="form-group">
						{{ Form::label('issue', 'Information*') }} <span class="text-error"></span>
						{{ Form::textarea('issue', null, array("class"=>"form-control", 'style'=>'height: 150px')); }}
					</div>
			    </div>

			    <div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
					<input type="submit" id="error-submit-button" class="btn btn-primary">
			    </div>

		    </form>
    	</div>
	</div>
</div>