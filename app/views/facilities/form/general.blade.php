<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => 'General Information',
	'text' => '',
	'secondary' => 'true'
)) }}

{{ View::make('widget.dateInput', array(
	'model' => $model,
	'field' => 'interviewdate',
	'label' => 'Interview Date'
)) }}

{{ View::make('widget.textInput', array(
	'model' => $model,
	'field' => 'interviewinitial',
	'label' => 'Interview Initials'
)) }}

{{ View::make('widget.singleSelect', array(
	'model' => $model,
	'field' => 'sector_id',
	'label' => 'Sector <i class="icon-info-sign"></i>',
	'options' => Auth::user()->getAllowedSectorsList(),
	'retain_options' => true,
	'addClass' => 'popup',
	'popContent' => "If ".$instance->facility_term." is in dual practice (works in both public and private sector) create a unique entry for both " .str_plural($instance->facility_term)."."
)) }}

{{ View::make('widget.textInput', array(
	'model' => $model,
	'field' => 'parishisland',
	'label' => 'Parish/Island'
)) }}

{{ View::make('widget.textInput', array(
	'model' => $model,
	'field' => 'facilityname',
	'label' => ucfirst($instance->facility_term)." Name"
)) }}

{{ View::make('widget.textInput', array(
	'model' => $model,
	'field' => 'specialty',
	'label' => "specialty"
)) }}

{{ View::make('widget.textArea', array(
	'model' => $model,
	'field' => 'facilityaddress',
	'label' => "".ucfirst($instance->facility_term). " Address"
)) }}

{{ View::make('widget.check', array(
	'model' => $model,
	'field' => 'consentobtained',
	'label' => 'Consent Obtained?  <i class="icon-info-sign"></i>',
	'addClass' => 'popup',
	'popContent' => "Be sure to obtain the {$instance->facility_term} proprietor’s consent to include their information in the database before proceeding"
)) }}
</div>