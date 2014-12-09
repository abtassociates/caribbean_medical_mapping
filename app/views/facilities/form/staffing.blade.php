<div class="group-wrapper">

{{ View::make('widget.header', array(
	'label' => "Including yourself, how many regular employees (in the following categories) work at this ".$instance->facility_term."?",
	'text' => 'Count staff by the primary job title or position if they have more than one role.<br /><br /><strong>Note:</strong> Do not double-count staff. Please distinguish between full-time employees and those that work less than full time.'
)) }}
</div>

<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => 'Physician - General Practicioner',
	'text' => '',
	'secondary' => 'true'
)) }}

{{ View::make('widget.numberInput', array(
	'model' => $model,
	'field' => 'empphys',
	'label' => 'Full Time',
	'secondary' => 'true'
)) }}

{{ View::make('widget.numberInput', array(
	'model' => $model,
	'field' => 'empphyspart',
	'label' => 'NOT Full Time',
	'secondary' => 'true'
)) }}
</div>

<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => 'Physician Assistant',
	'text' => '',
	'secondary' => 'true'
)) }}

{{ View::make('widget.numberInput', array(
	'model' => $model,
	'field' => 'empphysassist',
	'label' => 'Full Time',
	'secondary' => 'true'
)) }}

{{ View::make('widget.numberInput', array(
	'model' => $model,
	'field' => 'empphysassistpart',
	'label' => 'NOT Full Time',
	'secondary' => 'true'
)) }}
</div>

<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => 'Physician - Specialist',
	'text' => '',
	'secondary' => 'true',
	'addClass' => 'popup',
	'popContent' => 'Specialists are doctors who have completed advanced education and clinical training in a specific area of medicine (not general practitioners)'
)) }}

{{ View::make('widget.numberInput', array(
	'model' => $model,
	'field' => 'empphysspec',
	'label' => 'Full Time',
	'secondary' => 'true'
)) }}

{{ View::make('widget.numberInput', array(
	'model' => $model,
	'field' => 'empphysspecpart',
	'label' => 'NOT Full Time',
	'secondary' => 'true'
)) }}

{{ View::make('widget.textArea', array(
	'model' => $model,
	'field' => 'empphysspectypes',
	'label' => 'Specify Type(s):',
	'secondary' => 'true'
)) }}
</div>

<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => 'Nurse',
	'text' => '',
	'secondary' => 'true'
)) }}

{{ View::make('widget.numberInput', array(
	'model' => $model,
	'field' => 'empnurse',
	'label' => 'Full Time',
	'secondary' => 'true'
)) }}

{{ View::make('widget.numberInput', array(
	'model' => $model,
	'field' => 'empnursepart',
	'label' => 'NOT Full Time',
	'secondary' => 'true'
)) }}
</div>

<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => 'Nurse Assistant',
	'text' => '',
	'secondary' => 'true'
)) }}

{{ View::make('widget.numberInput', array(
	'model' => $model,
	'field' => 'empnursassist',
	'label' => 'Full Time',
	'secondary' => 'true'
)) }}

{{ View::make('widget.numberInput', array(
	'model' => $model,
	'field' => 'empnursassistpart',
	'label' => 'NOT Full Time',
	'secondary' => 'true'
)) }}
</div>

<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => 'Pharmacist',
	'text' => '',
	'secondary' => 'true'
)) }}

{{ View::make('widget.numberInput', array(
	'model' => $model,
	'field' => 'emppharm',
	'label' => 'Full Time',
	'secondary' => 'true'
)) }}

{{ View::make('widget.numberInput', array(
	'model' => $model,
	'field' => 'emppharmpart',
	'label' => 'NOT Full Time',
	'secondary' => 'true'
)) }}
</div>

<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => 'Pharmacy Technician',
	'text' => '',
	'secondary' => 'true'
)) }}

{{ View::make('widget.numberInput', array(
	'model' => $model,
	'field' => 'emppharmtech',
	'label' => 'Full Time',
	'secondary' => 'true'
)) }}

{{ View::make('widget.numberInput', array(
	'model' => $model,
	'field' => 'emppharmtechpart',
	'label' => 'NOT Full Time',
	'secondary' => 'true'
)) }}
</div>

<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => 'Laboratory Technician',
	'text' => '',
	'secondary' => 'true'
)) }}

{{ View::make('widget.numberInput', array(
	'model' => $model,
	'field' => 'emplabtech',
	'label' => 'Full Time',
	'secondary' => 'true'
)) }}

{{ View::make('widget.numberInput', array(
	'model' => $model,
	'field' => 'emplabtechpart',
	'label' => 'NOT Full Time',
	'secondary' => 'true'
)) }}
</div>

