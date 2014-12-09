<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => 'Proprietor Information',
	'text' => ''
)) }}

{{ View::make('widget.textInput', array(
	'model' => $model,
	'field' => 'fullname',
	'label' => 'Full Name'
)) }}

{{ View::make('widget.textInput', array(
	'model' => $model,
	'field' => 'title',
	'label' => 'Title'
)) }}

{{ View::make('widget.textInput', array(
	'model' => $model,
	'field' => 'telephone',
	'label' => 'Telephone #'
)) }}

{{ View::make('widget.textInput', array(
	'model' => $model,
	'field' => 'email',
	'label' => 'Email address'
)) }}

{{ View::make('widget.singleSelect', array(
	'model' => $model,
	'field' => 'jobcat',
	'label' => 'Job category',
	'options' => $model->getJobCategoryList()
)) }}

{{ View::make('widget.textInput', array(
	'model' => $model,
	'field' => 'jobcatspec',
	'label' => 'Specify',
	'secondary' => true
)) }}

{{ View::make('widget.textInput', array(
	'model' => $model,
	'field' => 'jobcatother',
	'label' => 'Specify',
	'secondary' => true
)) }}

{{ View::make('widget.genderSelect', array(
	'model' => $model,
	'field' => 'gender',
	'label' => 'Gender'
)) }}

{{ View::make('widget.numberInput', array(
	'model' => $model,
	'field' => 'practice',
	'label' => 'How many years have you been in practice?'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'hcppublicpast',
	'label' => "Have you ever worked as a health care ".$instance->facility_term." in the public sector? Additional question will appear if a 'yes' answer is given."
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'hcppubliccurrent',
	'label' => "Do you currently work as a health care ".$instance->facility_term." in the public sector? Additional question will appear if a 'yes' answer is given."
)) }}

{{ View::make('widget.numberInput', array(
	'model' => $model,
	'field' => 'publichours',
	'label' => 'What percentage of your working hours would you estimate is spent in the public sector? Please estimate as best you can.'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'professionalassoc',
	'label' => "Are you currently a member of a professional association? Additional questions will appear if a 'yes' answer is given."
)) }}

{{ View::make('widget.textArea', array(
	'model' => $model,
	'field' => 'assoc',
	'label' => 'Please specify the associations you belong to.'
)) }}
</div>