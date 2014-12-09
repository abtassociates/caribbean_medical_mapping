<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => 'Payment for Health Services',
	'text' => "Below is a list of how clients pay for services received.  For each option, please indicate if that payment mechanism is in use at the ".$instance->facility_term."."
)) }}
</div>

<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => 'Fee for service',
	'text' => '',
	'secondary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'fee',
	'label' => 'Used/Accepted here?',
	'tertiary' => 'true'
)) }}
</div>

<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => 'Sliding fee scale based on ability to pay',
	'text' => '',
	'secondary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'sliding',
	'label' => 'Used/Accepted here?',
	'tertiary' => 'true'
)) }}
</div>

<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => 'Allow for payment in-kind',
	'text' => '',
	'secondary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'inkind',
	'label' => 'Used/Accepted here?',
	'tertiary' => 'true'
)) }}
</div>

<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => 'Allow for payment in installments',
	'text' => '',
	'secondary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'install',
	'label' => 'Used/Accepted here?',
	'tertiary' => 'true'
)) }}
</div>

<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => 'Reimbursement from private health insurance',
	'text' => '',
	'secondary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'insurance',
	'label' => "Used/Accepted here? Additional questions will appear if a 'yes' answer is given.",
	'tertiary' => 'true'
)) }}

{{ View::make('widget.numberInput', array(
	'model' => $model,
	'field' => 'privateperc',
	'label' => 'What percentage of your clients uses private health insurance to cover the costs of services?  Please estimate as best as you can.'
)) }}

</div>

<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => 'Other',
	'text' => '',
	'secondary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'other',
	'label' => "Used/Accepted here? Additional questions will appear if a 'yes' answer is given.",
	'tertiary' => 'true'
)) }}

{{ View::make('widget.textInput', array(
	'model' => $model,
	'field' => 'otherspec',
	'label' => 'Specify:',
	'tertiary' => 'true'
)) }}
</div>

<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => 'Other',
	'text' => '',
	'secondary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'other2',
	'label' => "Used/Accepted here? Additional questions will appear if a 'yes' answer is given.",
	'tertiary' => 'true'
)) }}

{{ View::make('widget.textInput', array(
	'model' => $model,
	'field' => 'other2spec',
	'label' => 'Specify:',
	'tertiary' => 'true'
)) }}

</div>

