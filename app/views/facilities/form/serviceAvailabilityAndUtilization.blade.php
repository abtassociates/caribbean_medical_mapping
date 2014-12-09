<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => 'Service Utilization',
	'text' => "Identify services available at the ".$instance->facility_term." and the rate of utilization by clients.  Estimate if exact utilization rates are not known."
)) }}

{{ View::make('widget.numberInput', array(
	'model' => $model,
	'field' => 'outpatient',
	'label' => "In an average week, how many outpatient visits are there at the ".$instance->facility_term."?"
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'inpatient',
	'label' => "Does the ".$instance->facility_term." accept inpatients? Additional questions will appear if a 'yes' answer is given."
)) }}

{{ View::make('widget.numberInput', array(
	'model' => $model,
	'field' => 'inpatientadmin',
	'label' => "In an average week, how many inpatient admissions are there at the ".$instance->facility_term."?"
)) }}
</div>

<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => 'Service Availability',
	'text' => "Indicate whether each of the services below is currently available at the ".$instance->facility_term.".<br/><br />Dentists, skip to 'Oral Hygiene' question towards the end of this section."
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'pedcare',
	'label' => 'Pediatric care',
	'secondary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'rep',
	'label' => 'Reproductive health and family planning',
	'secondary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'ante',
	'label' => 'Antenatal care',
	'secondary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'labor',
	'label' => 'Labor and delivery services',
	'secondary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'hyper',
	'label' => 'Care for hypertension',
	'secondary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'diab',
	'label' => 'Care for diabetes',
	'secondary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'cancer',
	'label' => 'Cancer detection',
	'secondary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'cancertreat',
	'label' => 'Cancer treatment',
	'secondary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'drug',
	'label' => 'Drug/alcohol abuse prevention or treatment services',
	'secondary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'stidiag',
	'label' => 'Sexually transmitted infections diagnosis',
	'secondary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'stitreat',
	'label' => 'Sexually transmitted infections treatment',
	'secondary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'social',
	'label' => 'Social services/support',
	'secondary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'comm',
	'label' => 'Community health services',
	'secondary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'nutri',
	'label' => 'Nutrition/dietary services',
	'secondary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'surgerylocal',
	'label' => 'Surgery - local anethesia',
	'secondary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'surgerygen',
	'label' => 'Surgery - general anesthesia',
	'secondary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'condom',
	'label' => 'Condom distribution and/or social marketing of condoms [NGO Only]',
	'secondary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'oral',
	'label' => 'Oral hygiene and dental care [Dentists]',
	'secondary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'hivout',
	'label' => 'HIV information, education, and outreach [NGO Only]',
	'secondary' => 'true'
)) }}

</div>
<div class="group-wrapper">

{{ View::make('widget.header', array(
	'label' => 'Select target populations for HIV information, education, and outreach activities:',
	'text' => '',
	'tertiary' => 'true',
	'id' => 'E4qHIVTargetHeader'
)) }}


{{ View::make('widget.check', array(
	'model' => $model,
	'field' => 'hivoutcsw',
	'label' => 'Commercial Sex Workers',
	'tertiary' => 'true'
)) }}

{{ View::make('widget.check', array(
	'model' => $model,
	'field' => 'hivoutmsm',
	'label' => 'Men who have Sex with Men',
	'tertiary' => 'true'
)) }}

{{ View::make('widget.check', array(
	'model' => $model,
	'field' => 'hivoutyouth',
	'label' => 'Youth',
	'tertiary' => 'true'
)) }}

{{ View::make('widget.check', array(
	'model' => $model,
	'field' => 'hivoutprisoners',
	'label' => 'Prisoners',
	'tertiary' => 'true'
)) }}

{{ View::make('widget.textInput', array(
	'model' => $model,
	'field' => 'hivoutother',
	'label' => 'Other (Specify):',
	'tertiary' => 'true'
)) }}

</div>

<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => 'Additional Services',
	'text' => '',
	'tertiary' => 'true',
	'id' => 'serviceAdditionalServices'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'specialty',
	'label' => "Are there any additional services provided at the ".$instance->facility_term." that have not yet been mentioned? Additional questions will appear if a 'yes' answer is given."
)) }}

{{ View::make('widget.textArea', array(
	'model' => $model,
	'field' => 'specialtyspec',
	'label' => 'Please specify the additional services offered: <i class="icon-info-sign"></i>',
	'addClass' => 'popup',
	'popContent' => 'Please separate multiple items with commas'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'request',
	'label' => "Are there any services you do not provide that clients specifically request? Additional questions will appear if a 'yes' answer is given."
)) }}

{{ View::make('widget.textArea', array(
	'model' => $model,
	'field' => 'requestspec',
	'label' => 'Please specify the additional service(s) offered: <i class="icon-info-sign"></i>',
	'addClass' => 'popup',
	'popContent' => 'Please separate multiple items with commas'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'specialtyvisit',
	'label' => "Have you ever organized specialty medical services from visiting specialists from other countries at your ".$instance->facility_term." or any other ".$instance->facility_term."? Additional questions will appear if a 'yes' answer is given."
)) }}

{{ View::make('widget.textArea', array(
	'model' => $model,
	'field' => 'specialtyvisitspec',
	'label' => 'Please specify the specialty services and the frequency of specialist visits. <i class="icon-info-sign"></i>',
	'addClass' => 'popup',
	'popContent' => 'Please separate multiple items with commas'
)) }}

</div>
<div class="group-wrapper">

{{ View::make('widget.header', array(
	'label' => 'Referrals',
	'text' => '',
	'tertiary' => 'true',
	'id' => 'serviceReferrals'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'refer',
	'label' => "Do you refer patients from your ".$instance->facility_term." to other health ".str_plural($instance->facility_term)."? Additional questions will appear if a 'yes' answer is given."
)) }}

{{ View::make('widget.textArea', array(
	'model' => $model,
	'field' => 'referfacility',
	'label' => "To which ".str_plural($instance->facility_term)." do you most commonly refer?"
)) }}

{{ View::make('widget.singleSelect', array(
	'model' => $model,
	'field' => 'referhow',
	'label' => "How do you typically refer a patient to another ".$instance->facility_term."?",
	'options' => ["Patient provided with a referral slip","Contact prospective ".$instance->facility_term. " by phone","Other"]
)) }}


{{ View::make('widget.textArea', array(
	'model' => $model,
	'field' => 'referhowspec',
	'label' => 'Specify:',
	'secondary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'referto',
	'label' => "Are patients referred to your ".$instance->facility_term." from other health ".str_plural($instance->facility_term)."? Additional questions will appear if a 'yes' answer is given."
)) }}

{{ View::make('widget.singleSelect', array(
	'model' => $model,
	'field' => 'refertohow',
	'label' => "How are referrals to your ".str_plural($instance->facility_term)." typically done?",
	'options' => ["Patient provided with a referral slip","Contacted by ".$instance->facility_term. " by phone","Other"]
)) }}

{{ View::make('widget.textInput', array(
	'model' => $model,
	'field' => 'refertohowspec',
	'label' => 'Specify:',
	'secondary' => 'true'
)) }}
</div>