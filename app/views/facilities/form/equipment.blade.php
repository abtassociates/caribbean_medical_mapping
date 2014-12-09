
<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => 'Equipment',
	'text' => "For each item mentioned, please indicate if that piece of equipment or supply is present at the ".$instance->facility_term.", if it is in working order, and whether it is available in any public sector ".str_plural($instance->facility_term)." in the country.  Mark availability for all equipment listed.  Use the empty boxes at the bottom for any additional specialty equipment present."
)) }}

{{ View::make('widget.header', array(
	'label' => '(Lab Only) - Centrifuge:',
	'text' => '',
	'secondary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'eqherecent',
	'label' => 'Available Here?',
	'secondary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'eqfunccent',
	'label' => 'Functional Today?',
	'secondary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'eqpubcent',
	'label' => 'Available in the public sector?',
	'secondary' => 'true'
)) }}
</div>

<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => '(Lab Only) - Thermocyclers:',
	'text' => '',
	'secondary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'eqheretherm',
	'label' => 'Available Here?',
	'secondary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'eqfunctherm',
	'label' => 'Functional Today?',
	'secondary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'eqpubtherm',
	'label' => 'Available in the public sector?',
	'secondary' => 'true'
)) }}
</div>

<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => '(Lab Only) - Stabilizers:',
	'text' => '',
	'secondary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'eqherestab',
	'label' => 'Available Here?',
	'secondary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'eqfuncstab',
	'label' => 'Functional Today?',
	'secondary' => 'true'

)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'eqpubstab',
	'label' => 'Available in the public sector?',
	'secondary' => 'true'
)) }}
</div>

<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => '(Lab Only) - Temperature control refrigerators:',
	'text' => '',
	'secondary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'eqheretemp',
	'label' => 'Available Here?',
	'secondary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'eqfunctemp',
	'label' => 'Functional Today?',
	'secondary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'eqpubtemp',
	'label' => 'Available in the public sector?',
	'secondary' => 'true'
)) }}
</div>

<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => '(Lab Only) - Dead box:',
	'text' => '',
	'secondary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'eqheredead',
	'label' => 'Available Here?',
	'secondary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'eqfuncdead',
	'label' => 'Functional Today?',
	'secondary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'eqpubdead',
	'label' => 'Available in the public sector?',
	'secondary' => 'true'
)) }}
</div>

<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => 'X-ray machine (film):',
	'text' => '',
	'secondary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'eqherexfilm',
	'label' => 'Available Here?',
	'secondary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'eqfuncxfilm',
	'label' => 'Functional Today?',
	'secondary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'eqpubxfilm',
	'label' => 'Available in the public sector?',
	'secondary' => 'true'
)) }}
</div>

<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => 'X-ray machine (digital):',
	'text' => '',
	'secondary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'eqherexdig',
	'label' => 'Available Here?',
	'secondary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'eqfuncxdig',
	'label' => 'Functional Today?',
	'secondary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'eqpubxdig',
	'label' => 'Available in the public sector?',
	'secondary' => 'true'
)) }}
</div>

<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => 'CT scan:',
	'text' => '',
	'secondary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'eqherect',
	'label' => 'Available Here?',
	'secondary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'eqfuncct',
	'label' => 'Functional Today?',
	'secondary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'eqpubct',
	'label' => 'Available in the public sector?',
	'secondary' => 'true'
)) }}
</div>

<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => 'MRI:',
	'text' => '',
	'secondary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'eqheremri',
	'label' => 'Available Here?',
	'secondary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'eqfuncmri',
	'label' => 'Functional Today?',
	'secondary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'eqpubmri',
	'label' => 'Available in the public sector?',
	'secondary' => 'true'
)) }}
</div>

<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => 'ECG machine:',
	'text' => '',
	'secondary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'eqhereecg',
	'label' => 'Available Here?',
	'secondary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'eqfuncecg',
	'label' => 'Functional Today?',
	'secondary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'eqpubecg',
	'label' => 'Available in the public sector?',
	'secondary' => 'true'
)) }}
</div>

<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => 'Automated External Defibrillator (AED):',
	'text' => '',
	'secondary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'eqhereaed',
	'label' => 'Available Here?',
	'secondary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'eqfuncaed',
	'label' => 'Functional Today?',
	'secondary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'eqpubaed',
	'label' => 'Available in the public sector?',
	'secondary' => 'true'
)) }}
</div>

<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => 'Defribrillator:',
	'text' => '',
	'secondary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'eqheredef',
	'label' => 'Available Here?',
	'secondary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'eqfuncdef',
	'label' => 'Functional Today?',
	'secondary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'eqpubdef',
	'label' => 'Available in the public sector?',
	'secondary' => 'true'
)) }}
</div>

