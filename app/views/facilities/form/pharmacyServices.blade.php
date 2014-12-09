
<div class="group-wrapper">

{{ View::make('widget.header', array(
	'label' => 'Prescription Drugs',
	'text' => '',
	'secondary' => 'true',
	'id' => "prescription_drugs"
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'prescription',
	'label' => "Does the ".$instance->facility_term." keep a stock of prescription drugs? Additional questions will appear if a 'yes' answer is given."
)) }}

{{ View::make('widget.numberInput', array(
	'model' => $model,
	'field' => 'prescriptionvisits',
	'label' => "In an average week, how many client visits are there to fill prescriptions at this ".$instance->facility_term."?"
)) }}

{{ View::make('widget.header', array(
	'label' => 'Availability of Medicines',
	'text' => "For each item listed, please indicate if that drug is typically available at the ".$instance->facility_term.", and if the ".$instance->facility_term." has experienced any stockouts of it in the last 6 months.",
	'id' => 'G10PharmacyList'
)) }}
</div>

<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => 'Amoxicillin',
	'text' => '',
	'secondary' => 'true',
	'id' => "G10aAmoxicillin"
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'availamox',
	'label' => "Typically available here? Additional questions will appear if a 'yes' answer is given.",
	'tertiary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'stockamox',
	'label' => 'Stockout in the last 6 months?',
	'tertiary' => 'true'
)) }}
</div>

<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => 'Metronidazole',
	'text' => '',
	'secondary' => 'true',
	'id' => 'G10bMetronidazole'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'availmetro',
	'label' => "Typically available here? Additional questions will appear if a 'yes' answer is given.",
	'tertiary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'stockmetro',
	'label' => 'Stockout in the last 6 months?',
	'tertiary' => 'true'
)) }}
</div>

<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => 'Salbutamol inhaler',
	'text' => '',
	'secondary' => 'true',
	'id' => 'G10cSalbutamol'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'availsalbu',
	'label' => "Typically available here? Additional questions will appear if a 'yes' answer is given.",
	'tertiary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'stocksalbu',
	'label' => 'Stockout in the last 6 months?',
	'tertiary' => 'true'
)) }}
</div>

<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => 'Glibenclamide',
	'text' => '',
	'secondary' => 'true',
	'id' => 'G10dGlibenclamide'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'availgilb',
	'label' => "Typically available here? Additional questions will appear if a 'yes' answer is given.",
	'tertiary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'stockgilb',
	'label' => 'Stockout in the last 6 months?',
	'tertiary' => 'true'
)) }}
</div>

<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => 'Atenolol',
	'text' => '',
	'secondary' => 'true',
	'id' => 'G10eAtenolol'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'availateno',
	'label' => "Typically available here? Additional questions will appear if a 'yes' answer is given.",
	'tertiary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'stockateno',
	'label' => 'Stockout in the last 6 months?',
	'tertiary' => 'true'
)) }}
</div>

<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => 'Simvastatin',
	'text' => '',
	'secondary' => 'true',
	'id' => 'G10fSimvastatin'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'availsimva',
	'label' => "Typically available here? Additional questions will appear if a 'yes' answer is given.",
	'tertiary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'stocksimva',
	'label' => 'Stockout in the last 6 months?',
	'tertiary' => 'true'
)) }}
</div>

<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => 'Captopril',
	'text' => '',
	'secondary' => 'true',
	'id' => 'G10gCaptopril'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'availcap',
	'label' => "Typically available here? Additional questions will appear if a 'yes' answer is given.",
	'tertiary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'stockcap',
	'label' => 'Stockout in the last 6 months?',
	'tertiary' => 'true'
)) }}
</div>

<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => 'Omeprazole',
	'text' => '',
	'secondary' => 'true',
	'id' => 'G10hOmeprazole'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'availome',
	'label' => "Typically available here? Additional questions will appear if a 'yes' answer is given.",
	'tertiary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'stockome',
	'label' => 'Stockout in the last 6 months?',
	'tertiary' => 'true'
)) }}
</div>

<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => 'Diclofenac',
	'text' => '',
	'secondary' => 'true',
	'id' => 'G10iDiclofenac'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'availdic',
	'label' => "Typically available here? Additional questions will appear if a 'yes' answer is given.",
	'tertiary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'stockdic',
	'label' => 'Stockout in the last 6 months?',
	'tertiary' => 'true'
)) }}
</div>

<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => 'Paracetamol',
	'text' => '',
	'secondary' => 'true',
	'id' => 'G10jParacetamol'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'availpara',
	'label' => "Typically available here? Additional questions will appear if a 'yes' answer is given.",
	'tertiary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'stockpara',
	'label' => 'Stockout in the last 6 months?',
	'tertiary' => 'true'
)) }}
</div>

<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => 'Cotrimoxazole',
	'text' => '',
	'secondary' => 'true',
	'id' => 'G10kCotrimoxazole'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'availcotri',
	'label' => "Typically available here? Additional questions will appear if a 'yes' answer is given.",
	'tertiary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'stockcotri',
	'label' => 'Stockout in the last 6 months?',
	'tertiary' => 'true'
)) }}
</div>

