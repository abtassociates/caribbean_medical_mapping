<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => "".ucfirst($instance->facility_term)." Information",
	'text' => ''
)) }}

{{ View::make('widget.singleSelect', array(
	'model' => $model,
	'field' => 'facilitytype',
	'label' => ucwords($instance->facility_term)." Type",
	'options' => ['Hospital','Private group practice/clinic','Private physician practice (solo)/clinic','Private nurse practice/clinic','Dental practice','Diagnostic Center','Laboratory','Pharmacy','Not-for-profit clinic','Not-for-profit faith-based organization','Not-for-profit community based organization','Other']
)) }}

{{ View::make('widget.textInput', array(
	'model' => $model,
	'field' => 'facilitytypespec',
	'label' => 'Specify:'
)) }}
</div>

<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => "What days of the week are clients seen at this ".$instance->facility_term." and what are the hours of operation on those days?",
	'text' => "For each day select whether the ".$instance->facility_term." is open and enter hours of operation."
)) }}
</div>

<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => 'Monday:',
	'text' => ''
)) }}

{{ View::make('widget.singleSelect', array(
	'model' => $model,
	'field' => 'mon',
	'label' => 'Status',
	'options' => ["Open","Closed","On Call"],
	'secondary' => 'true'
)) }}

{{ View::make('widget.timeInput', array(
	'model' => $model,
	'field' => 'monopen',
	'label' => 'Opening Hour',
	'secondary' => 'true'
)) }}

{{ View::make('widget.timeInput', array(
	'model' => $model,
	'field' => 'monclose',
	'label' => 'Closing Hour',
	'secondary' => 'true'
)) }}
</div>

<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => 'Tuesday:',
	'text' => ''
)) }}

{{ View::make('widget.singleSelect', array(
	'model' => $model,
	'field' => 'tue',
	'label' => 'Status',
	'options' => ["Open","Closed","On Call"],
	'secondary' => 'true'
)) }}

{{ View::make('widget.timeInput', array(
	'model' => $model,
	'field' => 'tueopen',
	'label' => 'Opening Hour',
	'secondary' => 'true'
)) }}

{{ View::make('widget.timeInput', array(
	'model' => $model,
	'field' => 'tueclose',
	'label' => 'Closing Hour',
	'secondary' => 'true'
)) }}
</div>

<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => 'Wednesday:',
	'text' => ''
)) }}

{{ View::make('widget.singleSelect', array(
	'model' => $model,
	'field' => 'wed',
	'label' => 'Status',
	'options' => ["Open","Closed","On Call"],
	'secondary' => 'true')) }}

{{ View::make('widget.timeInput', array(
	'model' => $model,
	'field' => 'wedopen',
	'label' => 'Opening Hour',
	'secondary' => 'true'
)) }}

{{ View::make('widget.timeInput', array(
	'model' => $model,
	'field' => 'wedclose',
	'label' => 'Closing Hour',
	'secondary' => 'true'
)) }}
</div>

<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => 'Thursday:',
	'text' => ''
)) }}

{{ View::make('widget.singleSelect', array(
	'model' => $model,
	'field' => 'thur',
	'label' => 'Status',
	'options' => ["Open","Closed","On Call"],
	'secondary' => 'true'
	)) }}

{{ View::make('widget.timeInput', array(
	'model' => $model,
	'field' => 'thuropen',
	'label' => 'Opening Hour',
	'secondary' => 'true'
)) }}

{{ View::make('widget.timeInput', array(
	'model' => $model,
	'field' => 'thurclose',
	'label' => 'Closing Hour',
	'secondary' => 'true'
)) }}
</div>

<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => 'Friday:',
	'text' => ''
)) }}

{{ View::make('widget.singleSelect', array(
	'model' => $model,
	'field' => 'fri',
	'label' => 'Status',
	'options' => ["Open","Closed","On Call"],
	'secondary' => 'true'
)) }}

{{ View::make('widget.timeInput', array(
	'model' => $model,
	'field' => 'friopen',
	'label' => 'Opening Hour',
	'secondary' => 'true'
)) }}

{{ View::make('widget.timeInput', array(
	'model' => $model,
	'field' => 'friclose',
	'label' => 'Closing Hour',
	'secondary' => 'true'
)) }}
</div>

<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => 'Saturday:',
	'text' => ''
)) }}

{{ View::make('widget.singleSelect', array(
	'model' => $model,
	'field' => 'sat',
	'label' => 'Status',
	'options' => ["Open","Closed","On Call"],
	'secondary' => 'true'
)) }}

{{ View::make('widget.timeInput', array(
	'model' => $model,
	'field' => 'satopen',
	'label' => 'Opening Hour',
	'secondary' => 'true'
)) }}

{{ View::make('widget.timeInput', array(
	'model' => $model,
	'field' => 'satclose',
	'label' => 'Closing Hour',
	'secondary' => 'true'
)) }}
</div>

<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => 'Sunday:',
	'text' => ''
)) }}

{{ View::make('widget.singleSelect', array(
	'model' => $model,
	'field' => 'sun',
	'label' => 'Status',
	'options' => ["Open","Closed","On Call"],
	'secondary' => 'true'
)) }}


{{ View::make('widget.timeInput', array(
	'model' => $model,
	'field' => 'sunopen',
	'label' => 'Opening Hour',
	'secondary' => 'true'
)) }}

{{ View::make('widget.timeInput', array(
	'model' => $model,
	'field' => 'sunclose',
	'label' => 'Closing Hour',
	'secondary' => 'true'
)) }}
</div>

<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => 'Notes:',
	'text' => ''
)) }}
{{ View::make('widget.textArea', array(
	'model' => $model,
	'field' => 'hournotes',
	'label' => 'Additional Notes (e.g. seasonal hours):'
)) }}
</div>