<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => 'Dentist',
	'text' => '',
	'secondary' => 'true'
)) }}

{{ View::make('widget.numberInput', array(
	'model' => $model,
	'field' => 'empdentist',
	'label' => 'Full Time',
	'secondary' => 'true'
)) }}

{{ View::make('widget.numberInput', array(
	'model' => $model,
	'field' => 'empdentistpart',
	'label' => 'NOT Full Time',
	'secondary' => 'true'
)) }}
</div>

<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => 'Dental Assistant',
	'text' => '',
	'secondary' => 'true'
)) }}

{{ View::make('widget.numberInput', array(
	'model' => $model,
	'field' => 'empdentassist',
	'label' => 'Full Time',
	'secondary' => 'true'
)) }}

{{ View::make('widget.numberInput', array(
	'model' => $model,
	'field' => 'empdentassistpart',
	'label' => 'NOT Full Time',
	'secondary' => 'true'
)) }}
</div>

<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => 'Technical/Clinical Assistant',
	'text' => '',
	'secondary' => 'true'
)) }}

{{ View::make('widget.numberInput', array(
	'model' => $model,
	'field' => 'emptech',
	'label' => 'Full Time',
	'secondary' => 'true'
)) }}

{{ View::make('widget.numberInput', array(
	'model' => $model,
	'field' => 'emptechpart',
	'label' => 'NOT Full Time',
	'secondary' => 'true'
)) }}
</div>

<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => 'Administrative/Clerical',
	'text' => '',
	'secondary' => 'true'
)) }}

{{ View::make('widget.numberInput', array(
	'model' => $model,
	'field' => 'empadmin',
	'label' => 'Full Time',
	'secondary' => 'true'
)) }}

{{ View::make('widget.numberInput', array(
	'model' => $model,
	'field' => 'empadminpart',
	'label' => 'NOT Full Time',
	'secondary' => 'true'
)) }}
</div>

<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => 'Non-Admin Support Staff',
	'text' => '',
	'secondary' => 'true',
	'addClass' => 'popup',
	'popContent' => 'Examples include cleaning personnel and janitorial services'
)) }}

{{ View::make('widget.numberInput', array(
	'model' => $model,
	'field' => 'empnonadmin',
	'label' => 'Full Time',
	'secondary' => 'true'
)) }}

{{ View::make('widget.numberInput', array(
	'model' => $model,
	'field' => 'empnonadminpart',
	'label' => 'NOT Full Time',
	'secondary' => 'true'
)) }}
</div>

<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => 'Outreach Worker (NGO Only)',
	'text' => '',
	'secondary' => 'true'
)) }}

{{ View::make('widget.numberInput', array(
	'model' => $model,
	'field' => 'empout',
	'label' => 'Full Time',
	'secondary' => 'true'
)) }}

{{ View::make('widget.numberInput', array(
	'model' => $model,
	'field' => 'empoutpart',
	'label' => 'NOT Full Time',
	'secondary' => 'true'
)) }}

</div>

<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => 'Volunteer (NGO Only)',
	'text' => 'Work with your organization on a consistent basis (at least once per month)',
	'secondary' => 'true'
)) }}

{{ View::make('widget.numberInput', array(
	'model' => $model,
	'field' => 'empvolun',
	'label' => 'Full Time',
	'secondary' => 'true'
)) }}

{{ View::make('widget.numberInput', array(
	'model' => $model,
	'field' => 'empvolunpart',
	'label' => 'NOT Full Time',
	'secondary' => 'true'
)) }}
</div>
<div class="group-wrapper">

{{ View::make('widget.header', array(
	'label' => 'Other Non-Full Time Employees',
	'text' => '',
	'secondary' => 'true'
)) }}

{{ View::make('widget.textArea', array(
	'model' => $model,
	'field' => 'empnotes',
	'label' => 'Add notes on non-full time employees, including part time, those on retainer, and contractual/seasonal employees:'
)) }}
</div>
<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => "How many of the following does this ".$instance->facility_term." have?",
	'text' => ''
)) }}

{{ View::make('widget.numberInput', array(
	'model' => $model,
	'field' => 'facilityexam',
	'label' => 'Examination Rooms',
	'secondary' => 'true'
)) }}

{{ View::make('widget.numberInput', array(
	'model' => $model,
	'field' => 'facilityop',
	'label' => 'Operating Rooms/Theaters',
	'secondary' => 'true'
)) }}

{{ View::make('widget.numberInput', array(
	'model' => $model,
	'field' => 'facilityin',
	'label' => 'Inpatient Beds',
	'secondary' => 'true'
)) }}
</div>