<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => 'Health Records and Reporting',
	'text' => ''
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'healthstat',
	'label' => "Does your ".$instance->facility_term." report health statistics to the MOH? Additional questions will appear if a 'yes' answer is given."
)) }}
</div>

<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => 'For the health reporting options listed below, please indicate what type of health information you report, and the recipient of this information.',
	'text' => '',
	'id' => 'I2ReportingOptions'
)) }}
</div>

<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => 'STI test results',
	'text' => '',
	'secondary' => 'true',
	'id' => 'I2aSTItestresults'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'reportsti',
	'label' => "Do you report? Additional questions will appear if a 'yes' answer is given.",
	'tertiary' => 'true'
)) }}

{{ View::make('widget.textInput', array(
	'model' => $model,
	'field' => 'recipsti',
	'label' => 'Recipient',
	'tertiary' => 'true'
)) }}

{{ View::make('widget.singleSelect', array(
	'model' => $model,
	'field' => 'freqsti',
	'label' => 'Reporting Frequency',
	'options' => ["As requested","As diagnosed","Weekly","Monthly","Quarterly","Annually","Other"],
	'tertiary' => 'true'
)) }}

{{ View::make('widget.textInput', array(
	'model' => $model,
	'field' => 'freqspecsti',
	'label' => 'Specify:',
	'tertiary' => 'true'
)) }}

{{ View::make('widget.singleSelect', array(
	'model' => $model,
	'field' => 'methodsti',
	'label' => 'Reporting Method',
	'options' => ["Telephone","Paper reporting","Email","Other"],
	'tertiary' => 'true'
)) }}

{{ View::make('widget.textInput', array(
	'model' => $model,
	'field' => 'methodspecsti',
	'label' => 'Specify:',
	'tertiary' => 'true'
)) }}
</div>

<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => 'HIV test results',
	'text' => '',
	'secondary' => 'true',
	'id' => 'I2bHIVtestresults'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'reporthiv',
	'label' => "Do you report? Additional questions will appear if a 'yes' answer is given.",
	'tertiary' => 'true'
)) }}

{{ View::make('widget.textInput', array(
	'model' => $model,
	'field' => 'reciphiv',
	'label' => 'Recipient',
	'tertiary' => 'true'
)) }}

{{ View::make('widget.singleSelect', array(
	'model' => $model,
	'field' => 'freqhiv',
	'label' => 'Reporting Frequency',
	'options' => ["As requested","As diagnosed","Weekly","Monthly","Quarterly","Annually","Other"],
	'tertiary' => 'true'
)) }}

{{ View::make('widget.textInput', array(
	'model' => $model,
	'field' => 'freqspechiv',
	'label' => 'Specify:',
	'tertiary' => 'true'
)) }}

{{ View::make('widget.singleSelect', array(
	'model' => $model,
	'field' => 'methodhiv',
	'label' => 'Reporting Method',
	'options' => ["Telephone","Paper reporting","Email","Other"],
	'tertiary' => 'true'
)) }}

{{ View::make('widget.textInput', array(
	'model' => $model,
	'field' => 'methodspechiv',
	'label' => 'Specify:',
	'tertiary' => 'true'
)) }}
</div>

<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => 'Notifiable diseases (e.g. dengue fever)',
	'text' => '',
	'secondary' => 'true',
	'id' => 'I2cNotifiablediseases'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'reportnotedis',
	'label' => "Do you report? Additional questions will appear if a 'yes' answer is given.",
	'tertiary' => 'true'
)) }}

{{ View::make('widget.textInput', array(
	'model' => $model,
	'field' => 'recipnotedis',
	'label' => 'Recipient',
	'tertiary' => 'true'
)) }}

{{ View::make('widget.singleSelect', array(
	'model' => $model,
	'field' => 'freqnotedis',
	'label' => 'Reporting Frequency',
	'options' => ["As requested","As diagnosed","Weekly","Monthly","Quarterly","Annually","Other"],
	'tertiary' => 'true'
)) }}

{{ View::make('widget.textInput', array(
	'model' => $model,
	'field' => 'freqspecnotedis',
	'label' => 'Specify:',
	'tertiary' => 'true'
)) }}

