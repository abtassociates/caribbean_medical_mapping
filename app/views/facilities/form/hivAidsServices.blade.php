<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => 'HCT Training',
	'text' => ''
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'hcttrain',
	'label' => "Have you or anyone else on your staff received training in HIV counseling and testing? Additional questions will appear if a 'yes' answer is given."
)) }}

{{ View::make('widget.singleSelect', array(
	'model' => $model,
	'field' => 'hcttraintime',
	'label' => 'How recent was the counseling and testing training?',
	'options' => ["In the last 6 months","In the last year","More than a year ago"]
)) }}
</div>

<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => '[Dentists Only]  Have you observed any of the following signs or symptoms, which are commonly associated with HIV, in your patients?',
	'text' => '',
	'id' => 'F3aDentistHivSymptoms'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'dentsignthrush',
	'label' => 'Candidiasis (thrush)'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'dentsignhairy',
	'label' => 'Hairy leukoplakia'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'dentsignulcer',
	'label' => 'Ulcerative gingivitis'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'dentsignperio',
	'label' => 'Progressive periodontis'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'dentsignkaposi',
	'label' => 'Kaposi sarcoma'
)) }}
</div>

<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => '[Dentists Only]  Upon detecting any of these signs or symptoms, what action/s have you taken?',
	'text' => 'Select all that apply from the following:',
	'id' => 'F3aDentistHivActions'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'actionsample',
	'label' => 'Collect sample'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'actiontreat',
	'label' => 'Prescribe treatment'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'actionrefer',
	'label' => 'Refer patient for HIV counseling/test'
)) }}

{{ View::make('widget.textInput', array(
	'model' => $model,
	'field' => 'actionreferwhere',
	'label' => 'Refer to where?',
	'secondary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'actionother',
	'label' => 'Other'
)) }}

{{ View::make('widget.textInput', array(
	'model' => $model,
	'field' => 'actionotherspec',
	'label' => 'Specify:',
	'secondary' => 'true'
)) }}
</div>

<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => 'HIV Counseling',
	'text' => ''
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'hc',
	'label' => "Does this ".$instance->facility_term." provide HIV counseling services? Additional questions will appear if a 'yes' answer is given."
)) }}

{{ View::make('widget.numberInput', array(
	'model' => $model,
	'field' => 'hcclients',
	'label' => "In an average week, how many clients receive HIV counseling at the ".$instance->facility_term."?"
)) }}
</div>

<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => 'HIV Testing',
	'text' => ''
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'testing',
	'label' => "Does your ".$instance->facility_term." provide HIV testing services, either by taking blood or analyzing samples? Additional questions will appear if a 'yes' answer is given."
)) }}

{{ View::make('widget.numberInput', array(
	'model' => $model,
	'field' => 'hivtestvisits',
	'label' => "In an average week, how many HIV testing-related visits are there at the ".$instance->facility_term."?"
)) }}
</div>

<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => "Are any of the following administered at this ".$instance->facility_term."?",
	'text' => '',
	'id' => 'F8TestsAdminstered'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'rapidtest',
	'label' => 'Rapid Test',
	'secondary' => 'true'
)) }}

{{ View::make('widget.textInput', array(
	'model' => $model,
	'field' => 'rapidtestspec',
	'label' => 'Specify:',
	'tertiary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'westernblot',
	'label' => 'Western Blot',
	'secondary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'elisa',
	'label' => 'ELISA',
	'secondary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'blooddraw',
	'label' => "Blood draw taken and sent to other ".$instance->facility_term." for analysis",
	'secondary' => 'true'
)) }}
</div>

<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => "For ".str_plural($instance->facility_term)." who do not provide counseling or testing",
	'text' => '',
	'id' => 'hivNoHCT'
)) }}

{{ View::make('widget.singleSelect', array(
	'model' => $model,
	'field' => 'hivrefer',
	'label' => 'Where do you refer clients for HIV counseling and testing?',
	'options' => ["National HIV/AIDS Response Program","Planned Parenthood","Red Cross","CHAA","Other"],
	'secondary' => 'true'
)) }}

