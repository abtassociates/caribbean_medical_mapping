<?php

$sector_list = Sector::getList();

$sector_id = Input::get('sector_id');

?>

<div class="col-xs-11 col-sm-4 col-md-3">
	<div class="form-group filterFormGroup">
	  {{ Form::label('sector_id', 'Sector') }}
	  {{ Form::select('sector_id', $sector_list, $sector_id, array('class'=>'chosen-no-search')) }}
	</div>
</div>