<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => 'Laboratory Services',
	'text' => "For each laboratory test, indicate whether specimens/samples are collected and/or analyzed at the ".$instance->facility_term."."
)) }}
</div>

<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => 'Urinalysis',
	'text' => '',
	'secondary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'coluri',
	'label' => 'Collected Here?',
	'tertiary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'analuri',
	'label' => 'Analyzed here?',
	'tertiary' => 'true'
)) }}
</div>

<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => 'Complete blood count',
	'text' => '',
	'secondary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'colcbc',
	'label' => 'Collected Here?',
	'tertiary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'analcbc',
	'label' => 'Analyzed here?',
	'tertiary' => 'true'
)) }}
</div>

<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => 'HbAIc (diabetes)',
	'text' => '',
	'secondary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'colhbaic',
	'label' => 'Collected Here?',
	'tertiary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'analhbaic',
	'label' => 'Analyzed here?',
	'tertiary' => 'true'
)) }}
</div>

<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => 'PCR viral load',
	'text' => '',
	'secondary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'colpcr',
	'label' => 'Collected Here?',
	'tertiary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'analpcr',
	'label' => 'Analyzed here?',
	'tertiary' => 'true'
)) }}
</div>

<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => 'CD4 count',
	'text' => '',
	'secondary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'colcd4',
	'label' => 'Collected Here?',
	'tertiary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'analcd4',
	'label' => 'Analyzed here?',
	'tertiary' => 'true'
)) }}
</div>

<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => 'Liver function test',
	'text' => '',
	'secondary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'collft',
	'label' => 'Collected Here?',
	'tertiary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'anallft',
	'label' => 'Analyzed here?',
	'tertiary' => 'true'
)) }}
</div>

<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => 'Syphilis test',
	'text' => '',
	'secondary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'colsyph',
	'label' => 'Collected Here?',
	'tertiary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'analsyph',
	'label' => 'Analyzed here?',
	'tertiary' => 'true'
)) }}
</div>

<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => 'Gonorrhea test',
	'text' => '',
	'secondary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'colgono',
	'label' => 'Collected Here?',
	'tertiary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'analgono',
	'label' => 'Analyzed here?',
	'tertiary' => 'true'
)) }}
</div>

<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => 'Dengue fever test',
	'text' => '',
	'secondary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'coldengue',
	'label' => 'Collected Here?',
	'tertiary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'analdengue',
	'label' => 'Analyzed here?',
	'tertiary' => 'true'
)) }}
</div>

<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => 'Acid fast bacilii sputum smear (TB)',
	'text' => '',
	'secondary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'coltb',
	'label' => 'Collected Here?',
	'tertiary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'analtb',
	'label' => 'Analyzed here?',
	'tertiary' => 'true'
)) }}
</div>

<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => 'Immunoglobulin G (toxoplasmosis)',
	'text' => '',
	'secondary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'coltoxo',
	'label' => 'Collected Here?',
	'tertiary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'analtoxo',
	'label' => 'Analyzed here?',
	'tertiary' => 'true'
)) }}
</div>

<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => 'Cancer detection',
	'text' => '',
	'secondary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'colcancer',
	'label' => 'Collected Here?',
	'tertiary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'analcancer',
	'label' => 'Analyzed here?',
	'tertiary' => 'true'
)) }}

{{ View::make('widget.textInput', array(
	'model' => $model,
	'field' => 'cancerspec',
	'label' => 'Specify: <i class="icon-info-sign"></i>',
	'tertiary' => 'true',
	'addClass' => 'popup',
	'popContent' => "Specify the types of cancer detection tests available at the ".$instance->facility_term."."
)) }}

</div>

<div class="group-wrapper">

{{ View::make('widget.header', array(
	'label' => 'Sample Collection',
	'text' => '',
	'secondary' => 'true'
)) }}

{{ View::make('widget.numberInput', array(
	'model' => $model,
	'field' => 'sample',
	'label' => "In an average week, how many samples are collected at this ".$instance->facility_term."?"
)) }}

{{ View::make('widget.numberInput', array(
	'model' => $model,
	'field' => 'analyzed',
	'label' => "In an average week, how many samples are analyzed at this ".$instance->facility_term."?"
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'reagentstock',
	'label' => "Does this ".$instance->facility_term." carry a stock of reagents to conduct diagnostic tests? Additional questions will appear if a 'yes' answer is given."
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'stockout',
	'label' => "Has this ".$instance->facility_term." experienced a stock out of any reagents in the past six months?"
)) }}

{{ View::make('widget.textInput', array(
	'model' => $model,
	'field' => 'reagentsout',
	'label' => 'In the past six months, which specific reagents were most frequently out of stock?'
)) }}

{{ View::make('widget.textInput', array(
	'model' => $model,
	'field' => 'diagout',
	'label' => 'Which diagnostic tests were most frequently unavailable due to reagent shortage or stock-out?'
)) }}

</div>