{{ View::make('widget.textInput', array(
	'model' => $model,
	'field' => 'hivreferspec',
	'label' => 'Specify:',
	'tertiary' => 'true'
)) }}
</div>

<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => 'HIV Treatment',
	'text' => ''
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'hivtreat',
	'label' => "Does your ".$instance->facility_term." provide HIV treatment services?"
)) }}

{{ View::make('widget.numberInput', array(
	'model' => $model,
	'field' => 'hivtreatvisits',
	'label' => "In an average week, how many HIV treatment visits are there at the ".$instance->facility_term."?"
)) }}
</div>

<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => 'PMTCT',
	'text' => ''
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'pmtct',
	'label' => "Does your ".$instance->facility_term." provide PMTCT (prevention of mother to child transmission) services to pregnant women?  This refers to antiretroviral treatment provided to a mother with HIV."
)) }}
</div>

<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => 'Testing for Opportunistic Infections',
	'text' => ''
)) }}

{{ View::make('widget.header', array(
	'label' => 'Candidiasis',
	'text' => '',
	'secondary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'candidavail',
	'label' => 'Available Here?',
	'tertiary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'candidtest',
	'label' => 'Conduct Test?',
	'tertiary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'candidsample',
	'label' => 'Collect Sample?',
	'tertiary' => 'true'
)) }}
</div>

<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => 'Cytomegalovirus',
	'text' => '',
	'secondary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'cytoavail',
	'label' => 'Available Here?',
	'tertiary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'cytotest',
	'label' => 'Conduct Test?',
	'tertiary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'cytosample',
	'label' => 'Collect Sample?',
	'tertiary' => 'true'
)) }}
</div>

<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => 'Herpes simplex viruses',
	'text' => '',
	'secondary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'herpesavail',
	'label' => 'Available Here?',
	'tertiary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'herpestest',
	'label' => 'Conduct Test?',
	'tertiary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'herpessample',
	'label' => 'Collect Sample?',
	'tertiary' => 'true'
)) }}
</div>

<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => 'Mycobacterium avium complex',
	'text' => '',
	'secondary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'mycoavail',
	'label' => 'Available Here?',
	'tertiary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'mycotest',
	'label' => 'Conduct Test?',
	'tertiary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'mycosample',
	'label' => 'Collect Sample?',
	'tertiary' => 'true'
)) }}
</div>

<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => 'Pneumocystis pneumonia',
	'text' => '',
	'secondary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'pneumoavail',
	'label' => 'Available Here?',
	'tertiary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'pneumotest',
	'label' => 'Conduct Test?',
	'tertiary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'pneumosample',
	'label' => 'Collect Sample?',
	'tertiary' => 'true'
)) }}
</div>

<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => 'Toxoplasmosis',
	'text' => '',
	'secondary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'toxavail',
	'label' => 'Available Here?',
	'tertiary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'toxtest',
	'label' => 'Conduct Test?',
	'tertiary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'toxsample',
	'label' => 'Collect Sample?',
	'tertiary' => 'true'
)) }}
</div>

<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => 'Tuberculosis',
	'text' => '',
	'secondary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'tuberavail',
	'label' => 'Available Here?',
	'tertiary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'tubertest',
	'label' => 'Conduct Test?',
	'tertiary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'tubersample',
	'label' => 'Collect Sample?',
	'tertiary' => 'true'
)) }}
</div>

<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => 'Treatment for Opportunistic Infections',
	'text' => ''
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'oitreat',
	'label' => "Does your ".$instance->facility_term." provide treatment services for any of the aforementioned infections? Additional questions will appear if a 'yes' answer is given."
)) }}

{{ View::make('widget.numberInput', array(
	'model' => $model,
	'field' => 'oitreatvisits',
	'label' => "In an average week, how many visits are there at the ".$instance->facility_term." by clients seeking treatment for these infections?"
)) }}
</div>