<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => 'Ultrasound:',
	'text' => '',
	'secondary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'eqhereult',
	'label' => 'Available Here?',
	'secondary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'eqfuncult',
	'label' => 'Functional Today?',
	'secondary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'eqpubult',
	'label' => 'Available in the public sector?',
	'secondary' => 'true'
)) }}
</div>

<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => 'Dialysis machine:',
	'text' => '',
	'secondary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'eqheredia',
	'label' => 'Available Here?',
	'secondary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'eqfuncdia',
	'label' => 'Functional Today?',
	'secondary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'eqpubdia',
	'label' => 'Available in the public sector?',
	'secondary' => 'true'
)) }}
</div>

<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => 'CD4 machine:',
	'text' => '',
	'secondary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'eqherecd4',
	'label' => 'Available Here?',
	'secondary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'eqfunccd4',
	'label' => 'Functional Today?',
	'secondary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'eqpubcd4',
	'label' => 'Available in the public sector?',
	'secondary' => 'true'
)) }}
</div>

<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => 'PCR viral load machine:',
	'text' => '',
	'secondary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'eqherepcr',
	'label' => 'Available Here?',
	'secondary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'eqfuncpcr',
	'label' => 'Functional Today?',
	'secondary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'eqpubpcr',
	'label' => 'Available in the public sector?',
	'secondary' => 'true'
)) }}
</div>

<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => 'Anesthesia equipment:',
	'text' => '',
	'secondary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'eqhereanes',
	'label' => 'Available Here?',
	'secondary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'eqfuncanes',
	'label' => 'Functional Today?',
	'secondary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'eqpubanes',
	'label' => 'Available in the public sector?',
	'secondary' => 'true'
)) }}
</div>

<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => 'Hematology analyzer:',
	'text' => '',
	'secondary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'eqherehema',
	'label' => 'Available Here?',
	'secondary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'eqfunchema',
	'label' => 'Functional Today?',
	'secondary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'eqpubhema',
	'label' => 'Available in the public sector?',
	'secondary' => 'true'
)) }}
</div>

<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => 'HIV rapid tests:',
	'text' => '',
	'secondary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'eqhererapid',
	'label' => 'Available Here?',
	'secondary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'eqfuncrapid',
	'label' => 'Functional Today?',
	'secondary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'eqpubrapid',
	'label' => 'Available in the public sector?',
	'secondary' => 'true'
)) }}
</div>

<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => 'Urinalysis test strips:',
	'text' => '',
	'secondary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'eqhereuri',
	'label' => 'Available Here?',
	'secondary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'eqfuncuri',
	'label' => 'Functional Today?',
	'secondary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'eqpuburi',
	'label' => 'Available in the public sector?',
	'secondary' => 'true'
)) }}
</div>

<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => 'Glucose strips:',
	'text' => '',
	'secondary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'eqhereglu',
	'label' => 'Available Here?',
	'secondary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'eqfuncglu',
	'label' => 'Functional Today?',
	'secondary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'eqpubglu',
	'label' => 'Available in the public sector?',
	'secondary' => 'true'
)) }}
</div>
<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => 'Computer / Internet',
	'text' => '',
	'id' => 'equipmentComputerHeader'
)) }}

{{ View::make('widget.singleSelect', array(
	'model' => $model,
	'field' => 'facinternet',
	'label' => "D.4 Does the ".$instance->facility_term." have an internet connection?",
	'options' => ["Yes, and it works regularly","Yes, but it is unreliable and has frequent connectivity issues","No, but reliable internet access is within walking distance","No, and internet access is not easily obtained"]
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'faccomp',
	'label' => "Does the ".$instance->facility_term." have a functioning computer or do you have access to a computer elsewhere?  Additional questions will appear if a 'yes' answer is given:"
)) }}

{{ View::make('widget.header', array(
	'label' => 'What role does the computer play in your business?',
	'text' => 'Please select all that apply from the following.',
	'id' => 'D6FacCompHeader',
	'secondary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'faccompbill',
	'label' => 'Billing:',
	'secondary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'faccompemr',
	'label' => 'Electronic medical records:',
	'secondary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'faccompregist',
	'label' => 'General patient registry data:',
	'secondary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'faccompresearch',
	'label' => 'Research on patient conditions and treatments:',
	'secondary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'faccompother',
	'label' => 'Other:',
	'secondary' => 'true'
)) }}

{{ View::make('widget.textInput', array(
	'model' => $model,
	'field' => 'faccompotherspec',
	'label' => 'Specify:',
	'tertiary' => 'true'
)) }}
</div>