<div class="group-wrapper">

{{ View::make('widget.header', array(
	'label' => 'Penicillin',
	'text' => '',
	'secondary' => 'true',
	'id' => 'G10lPenicillin'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'availpeni',
	'label' => "Typically available here? Additional questions will appear if a 'yes' answer is given.",
	'tertiary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'stockpeni',
	'label' => 'Stockout in the last 6 months?',
	'tertiary' => 'true'
)) }}
</div>

<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => 'Ciproflaxin',
	'text' => '',
	'secondary' => 'true',
	'id' => 'G10mCiproflaxin'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'availcipro',
	'label' => "Typically available here? Additional questions will appear if a 'yes' answer is given.",
	'tertiary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'stockcipro',
	'label' => 'Stockout in the last 6 months?',
	'tertiary' => 'true'
)) }}
</div>

<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => 'Anti-Retroviral Drugs',
	'text' => '',
	'secondary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'arv',
	'label' => "Does this ".$instance->facility_term." keep a stock of antiretroviral drugs? Additional questions will appear if a 'yes' answer is given."
)) }}
</div>

<div class="group-wrapper">

{{ View::make('widget.header', array(
	'label' => "For each item listed, please indicate if that drug is typically available here at the ".$instance->facility_term.", and if the ".$instance->facility_term." has experienced any stockouts of it in the last 6 months.",
	'text' => 'Mark availability for all drugs listed.',
	'id' => 'G12ARVList'
)) }}

{{ View::make('widget.header', array(
	'label' => 'AZT (Zidovudine)',
	'text' => '',
	'secondary' => 'true',
	'id' => 'G12aAZT'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'availazt',
	'label' => "Typically available here? Additional questions will appear if a 'yes' answer is given.",
	'tertiary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'stockazt',
	'label' => 'Stockout in the last 6 months?',
	'tertiary' => 'true'
)) }}
</div>

<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => '3TC (Lamivudine)',
	'text' => '',
	'secondary' => 'true',
	'id' => 'G12b3TC'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'avail3tc',
	'label' => "Typically available here? Additional questions will appear if a 'yes' answer is given.",
	'tertiary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'stock3tc',
	'label' => 'Stockout in the last 6 months?',
	'tertiary' => 'true'
)) }}
</div>

<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => 'TDF (Tenofovir)',
	'text' => '',
	'secondary' => 'true',
	'id' => 'G12cTDF'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'availtdf',
	'label' => "Typically available here? Additional questions will appear if a 'yes' answer is given.",
	'tertiary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'stocktdf',
	'label' => 'Stockout in the last 6 months?',
	'tertiary' => 'true'
)) }}
</div>

<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => 'FTC (Lamivudine)',
	'text' => '',
	'secondary' => 'true',
	'id' => 'G12dFTC'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'availftc',
	'label' => "Typically available here? Additional questions will appear if a 'yes' answer is given.",
	'tertiary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'stockftc',
	'label' => 'Stockout in the last 6 months?',
	'tertiary' => 'true'
)) }}
</div>

<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => 'EFV (Efavirenz)',
	'text' => '',
	'secondary' => 'true',
	'id' => 'G12eEFV'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'availefv',
	'label' => "Typically available here? Additional questions will appear if a 'yes' answer is given.",
	'tertiary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'stockefv',
	'label' => 'Stockout in the last 6 months?',
	'tertiary' => 'true'
)) }}
</div>

<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => 'ATV/r (Atazanavir sulfate)',
	'text' => '',
	'secondary' => 'true',
	'id' => 'G12fATVr'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'availatv',
	'label' => "Typically available here? Additional questions will appear if a 'yes' answer is given.",
	'tertiary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'stockatv',
	'label' => 'Stockout in the last 6 months?',
	'tertiary' => 'true'
)) }}
</div>

<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => 'LPV/r (Kaletra: lopinavir/ritonavir)',
	'text' => '',
	'secondary' => 'true',
	'id' => 'G12gLPVr'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'availlpv',
	'label' => "Typically available here? Additional questions will appear if a 'yes' answer is given.",
	'tertiary' => 'true'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'stocklpv',
	'label' => 'Stockout in the last 6 months?',
	'tertiary' => 'true'
)) }}
</div>

<div class="group-wrapper">
{{ View::make('widget.header', array(
	'label' => 'Stockout of ARVs',
	'text' => '',
	'secondary' => 'true',
	'id' => 'pharmacyARVstockout'
)) }}

{{ View::make('widget.yesNoSelect', array(
	'model' => $model,
	'field' => 'fill',
	'label' => "For any of the aforementioned antiretroviral drugs, have clients ever been referred here to fill prescriptions due to a stockout in the public sector?  Additional questions will appear if a 'yes' answer is given."
)) }}

{{ View::make('widget.textArea', array(
	'model' => $model,
	'field' => 'fillspecify',
	'label' => 'Please specify which drugs.'
)) }}
</div>