{{ View::make('widget.singleSelect', array(
	'model' => $model,
	'field' => 'methodnotedis',
	'label' => 'Reporting Method',
	'options' => ["Telephone","Paper reporting","Email","Other"],
	'tertiary' => 'true'
)) }}


{{ View::make('widget.textInput', array(
	'model' => $model,
	'field' => 'methodspecnotedis',
	'label' => 'Specify:',
	'tertiary' => 'true'
)) }}
</div>

<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => 'Health service statistics',
	'text' => '',
	'secondary' => 'true',
	'id' => 'I2dHealthservices'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'reporthealthstat',
	'label' => "Do you report? Additional questions will appear if a 'yes' answer is given.",
	'tertiary' => 'true'
)) }}

{{ View::make('widget.textInput', array(
	'model' => $model,
	'field' => 'reciphealthstat',
	'label' => 'Recipient',
	'tertiary' => 'true'
)) }}

{{ View::make('widget.singleSelect', array(
	'model' => $model,
	'field' => 'freqhealthstat',
	'label' => 'Reporting Frequency',
	'options' => ["As requested","As diagnosed","Weekly","Monthly","Quarterly","Annually","Other"],
	'tertiary' => 'true'
)) }}

{{ View::make('widget.textInput', array(
	'model' => $model,
	'field' => 'freqspechealthstat',
	'label' => 'Specify:',
	'tertiary' => 'true'
)) }}

{{ View::make('widget.singleSelect', array(
	'model' => $model,
	'field' => 'methodhealthstat',
	'label' => 'Reporting Method',
	'options' => ["Telephone","Paper reporting","Email","Other"],
	'tertiary' => 'true'
)) }}

{{ View::make('widget.textInput', array(
	'model' => $model,
	'field' => 'methodspechealthstat',
	'label' => 'Specify:',
	'tertiary' => 'true'
)) }}
</div>

<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => 'Other',
	'text' => '',
	'secondary' => 'true',
	'id' => 'I2eOther'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'reportother',
	'label' => "Do you report? Additional questions will appear if a 'yes' answer is given.",
	'tertiary' => 'true'
)) }}

{{ View::make('widget.textInput', array(
	'model' => $model,
	'field' => 'reportotherspec',
	'label' => 'Specify:',
	'tertiary' => 'true'
)) }}

{{ View::make('widget.textInput', array(
	'model' => $model,
	'field' => 'recipother',
	'label' => 'Recipient',
	'tertiary' => 'true'
)) }}

{{ View::make('widget.singleSelect', array(
	'model' => $model,
	'field' => 'freqother',
	'label' => 'Reporting Frequency',
	'options' => ["As requested","As diagnosed","Weekly","Monthly","Quarterly","Annually","Other"],
	'tertiary' => 'true'
)) }}

{{ View::make('widget.textInput', array(
	'model' => $model,
	'field' => 'freqspecother',
	'label' => 'Specify:',
	'tertiary' => 'true'
)) }}

{{ View::make('widget.singleSelect', array(
	'model' => $model,
	'field' => 'methodother',
	'label' => 'Reporting Method',
	'options' => ["Telephone","Paper reporting","Email","Other"],
	'tertiary' => 'true'
)) }}

{{ View::make('widget.textInput', array(
	'model' => $model,
	'field' => 'methodspecother',
	'label' => 'Specify:',
	'tertiary' => 'true'
)) }}
</div>

<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => 'Preferred Reporting Method',
	'text' => '',
	'secondary' => 'true',
	'id' => 'reportingPreferredMethod'
)) }}


{{ View::make('widget.singleSelect', array(
	'model' => $model,
	'field' => 'reportpref',
	'label' => 'What is your preferred method for reporting health data to the MOH?',
	'options' => ["Telephone","Paper Reporting","Email","Mobile phone via text messaging","Fax","Other"]
)) }}

{{ View::make('widget.textInput', array(
	'model' => $model,
	'field' => 'reportprefotherspec',
	'label' => 'Specify:',
	'tertiary' => 'true'
)) }}
</div>

