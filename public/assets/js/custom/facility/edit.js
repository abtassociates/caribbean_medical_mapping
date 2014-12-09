$(document).ready(function(){

	$('input.number').keypress(function(e) {
        var verified = (e.which == 8 || e.which == undefined || e.which == 0) ? null : String.fromCharCode(e.which).match(/[^0-9]/);
        if (verified) {e.preventDefault();}
	});

	$('#facility-form').on('submit', function(e){

		var errors = getErrors();

		if(errors.length){
			e.preventDefault();
			alert(errors.join("\n"));
		}
	});


	function getErrors(){
		var errors = [];
		if(error = sectorError()){errors.push(error);}
		if(error = facilityTypeError()){errors.push(error);}
		return errors;
	}


	function sectorError(){
		$sector_input = edit_helper.getInputByTableAndField('Clinic', 'sector_id');
		if(!$sector_input.val()){
			return "You must select a sector in the \"General\" tab.";
		}
	}

	function facilityTypeError(){
		$type_input = edit_helper.getInputByTableAndField('FacilityInformation', 'facilitytype');
		if(!$type_input.val()){
			return "You must select a "+facility_term+" type in the \""+facility_term_capitalized+" Information\" tab.";
		}
	}

	// ----------------------------------- //
	//        general                      //
	// ----------------------------------- //

	var $specialty_input = edit_helper.getInputByTableAndField('Clinic', 'specialty');

	$specialty_input.autocomplete({
      source: specialties
    });

	// ----------------------------------- //
	//        proprietor information       //
	// ----------------------------------- //

	// get ahold of some nodes (use vanilla javascript inside to get around jQuery's special handling 
	// of square brackets in selectors)
	var $jobCatSpecInput 	= $(document.getElementById("subtable[ProprietorInformation][jobcatspec]"));
	var $jobCatOtherInput = $(document.getElementById("subtable[ProprietorInformation][jobcatother]"));
	var $ProfessionalAssocInput = $(document.getElementById("subtable[ProprietorInformation][professionalassoc]"));
	var $AssocInput = $(document.getElementById("subtable[ProprietorInformation][assoc]"));
// Assoc
	// define the needed behavior
	var updateJobCatSpecs = function(valJC){
		$jobCatSpecInput.closest(".form-group").hide();
		$jobCatOtherInput.closest(".form-group").hide();

		//var val = $jobCatInput.val(); - MOVED TO GLOBAL
		if(valJC === "Physician - specialist"){$jobCatSpecInput.closest(".form-group").show();}
		if(valJC === "Other"){$jobCatOtherInput.closest(".form-group").show();}
	}

	// attach our behavior to the "change" event of relevant node
	//$jobCatInput.change(updateJobCatSpecs);

	var updateProfessionalAssoc = function(){	
		var val = $ProfessionalAssocInput.val();
		if(val === "1"){$AssocInput.closest(".form-group").show();} else{$AssocInput.closest(".form-group").hide();}
	}

	// attach our behavior to the "change" event of relevant node
	$ProfessionalAssocInput.change(updateProfessionalAssoc);

	updateProfessionalAssoc();

	edit_helper.setVisibilityRule('ProprietorInformation', 'hcppublicpast', ['hcppubliccurrent'], 0, '1');

	edit_helper.setVisibilityMultiRule(
		'ProprietorInformation',
		['publichours'],
		0,
		[
			{masterField: 'hcppublicpast', matchValues: ['1']},
			{masterField: 'hcppubliccurrent', matchValues: ['1']}
		]
	);


	// ----------------------------------- //
	//        facility information         //
	// ----------------------------------- //

	// get ahold of some nodes (use vanilla javascript inside to get around jQuery's special handling 
	// of square brackets in selectors)
	var $FacilityTypeInput 			= $(document.getElementById("subtable[FacilityInformation][facilitytype]"));
	var $FacilityTypeSpecInput 	= $(document.getElementById("subtable[FacilityInformation][facilitytypespec]"));

// define the needed behavior
	var updateFacilityTypeSpecs = function(){
		var val = $FacilityTypeInput.val();
		if(val === "Other"){$FacilityTypeSpecInput.closest(".form-group").show();} else {$FacilityTypeSpecInput.closest(".form-group").hide();}
	}

	$FacilityTypeInput.change(updateFacilityTypeSpecs);
	updateFacilityTypeSpecs();

	// only show the time entry options for a given day if the facility is not set to closed that day
	$(['mon', 'tue', 'wed', 'thur', 'fri', 'sat', 'sun']).each(function(index, day){
		edit_helper.setVisibilityRule('FacilityInformation', day, [day+'open', day+'close'], 1, ['Closed', '']);
	});


	// ----------------------------------- //
	//        staffing and equipment       //
	// ----------------------------------- //


	// get ahold of some nodes (use vanilla javascript inside to get around jQuery's special handling 
	// of square brackets in selectors)
	var $FacCompOtherInput 			= $(document.getElementById("subtable[StaffingAndEquipment][faccompother]"));
	var $FacCompOtherSpecInput 	= $(document.getElementById("subtable[StaffingAndEquipment][faccompotherspec]"));
	var $FacCompInput 	= $(document.getElementById("subtable[StaffingAndEquipment][faccomp]"));
	var $FacCompBillInput 	= $(document.getElementById("subtable[StaffingAndEquipment][faccompbill]"));
	var $FacCompEmrInput 	= $(document.getElementById("subtable[StaffingAndEquipment][faccompemr]"));
	var $FacCompRegistInput 	= $(document.getElementById("subtable[StaffingAndEquipment][faccompregist]"));
	var $FacCompResearchInput 	= $(document.getElementById("subtable[StaffingAndEquipment][faccompresearch]"));
	var $D6FacCompHeader 	= $(document.getElementById("D6FacCompHeader"));

	// define the needed behavior
	var updateFacComp = function(){
		$D6FacCompHeader.closest(".form-group").hide();
		$FacCompBillInput.closest(".form-group").hide();
		$FacCompEmrInput.closest(".form-group").hide();
		$FacCompRegistInput.closest(".form-group").hide();
		$FacCompResearchInput.closest(".form-group").hide();
		$FacCompResearchInput.closest(".form-group").hide();
		$FacCompOtherInput.closest(".form-group").hide();
		$FacCompOtherSpecInput.closest(".form-group").hide();

		var val = $FacCompInput.val();
		var val2 = $FacCompOtherInput.val();
		
		if(val === "1"){
			$D6FacCompHeader.closest(".form-group").show();
			$FacCompBillInput.closest(".form-group").show();
			$FacCompEmrInput.closest(".form-group").show();
			$FacCompRegistInput.closest(".form-group").show();
			$FacCompResearchInput.closest(".form-group").show();
			$FacCompResearchInput.closest(".form-group").show();
			$FacCompOtherInput.closest(".form-group").show();
			updateFacCompOtherSpec();
		}
	}

	$FacCompInput.change(updateFacComp);

	// define the needed behavior
	var updateFacCompOtherSpec = function(){
		var val = $FacCompOtherInput.val();
		if(val === "1"){
			$FacCompOtherSpecInput.closest(".form-group").show();} else {$FacCompOtherSpecInput.closest(".form-group").hide();}
	}

	$FacCompOtherInput.change(updateFacCompOtherSpec);
	updateFacComp();

	var equip_abbrev_array = [
		'cent',
		'therm',
		'stab',
		'temp',
		'dead',
		'xfilm',
		'xdig',
		'ct',
		'mri',
		'ecg',
		'aed',
		'def',
		'ult',
		'dia',
		'cd4',
		'pcr',
		'anes',
		'hema',
		'rapid',
		'uri',
		'glu'
	];

	$.each(equip_abbrev_array, function(index, abbrev){
		edit_helper.setVisibilityRule(
			'StaffingAndEquipment',
			'eqhere'+abbrev,
			'eqfunc'+abbrev,
			0,
			"1"
		);
	});


	// ----------------------------------- //
	//  service availability & Utilization //
	// ----------------------------------- //

edit_helper.setVisibilityRule('ServiceAvailabilityAndUtilization', 'inpatient', 'inpatientadmin', 0, '1');

	var $E4qHIVTargetHeader 	= $(document.getElementById("E4qHIVTargetHeader"));
	var $HivOutInput 			= $(document.getElementById("subtable[ServiceAvailabilityAndUtilization][hivout]"));
	var $HivOutCswInput 			= $(document.getElementById("subtable[ServiceAvailabilityAndUtilization][hivoutcsw]"));
	var $HivOutMsmInput 			= $(document.getElementById("subtable[ServiceAvailabilityAndUtilization][hivoutmsm]"));
	var $HivOutYouthInput 			= $(document.getElementById("subtable[ServiceAvailabilityAndUtilization][hivoutyouth]"));
	var $HivOutPrisonersInput 			= $(document.getElementById("subtable[ServiceAvailabilityAndUtilization][hivoutprisoners]"));
	var $HivOutOtherInput 			= $(document.getElementById("subtable[ServiceAvailabilityAndUtilization][hivoutother]"));

	var updateHivOutreachFields = function(){
		$E4qHIVTargetHeader.closest(".group-wrapper").hide();
		$HivOutCswInput.closest(".form-group").hide();
		$HivOutMsmInput.closest(".form-group").hide();
		$HivOutYouthInput.closest(".form-group").hide();
		$HivOutPrisonersInput.closest(".form-group").hide();
		$HivOutOtherInput.closest(".form-group").hide();

		var val = $HivOutInput.val();
		
		if(val === "1"){
			$E4qHIVTargetHeader.closest(".group-wrapper").show();
			$HivOutCswInput.closest(".form-group").show();
			$HivOutMsmInput.closest(".form-group").show();
			$HivOutYouthInput.closest(".form-group").show();
			$HivOutPrisonersInput.closest(".form-group").show();
			$HivOutOtherInput.closest(".form-group").show();
		}
	}

	$HivOutInput.change(updateHivOutreachFields);

	// define the needed behavior
	var $SpecialtyInput 			= $(document.getElementById("subtable[ServiceAvailabilityAndUtilization][specialty]"));
	var $SpecialtySpecInput 	= $(document.getElementById("subtable[ServiceAvailabilityAndUtilization][specialtyspec]"));

	var updateSpecialtySpec = function(){
		var val = $SpecialtyInput.val();
		if(val === "1"){$SpecialtySpecInput.closest(".form-group").show();} else {$SpecialtySpecInput.closest(".form-group").hide();}
	}

	$SpecialtyInput.change(updateSpecialtySpec);

	// define the needed behavior
	var $SpecialtyVisitInput 			= $(document.getElementById("subtable[ServiceAvailabilityAndUtilization][specialtyvisit]"));
	var $SpecialtyVisitSpecInput 	= $(document.getElementById("subtable[ServiceAvailabilityAndUtilization][specialtyvisitspec]"));

	var updateSpecialtyVisitSpec = function(){
		var val = $SpecialtyVisitInput.val();
		if(val === "1"){$SpecialtyVisitSpecInput.closest(".form-group").show();} else {$SpecialtyVisitSpecInput.closest(".form-group").hide();}
	}

	$SpecialtyVisitInput.change(updateSpecialtyVisitSpec);

	// define the needed behavior
	var $RequestInput 			= $(document.getElementById("subtable[ServiceAvailabilityAndUtilization][request]"));
	var $RequestSpecInput 	= $(document.getElementById("subtable[ServiceAvailabilityAndUtilization][requestspec]"));

	var updateRequestSpec = function(){
		var val = $RequestInput.val();
		if(val === "1"){$RequestSpecInput.closest(".form-group").show();} else {$RequestSpecInput.closest(".form-group").hide();}
	}

	$RequestInput.change(updateRequestSpec);

	// define the needed behavior
	var $ReferInput 			= $(document.getElementById("subtable[ServiceAvailabilityAndUtilization][refer]"));
	var $ReferFacilityInput 	= $(document.getElementById("subtable[ServiceAvailabilityAndUtilization][referfacility]"));
	var $ReferHowInput 			= $(document.getElementById("subtable[ServiceAvailabilityAndUtilization][referhow]"));
	var $ReferHowSpecInput 	= $(document.getElementById("subtable[ServiceAvailabilityAndUtilization][referhowspec]"));

	var updateReferFields = function(){
		$ReferFacilityInput.closest(".form-group").hide();
		$ReferHowInput.closest(".form-group").hide();
		$ReferHowSpecInput.closest(".form-group").hide();

		var val = $ReferInput.val();
		var val2 = $ReferHowInput.val();

		if(val === "1"){
			$ReferFacilityInput.closest(".form-group").show();
			$ReferHowInput.closest(".form-group").show();
			$ReferFacilityInput.closest(".form-group").show();
			updateReferHowSpec();
		}
	}

	$ReferInput.change(updateReferFields);

	// define the needed behavior

	var updateReferHowSpec = function(){
		var val = $ReferHowInput.val();
			if(val === "Other"){$ReferHowSpecInput.closest(".form-group").show();} else {$ReferHowSpecInput.closest(".form-group").hide();}
	}

	$ReferHowInput.change(updateReferHowSpec);

	// define the needed behavior
	var $ReferToInput 			= $(document.getElementById("subtable[ServiceAvailabilityAndUtilization][referto]"));
	var $ReferToHowInput 			= $(document.getElementById("subtable[ServiceAvailabilityAndUtilization][refertohow]"));
	var $ReferToHowSpecInput 	= $(document.getElementById("subtable[ServiceAvailabilityAndUtilization][refertohowspec]"));

	var updateReferToFields = function(){
		$ReferToHowInput.closest(".form-group").hide();
		$ReferToHowSpecInput.closest(".form-group").hide();

		var val = $ReferToInput.val();
		if(val === "1"){
			$ReferToHowInput.closest(".form-group").show();
			updateReferToHowSpec();
		}
	}

	$ReferToInput.change(updateReferToFields);

	var updateReferToHowSpec = function(){
		var val = $ReferToHowInput.val();
		if(val === "Other"){$ReferToHowSpecInput.closest(".form-group").show();} else {$ReferToHowSpecInput.closest(".form-group").hide();}
	}

	$ReferToHowInput.change(updateReferToHowSpec);

//RAM: running all in this subform at once
	updateHivOutreachFields();
	updateSpecialtySpec();
	updateSpecialtyVisitSpec();
	updateRequestSpec();	
	updateReferFields();
	updateReferHowSpec();
	updateReferToFields();
	updateReferToHowSpec();


	// ----------------------------------- //
	//  HIV/Aids services                  //
	// ----------------------------------- //

	// define the needed behavior
	var $F3aDentistHivSymptoms = $(document.getElementById("F3aDentistHivSymptoms"));
	var $F3aDentistHivActions = $(document.getElementById("F3aDentistHivActions"));
	var $DentSignThrushInput 			= $(document.getElementById("subtable[HivAidsServices][dentsignthrush]"));
	var $DentSignHairyInput 			= $(document.getElementById("subtable[HivAidsServices][dentsignhairy]"));
	var $DentSignUlcerInput 			= $(document.getElementById("subtable[HivAidsServices][dentsignulcer]"));
	var $DentSignPerioInput 			= $(document.getElementById("subtable[HivAidsServices][dentsignperio]"));
	var $DentSignKaposiInput 			= $(document.getElementById("subtable[HivAidsServices][dentsignkaposi]"));
	var $ActionSampleInput 			= $(document.getElementById("subtable[HivAidsServices][actionsample]"));
	var $ActionTreatInput 			= $(document.getElementById("subtable[HivAidsServices][actiontreat]"));

	var $ActionReferInput 			= $(document.getElementById("subtable[HivAidsServices][actionrefer]"));
	var $ActionReferWhereInput 			= $(document.getElementById("subtable[HivAidsServices][actionreferwhere]"));

	var $ActionOtherInput 			= $(document.getElementById("subtable[HivAidsServices][actionother]"));
	var $ActionOtherSpecInput 			= $(document.getElementById("subtable[HivAidsServices][actionotherspec]"));

	var updateDentistHivFields = function(valJC){
		$F3aDentistHivSymptoms.closest(".group-wrapper").hide();
		$F3aDentistHivActions.closest(".group-wrapper").hide();
		$DentSignThrushInput.closest(".form-group").hide();
		$DentSignHairyInput.closest(".form-group").hide();
		$DentSignUlcerInput.closest(".form-group").hide();
		$DentSignPerioInput.closest(".form-group").hide();
		$DentSignKaposiInput.closest(".form-group").hide();
		$ActionSampleInput.closest(".form-group").hide();
		$ActionTreatInput.closest(".form-group").hide();
		$ActionReferInput.closest(".form-group").hide();
		$ActionReferWhereInput.closest(".form-group").hide();
		$ActionOtherInput.closest(".form-group").hide();
		$ActionOtherSpecInput.closest(".form-group").hide();

	if (valJC === "Dentist"){
		$F3aDentistHivSymptoms.closest(".group-wrapper").show();
		$F3aDentistHivActions.closest(".group-wrapper").show();
		$DentSignThrushInput.closest(".form-group").show();
		$DentSignHairyInput.closest(".form-group").show();
		$DentSignUlcerInput.closest(".form-group").show();
		$DentSignPerioInput.closest(".form-group").show();
		$DentSignKaposiInput.closest(".form-group").show();
		$ActionSampleInput.closest(".form-group").show();
		$ActionTreatInput.closest(".form-group").show();
		$ActionReferInput.closest(".form-group").show();
		$ActionReferWhereInput.closest(".form-group").show();
		$ActionOtherInput.closest(".form-group").show();
		$ActionOtherSpecInput.closest(".form-group").show();
		updateDentistActionRefer();
		updateDentistActionOther();
		};

	}

var updateDentistActionRefer = function(){
		var val = $ActionReferInput.val();
		if(val === "1"){$ActionReferWhereInput.closest(".form-group").show();} else {$ActionReferWhereInput.closest(".form-group").hide();}
	}

	$ActionReferInput.change(updateDentistActionRefer);


var updateDentistActionOther = function(){
		var val = $ActionOtherInput.val();
		if(val === "1"){$ActionOtherSpecInput.closest(".form-group").show();} else {$ActionOtherSpecInput.closest(".form-group").hide();}
	}

	$ActionOtherInput.change(updateDentistActionOther);


edit_helper.setVisibilityRule('HivAidsServices', 'hcttrain', 'hcttraintime', 0, '1');


// **************************************** //

// Subsection for HIV Testing Special Cases // 

// **************************************** //


	// first input variable
	var $HCInput 					= $(document.getElementById("subtable[HivAidsServices][hc]"));
	var $HCClientsInput		= $(document.getElementById("subtable[HivAidsServices][hcclients]"));
	//value for HC [first] input 
	var valHC = $HCInput.val();
	
	//Second input variable
	var $TestingInput 			= $(document.getElementById("subtable[HivAidsServices][testing]"));
	//value for Testing [second] input;
	var valT = $TestingInput.val();

	var $HivReferInput 			= $(document.getElementById("subtable[HivAidsServices][hivrefer]"));
	var $HivReferSpecInput 			= $(document.getElementById("subtable[HivAidsServices][hivreferspec]"));

	var $HivTestVisitsInput 			= $(document.getElementById("subtable[HivAidsServices][hivtestvisits]"));
	var $F8TestsAdminstered 			= $(document.getElementById("F8TestsAdminstered"));

	var $RapidTestInput 			= $(document.getElementById("subtable[HivAidsServices][rapidtest]"));
	var $RapidTestSpecInput 			= $(document.getElementById("subtable[HivAidsServices][rapidtestspec]"));

	var $WesternBlotInput 			= $(document.getElementById("subtable[HivAidsServices][westernblot]"));
	var $ElisaInput 			= $(document.getElementById("subtable[HivAidsServices][elisa]"));
	var $BloodDrawInput 			= $(document.getElementById("subtable[HivAidsServices][blooddraw]"));

	var updateHC = function(){
		var val = $HCInput.val();
		if(val === "1"){$HCClientsInput.closest(".form-group").show();} else {$HCClientsInput.closest(".form-group").hide();}
	}


	var updateHivTestingFields = function(){
		$HivTestVisitsInput.closest(".form-group").hide();
		$F8TestsAdminstered.closest(".group-wrapper").hide();
		$RapidTestInput.closest(".form-group").hide();
		$RapidTestSpecInput.closest(".form-group").hide();
		$WesternBlotInput.closest(".form-group").hide();
		$ElisaInput.closest(".form-group").hide();
		$BloodDrawInput.closest(".form-group").hide();

		var val = $TestingInput.val();

		if(val === "1"){
			$HivTestVisitsInput.closest(".form-group").show();
			$F8TestsAdminstered.closest(".group-wrapper").show();
			$RapidTestInput.closest(".form-group").show();
			$RapidTestSpecInput.closest(".form-group").show();
			$WesternBlotInput.closest(".form-group").show();
			$ElisaInput.closest(".form-group").show();
			$BloodDrawInput.closest(".form-group").show();
			updateRapidTestSpec();
		}
	}

	var updateHivReferSpec = function(){
		var val = $HivReferInput.val();
		if(val === "Other"){$HivReferSpecInput.closest(".form-group").show();} else {$HivReferSpecInput.closest(".form-group").hide();}
	}

	$HivReferInput.change(updateHivReferSpec);

	// define the needed behavior
	var updateRapidTestSpec = function(){
		var val = $RapidTestInput.val();
		if(val === "1"){$RapidTestSpecInput.closest(".form-group").show();} else {$RapidTestSpecInput.closest(".form-group").hide();}
	}

	$RapidTestInput.change(updateRapidTestSpec);

	var updateHIVTestCounselFields = function(){
			var valHC = $HCInput.val();
			var valT = $TestingInput.val();
			var $hivNoHCT	= $(document.getElementById("hivNoHCT")); 

			//if valHC = 1 and valT = 1 call both functions and call hide of 6a and exit function?
			//else just call both functions 
			if (valHC == "0" && valT == "0") {
				updateHC();
				updateHivTestingFields();
				$hivNoHCT.closest(".group-wrapper").show();
				$HivReferInput.closest(".form-group").show();
				updateHivReferSpec();
			}
			else {
				updateHC();
				updateHivTestingFields();				
				$hivNoHCT.closest(".group-wrapper").hide();
				$HivReferInput.closest(".form-group").hide();
				$HivReferSpecInput.closest(".form-group").hide();
			}

	};

		$HCInput.change(updateHIVTestCounselFields);
		$TestingInput.change(updateHIVTestCounselFields);

		//run joint function once
		updateHIVTestCounselFields();


edit_helper.setVisibilityRule('HivAidsServices', 'hivtreat', 'hivtreatvisits', 0, '1');

edit_helper.setVisibilityRule('HivAidsServices', 'oitreat', 'oitreatvisits', 0, '1');

// ---------------------------- //
//  lab and pharmacy services   //
// ---------------------------- //

edit_helper.setVisibilityRule('LaboratoryAndPharmacyServices', 'reagentstock', ['stockout','reagentsout','diagout'], 0, '1');

//subtable[LaboratoryAndPharmacyServices][prescription]	
	var $PresecriptionInput 			= $(document.getElementById("subtable[LaboratoryAndPharmacyServices][prescription]"));
	
	var $PrescriptionVisitsInput 			= $(document.getElementById("subtable[LaboratoryAndPharmacyServices][prescriptionvisits]"));
	var $G10PharmacyList = $(document.getElementById("G10PharmacyList"));
	var $G10aAmoxicillin = $(document.getElementById("G10aAmoxicillin"));
	var $G10bMetronidazole = $(document.getElementById("G10bMetronidazole"));
	var $G10cSalbutamol = $(document.getElementById("G10cSalbutamol"));
	var $G10dGlibenclamide = $(document.getElementById("G10dGlibenclamide"));
	var $G10eAtenolol = $(document.getElementById("G10eAtenolol"));
	var $G10fSimvastatin = $(document.getElementById("G10fSimvastatin"));
	var $G10gCaptopril = $(document.getElementById("G10gCaptopril"));
	var $G10hOmeprazole = $(document.getElementById("G10hOmeprazole"));
	var $G10iDiclofenac = $(document.getElementById("G10iDiclofenac"));
	var $G10jParacetamol = $(document.getElementById("G10jParacetamol"));
	var $G10kCotrimoxazole = $(document.getElementById("G10kCotrimoxazole"));
	var $G10lPenicillin = $(document.getElementById("G10lPenicillin"));
	var $G10mCiproflaxin = $(document.getElementById("G10mCiproflaxin"));

	var $AvailAmoxInput 			= $(document.getElementById("subtable[LaboratoryAndPharmacyServices][availamox]"));
	var $AvailMetroInput 			= $(document.getElementById("subtable[LaboratoryAndPharmacyServices][availmetro]"));
	var $AvailSalbuInput 			= $(document.getElementById("subtable[LaboratoryAndPharmacyServices][availsalbu]"));
	var $AvailGilbInput 			= $(document.getElementById("subtable[LaboratoryAndPharmacyServices][availgilb]"));
	var $AvailAtenoInput 			= $(document.getElementById("subtable[LaboratoryAndPharmacyServices][availateno]"));
	var $AvailSimvaInput 			= $(document.getElementById("subtable[LaboratoryAndPharmacyServices][availsimva]"));
	var $AvailCapInput 			= $(document.getElementById("subtable[LaboratoryAndPharmacyServices][availcap]"));
	var $AvailOmeInput 			= $(document.getElementById("subtable[LaboratoryAndPharmacyServices][availome]"));
	var $AvailDicInput 			= $(document.getElementById("subtable[LaboratoryAndPharmacyServices][availdic]"));
	var $AvailParaInput 			= $(document.getElementById("subtable[LaboratoryAndPharmacyServices][availpara]"));
	var $AvailCotriInput 			= $(document.getElementById("subtable[LaboratoryAndPharmacyServices][availcotri]"));
	var $AvailPeniInput 			= $(document.getElementById("subtable[LaboratoryAndPharmacyServices][availpeni]"));
	var $AvailCiproInput 			= $(document.getElementById("subtable[LaboratoryAndPharmacyServices][availcipro]"));

	var $StockAmoxInput 			= $(document.getElementById("subtable[LaboratoryAndPharmacyServices][stockamox]"));
	var $StockMetroInput 			= $(document.getElementById("subtable[LaboratoryAndPharmacyServices][stockmetro]"));
	var $StockSalbuInput 			= $(document.getElementById("subtable[LaboratoryAndPharmacyServices][stocksalbu]"));
	var $StockGilbInput 			= $(document.getElementById("subtable[LaboratoryAndPharmacyServices][stockgilb]"));
	var $StockAtenoInput 			= $(document.getElementById("subtable[LaboratoryAndPharmacyServices][stockateno]"));
	var $StockSimvaInput 			= $(document.getElementById("subtable[LaboratoryAndPharmacyServices][stocksimva]"));
	var $StockCapInput 			= $(document.getElementById("subtable[LaboratoryAndPharmacyServices][stockcap]"));
	var $StockOmeInput 			= $(document.getElementById("subtable[LaboratoryAndPharmacyServices][stockome]"));
	var $StockDicInput 			= $(document.getElementById("subtable[LaboratoryAndPharmacyServices][stockdic]"));
	var $StockParaInput 			= $(document.getElementById("subtable[LaboratoryAndPharmacyServices][stockpara]"));
	var $StockCotriInput 			= $(document.getElementById("subtable[LaboratoryAndPharmacyServices][stockcotri]"));
	var $StockPeniInput 			= $(document.getElementById("subtable[LaboratoryAndPharmacyServices][stockpeni]"));
	var $StockCiproInput 			= $(document.getElementById("subtable[LaboratoryAndPharmacyServices][stockcipro]"));

	var updateStockFields = function(drugName){

		var aInputID = 'subtable[LaboratoryAndPharmacyServices][avail' + drugName + ']';
		var sInputID = 'subtable[LaboratoryAndPharmacyServices][stock' + drugName + ']';
		var $aInput = $(document.getElementById(aInputID));
		var $sInput = $(document.getElementById(sInputID));
		var val = $aInput.val();
		if(val === "1"){$sInput.closest(".form-group").show();} else {$sInput.closest(".form-group").hide();}
	}

	// attach our behavior to the "change" event of relevant node
	$AvailAmoxInput.change(function(event) {updateStockFields('amox');});
	$AvailMetroInput.change(function(event) {updateStockFields('metro');});
	$AvailSalbuInput.change(function(event) {updateStockFields('salbu');});
	$AvailGilbInput.change(function(event) {updateStockFields('gilb');});
	$AvailAtenoInput.change(function(event) {updateStockFields('ateno');});
	$AvailSimvaInput.change(function(event) {updateStockFields('simva');});
	$AvailCapInput.change(function(event) {updateStockFields('cap');});
	$AvailOmeInput.change(function(event) {updateStockFields('ome');});
	$AvailDicInput.change(function(event) {updateStockFields('dic');});
	$AvailParaInput.change(function(event) {updateStockFields('para');});
	$AvailCotriInput.change(function(event) {updateStockFields('cotri');});
	$AvailPeniInput.change(function(event) {updateStockFields('peni');});
	$AvailCiproInput.change(function(event) {updateStockFields('cipro');});

	var updatePrescriptionFields = function () {
		var prescriptionFieldArray =[$G10PharmacyList, $PrescriptionVisitsInput, $AvailAmoxInput, $AvailMetroInput, $AvailSalbuInput, $AvailGilbInput, $AvailAtenoInput, $AvailSimvaInput, $AvailCapInput, $AvailOmeInput, $AvailDicInput, $AvailParaInput, $AvailCotriInput, $AvailPeniInput, $AvailCiproInput];
		var prescriptionLabelArray = [$G10aAmoxicillin, $G10bMetronidazole, $G10cSalbutamol, $G10dGlibenclamide, $G10eAtenolol, $G10fSimvastatin, $G10gCaptopril, $G10hOmeprazole, $G10iDiclofenac, $G10jParacetamol, $G10kCotrimoxazole, $G10lPenicillin, $G10mCiproflaxin];
		var val = $PresecriptionInput.val();
		//alert ('in prescription fields, val is '+val);
		if (val === '1') {
				for (var i = prescriptionFieldArray.length - 1; i >= 0; i--) {
				edit_helper.showHideWidget(prescriptionFieldArray[i], true)
				};
				for (var i = prescriptionLabelArray.length - 1; i >= 0; i--) {
				edit_helper.showHideLabel(prescriptionLabelArray[i], true)
				};
				//run checks for all the "Stock" fields
				updateStockFields('amox');
				updateStockFields('metro');
				updateStockFields('salbu');
				updateStockFields('gilb');
				updateStockFields('ateno');
				updateStockFields('simva');
				updateStockFields('cap');
				updateStockFields('ome');
				updateStockFields('dic');
				updateStockFields('para');
				updateStockFields('cotri');
				updateStockFields('peni');
				updateStockFields('cipro');
		} else {
				//add secondary fields to array so they are forced to hide
				prescriptionFieldArray.push($StockAmoxInput, $StockMetroInput, $StockSalbuInput, $StockGilbInput, $StockAtenoInput, $StockSimvaInput, $StockCapInput, $StockOmeInput, $StockDicInput, $StockParaInput, $StockCotriInput, $StockPeniInput, $StockCiproInput);
				for (var i = prescriptionFieldArray.length - 1; i >= 0; i--) {
				edit_helper.showHideWidget(prescriptionFieldArray[i], false)
				};
				for (var i = prescriptionLabelArray.length - 1; i >= 0; i--) {
				edit_helper.showHideLabel(prescriptionLabelArray[i], false)
				};
			}
	}

	$PresecriptionInput.change(updatePrescriptionFields);
	updatePrescriptionFields();


	//subtable[LaboratoryAndPharmacyServices][arv]
	var $ARVInput 			= $(document.getElementById("subtable[LaboratoryAndPharmacyServices][arv]"));
	
	//var $pharmacyARV = $(document.getElementById("pharmacyARV")); 
	var $pharmacyARVstockout = $(document.getElementById("pharmacyARVstockout")); 
	var $G12ARVList = $(document.getElementById("G12ARVList"));
	var $G12aAZT = $(document.getElementById("G12aAZT"));
	var $G12b3TC = $(document.getElementById("G12b3TC"));
	var $G12cTDF = $(document.getElementById("G12cTDF"));
	var $G12dFTC = $(document.getElementById("G12dFTC"));
	var $G12eEFV = $(document.getElementById("G12eEFV"));
	var $G12fATVr = $(document.getElementById("G12fATVr"));
	var $G12gLPVr = $(document.getElementById("G12gLPVr"));

	var $FillInput 			= $(document.getElementById("subtable[LaboratoryAndPharmacyServices][fill]"));
	var $AvailAztInput 			= $(document.getElementById("subtable[LaboratoryAndPharmacyServices][availazt]"));
	var $Avail3tcInput 			= $(document.getElementById("subtable[LaboratoryAndPharmacyServices][avail3tc]"));
	var $AvailTdfInput 			= $(document.getElementById("subtable[LaboratoryAndPharmacyServices][availtdf]"));
	var $AvailFtcInput 			= $(document.getElementById("subtable[LaboratoryAndPharmacyServices][availftc]"));
	var $AvailEfvInput 			= $(document.getElementById("subtable[LaboratoryAndPharmacyServices][availefv]"));
	var $AvailAtvInput 			= $(document.getElementById("subtable[LaboratoryAndPharmacyServices][availatv]"));
	var $AvailLpvInput 			= $(document.getElementById("subtable[LaboratoryAndPharmacyServices][availlpv]"));

	var $FillSpecifyInput 			= $(document.getElementById("subtable[LaboratoryAndPharmacyServices][fillspecify]"));
	var $StockAztInput 			= $(document.getElementById("subtable[LaboratoryAndPharmacyServices][stockazt]"));
	var $Stock3tcInput 			= $(document.getElementById("subtable[LaboratoryAndPharmacyServices][stock3tc]"));
	var $StockTdfInput 			= $(document.getElementById("subtable[LaboratoryAndPharmacyServices][stocktdf]"));
	var $StockFtcInput 			= $(document.getElementById("subtable[LaboratoryAndPharmacyServices][stockftc]"));
	var $StockEfvInput 			= $(document.getElementById("subtable[LaboratoryAndPharmacyServices][stockefv]"));
	var $StockAtvInput 			= $(document.getElementById("subtable[LaboratoryAndPharmacyServices][stockatv]"));
	var $StockLpvInput 			= $(document.getElementById("subtable[LaboratoryAndPharmacyServices][stocklpv]"));

	// attach our behavior to the "change" event of relevant node
	$AvailAztInput.change(function(event) {updateStockFields('azt');});
	$Avail3tcInput.change(function(event) {updateStockFields('3tc');});
	$AvailTdfInput.change(function(event) {updateStockFields('tdf');});
	$AvailFtcInput.change(function(event) {updateStockFields('ftc');});
	$AvailEfvInput.change(function(event) {updateStockFields('efv');});
	$AvailAtvInput.change(function(event) {updateStockFields('atv');});
	$AvailLpvInput.change(function(event) {updateStockFields('lpv');});

	var updateFillSpec = function(){
		var val = $FillInput.val();
		if(val === "1"){ $FillSpecifyInput.closest(".form-group").show();} else {$FillSpecifyInput.closest(".form-group").hide();}
	}

	$FillInput.change(updateFillSpec);

	var updateARVFields = function () {
		var ARVFieldArray =[$FillInput, $AvailAztInput, $Avail3tcInput, $AvailTdfInput, $AvailFtcInput, $AvailEfvInput, $AvailAtvInput, $AvailLpvInput];
		var ARVLabelArray =[$pharmacyARVstockout, $G12ARVList, $G12aAZT, $G12b3TC, $G12cTDF, $G12dFTC, $G12eEFV, $G12fATVr, $G12gLPVr];
		var val = $ARVInput.val();
		if (val === '1') {
				for (var i = ARVFieldArray.length - 1; i >= 0; i--) {
				edit_helper.showHideWidget(ARVFieldArray[i], true)
				};
				for (var i = ARVLabelArray.length - 1; i >= 0; i--) {
				edit_helper.showHideLabel(ARVLabelArray[i], true)
				};
				//run checks for all the "Stock" fields
				updateStockFields('azt');
				updateStockFields('3tc');
				updateStockFields('tdf');
				updateStockFields('ftc');
				updateStockFields('efv');
				updateStockFields('atv');
				updateStockFields('lpv');
				updateFillSpec();
		} else {
				//add secondary fields to array so they are forced to hide
				ARVFieldArray.push($FillInput, $FillSpecifyInput, $StockAztInput, $Stock3tcInput, $StockTdfInput, $StockFtcInput, $StockEfvInput, $StockAtvInput, $StockLpvInput);
				for (var i = ARVFieldArray.length - 1; i >= 0; i--) {
				edit_helper.showHideWidget(ARVFieldArray[i], false)
				};
				for (var i = ARVLabelArray.length - 1; i >= 0; i--) {
				edit_helper.showHideLabel(ARVLabelArray[i], false)
				};
			}
	}

	$ARVInput.change(updateARVFields);
	updateARVFields();


// ---------------------------- //
//  Payment for Health Services //
// ---------------------------- //

edit_helper.setVisibilityRule('PaymentForHealthServices', 'other', 'otherspec', 0, '1');

edit_helper.setVisibilityRule('PaymentForHealthServices', 'other2', 'other2spec', 0, '1');

edit_helper.setVisibilityRule('PaymentForHealthServices', 'insurance',  'privateperc', 0, '1');


// ----------------------------- //
//  Health Records and Reporting //
// ----------------------------- //

//subtable[HealthRecordsAndReporting][healthstat]
	var $HealthStatInput 			= $(document.getElementById("subtable[HealthRecordsAndReporting][healthstat]"));
	
	var $I2ReportingOptions = $(document.getElementById("I2ReportingOptions"));
	var $I2aSTItestresults = $(document.getElementById("I2aSTItestresults"));
	var $I2bHIVtestresults = $(document.getElementById("I2bHIVtestresults"));
	var $I2cNotifiablediseases = $(document.getElementById("I2cNotifiablediseases"));
	var $I2dHealthservices = $(document.getElementById("I2dHealthservices"));
	var $I2eOther = $(document.getElementById("I2eOther"));
	var $reportingPreferredMethod = $(document.getElementById("reportingPreferredMethod"));

	var $ReportStiInput 			= $(document.getElementById("subtable[HealthRecordsAndReporting][reportsti]"));
		var $RecipStiInput 			= $(document.getElementById("subtable[HealthRecordsAndReporting][recipsti]"));
		var $FreqStiInput 			= $(document.getElementById("subtable[HealthRecordsAndReporting][freqsti]")); //Other
			var $FreqSpecStiInput 			= $(document.getElementById("subtable[HealthRecordsAndReporting][freqspecsti]"));
		var $MethodStiInput 			= $(document.getElementById("subtable[HealthRecordsAndReporting][methodsti]")); //Other
			var $MethodSpecStiInput 			= $(document.getElementById("subtable[HealthRecordsAndReporting][methodspecsti]"));

	var updateFreqSTISpec = function () {
		var val = $FreqStiInput.val();
		//alert("FreqStiInput is "+val);
		if(val === "Other"){ $FreqSpecStiInput.closest(".form-group").show();} else {$FreqSpecStiInput.closest(".form-group").hide();}

	}
		$FreqStiInput.change(updateFreqSTISpec);

	var updateMethodSTISpec = function() {
		var val = $MethodStiInput.val();
		//alert("MethodStiInput is "+val);
		if(val === "Other"){ $MethodSpecStiInput.closest(".form-group").show();} else {$MethodSpecStiInput.closest(".form-group").hide();}
	}
		$MethodStiInput.change(updateMethodSTISpec);

	var updateReportSTIFields = function(){
			var val = $ReportStiInput.val();
			if (val === '1') {
					$RecipStiInput.closest(".form-group").show();
					$FreqStiInput.closest(".form-group").show();
					$MethodStiInput.closest(".form-group").show();
					updateFreqSTISpec();
					updateMethodSTISpec();
			} 
			else {
					$RecipStiInput.closest(".form-group").hide();
					$FreqStiInput.closest(".form-group").hide()
					$FreqSpecStiInput.closest(".form-group").hide()
					$MethodStiInput.closest(".form-group").hide()
					$MethodSpecStiInput.closest(".form-group").hide()
			}
	}
		$ReportStiInput.change(updateReportSTIFields);


	var $ReportHivInput 			= $(document.getElementById("subtable[HealthRecordsAndReporting][reporthiv]"));
		var $RecipHivInput 			= $(document.getElementById("subtable[HealthRecordsAndReporting][reciphiv]"));
		var $FreqHivInput 			= $(document.getElementById("subtable[HealthRecordsAndReporting][freqhiv]")); //Other
			var $FreqSpecHivInput 			= $(document.getElementById("subtable[HealthRecordsAndReporting][freqspechiv]"));
		var $MethodHivInput 			= $(document.getElementById("subtable[HealthRecordsAndReporting][methodhiv]")); //Other
			var $MethodSpecHivInput 			= $(document.getElementById("subtable[HealthRecordsAndReporting][methodspechiv]"));

	var updateFreqHivSpec = function () {
		var val = $FreqHivInput.val();
		//alert("FreqHivInput is "+val);
		if(val === "Other"){ $FreqSpecHivInput.closest(".form-group").show();} else {$FreqSpecHivInput.closest(".form-group").hide();}

	}
		$FreqHivInput.change(updateFreqHivSpec);

	var updateMethodHivSpec = function() {
		var val = $MethodHivInput.val();
		//alert("MethodHivInput is "+val);
		if(val === "Other"){ $MethodSpecHivInput.closest(".form-group").show();} else {$MethodSpecHivInput.closest(".form-group").hide();}
	}
		$MethodHivInput.change(updateMethodHivSpec);

	var updateReportHivFields = function(){
			var val = $ReportHivInput.val();
			if (val === '1') {
					$RecipHivInput.closest(".form-group").show();
					$FreqHivInput.closest(".form-group").show();
					$MethodHivInput.closest(".form-group").show();
					updateFreqHivSpec();
					updateMethodHivSpec();
			} 
			else {
					$RecipHivInput.closest(".form-group").hide();
					$FreqHivInput.closest(".form-group").hide()
					$FreqSpecHivInput.closest(".form-group").hide()
					$MethodHivInput.closest(".form-group").hide()
					$MethodSpecHivInput.closest(".form-group").hide()
			}
	}
		$ReportHivInput.change(updateReportHivFields);


	var $ReportNoteDisInput 			= $(document.getElementById("subtable[HealthRecordsAndReporting][reportnotedis]"));
		var $RecipNoteDisInput 			= $(document.getElementById("subtable[HealthRecordsAndReporting][recipnotedis]"));
		var $FreqNoteDisInput 			= $(document.getElementById("subtable[HealthRecordsAndReporting][freqnotedis]")); //Other
			var $FreqSpecNoteDisInput 			= $(document.getElementById("subtable[HealthRecordsAndReporting][freqspecnotedis]"));
		var $MethodNoteDisInput 			= $(document.getElementById("subtable[HealthRecordsAndReporting][methodnotedis]")); //Other
			var $MethodSpecNoteDisInput 			= $(document.getElementById("subtable[HealthRecordsAndReporting][methodspecnotedis]"));

	var updateFreqNoteDisSpec = function () {
		var val = $FreqNoteDisInput.val();
		//alert("FreqNoteDisInput is "+val);
		if(val === "Other"){ $FreqSpecNoteDisInput.closest(".form-group").show();} else {$FreqSpecNoteDisInput.closest(".form-group").hide();}

	}
		$FreqNoteDisInput.change(updateFreqNoteDisSpec);

	var updateMethodNoteDisSpec = function() {
		var val = $MethodNoteDisInput.val();
		//alert("MethodNoteDisInput is "+val);
		if(val === "Other"){ $MethodSpecNoteDisInput.closest(".form-group").show();} else {$MethodSpecNoteDisInput.closest(".form-group").hide();}
	}
		$MethodNoteDisInput.change(updateMethodNoteDisSpec);

	var updateReportNoteDisFields = function(){
			var val = $ReportNoteDisInput.val();
			if (val === '1') {
					$RecipNoteDisInput.closest(".form-group").show();
					$FreqNoteDisInput.closest(".form-group").show();
					$MethodNoteDisInput.closest(".form-group").show();
					updateFreqNoteDisSpec();
					updateMethodNoteDisSpec();
			} 
			else {
					$RecipNoteDisInput.closest(".form-group").hide();
					$FreqNoteDisInput.closest(".form-group").hide()
					$FreqSpecNoteDisInput.closest(".form-group").hide()
					$MethodNoteDisInput.closest(".form-group").hide()
					$MethodSpecNoteDisInput.closest(".form-group").hide()
			}
	}
		$ReportNoteDisInput.change(updateReportNoteDisFields);

	var $ReportHealthStatInput 			= $(document.getElementById("subtable[HealthRecordsAndReporting][reporthealthstat]"));
		var $RecipHealthStatInput 			= $(document.getElementById("subtable[HealthRecordsAndReporting][reciphealthstat]"));
		var $FreqHealthStatInput 			= $(document.getElementById("subtable[HealthRecordsAndReporting][freqhealthstat]")); //Other
			var $FreqSpecHealthStatInput 			= $(document.getElementById("subtable[HealthRecordsAndReporting][freqspechealthstat]"));
		var $MethodHealthStatInput 			= $(document.getElementById("subtable[HealthRecordsAndReporting][methodhealthstat]")); //Other
			var $MethodSpecHealthStatInput 			= $(document.getElementById("subtable[HealthRecordsAndReporting][methodspechealthstat]"));

	var updateFreqHealthStatSpec = function () {
		var val = $FreqHealthStatInput.val();
		//alert("FreqHivInput is "+val);
		if(val === "Other"){ $FreqSpecHealthStatInput.closest(".form-group").show();} else {$FreqSpecHealthStatInput.closest(".form-group").hide();}

	}
		$FreqHealthStatInput.change(updateFreqHealthStatSpec);

	var updateMethodHealthStatSpec = function() {
		var val = $MethodHealthStatInput.val();
		//alert("MethodHivInput is "+val);
		if(val === "Other"){ $MethodSpecHealthStatInput.closest(".form-group").show();} else {$MethodSpecHealthStatInput.closest(".form-group").hide();}
	}
		$MethodHealthStatInput.change(updateMethodHealthStatSpec);

	var updateReportHealthStatFields = function(){
			var val = $ReportHealthStatInput.val();
			if (val === '1') {
					$RecipHealthStatInput.closest(".form-group").show();
					$FreqHealthStatInput.closest(".form-group").show();
					$MethodHealthStatInput.closest(".form-group").show();
					updateFreqHealthStatSpec();
					updateMethodHealthStatSpec();
			} 
			else {
					$RecipHealthStatInput.closest(".form-group").hide();
					$FreqHealthStatInput.closest(".form-group").hide()
					$FreqSpecHealthStatInput.closest(".form-group").hide()
					$MethodHealthStatInput.closest(".form-group").hide()
					$MethodSpecHealthStatInput.closest(".form-group").hide()
			}
	}
		$ReportHealthStatInput.change(updateReportHealthStatFields);


	var $ReportOtherInput 			= $(document.getElementById("subtable[HealthRecordsAndReporting][reportother]"));
		var $ReportOtherSpecInput 			= $(document.getElementById("subtable[HealthRecordsAndReporting][reportotherspec]"));
		var $RecipOtherInput 			= $(document.getElementById("subtable[HealthRecordsAndReporting][recipother]"));
		var $RecipOtherInput 			= $(document.getElementById("subtable[HealthRecordsAndReporting][recipother]"));
		var $FreqOtherInput 			= $(document.getElementById("subtable[HealthRecordsAndReporting][freqother]")); //Other
			var $FreqSpecOtherInput 			= $(document.getElementById("subtable[HealthRecordsAndReporting][freqspecother]"));
		var $MethodOtherInput 			= $(document.getElementById("subtable[HealthRecordsAndReporting][methodother]")); //Other
			var $MethodSpecOtherInput 			= $(document.getElementById("subtable[HealthRecordsAndReporting][methodspecother]"));

	var updateFreqOtherSpec = function () {
		var val = $FreqOtherInput.val();
		if(val === "Other"){ $FreqSpecOtherInput.closest(".form-group").show();} else {$FreqSpecOtherInput.closest(".form-group").hide();}

	}
		$FreqOtherInput.change(updateFreqOtherSpec);

	var updateMethodOtherSpec = function() {
		var val = $MethodOtherInput.val();
		if(val === "Other"){ $MethodSpecOtherInput.closest(".form-group").show();} else {$MethodSpecOtherInput.closest(".form-group").hide();}
	}
		$MethodOtherInput.change(updateMethodOtherSpec);

	var updateReportOtherFields = function(){
			var val = $ReportOtherInput.val();
			if (val === '1') {
					$ReportOtherSpecInput.closest(".form-group").show();
					$RecipOtherInput.closest(".form-group").show();
					$FreqOtherInput.closest(".form-group").show();
					$MethodOtherInput.closest(".form-group").show();
					updateFreqOtherSpec();
					updateMethodOtherSpec();
			} 
			else {
					$ReportOtherSpecInput.closest(".form-group").hide();
					$RecipOtherInput.closest(".form-group").hide();
					$FreqOtherInput.closest(".form-group").hide()
					$FreqSpecOtherInput.closest(".form-group").hide()
					$MethodOtherInput.closest(".form-group").hide()
					$MethodSpecOtherInput.closest(".form-group").hide()
			}
	}
		$ReportOtherInput.change(updateReportOtherFields);

//and one more floating at the end of the blocks
	var $ReportPrefInput 			= $(document.getElementById("subtable[HealthRecordsAndReporting][reportpref]"));
		var $ReportPrefSpecInput 			= $(document.getElementById("subtable[HealthRecordsAndReporting][reportprefotherspec]"));

var updateReportPrefSpec = function () {
		var val = $ReportPrefInput.val();
		if(val === "Other"){ $ReportPrefSpecInput.closest(".form-group").show();} else {$ReportPrefSpecInput.closest(".form-group").hide();}
	}
		$ReportPrefInput.change(updateReportPrefSpec);

	var updateHealthStatFields = function () {
		var HealthStatFieldArray =[$ReportStiInput, $ReportHivInput, $ReportNoteDisInput, $ReportHealthStatInput, $ReportOtherInput, $ReportPrefInput];
		var HealthStatLabelArray =[$I2ReportingOptions, $I2aSTItestresults, $I2bHIVtestresults, $I2cNotifiablediseases, $I2dHealthservices, $I2eOther, $reportingPreferredMethod];
		var val = $HealthStatInput.val();
		if (val === '1') {
				for (var i = HealthStatFieldArray.length - 1; i >= 0; i--) {edit_helper.showHideWidget(HealthStatFieldArray[i], true)};
				for (var i = HealthStatLabelArray.length - 1; i >= 0; i--) {edit_helper.showHideLabel(HealthStatLabelArray[i], true)};
				updateReportSTIFields();
				updateReportHivFields();
				updateReportNoteDisFields();
				updateReportHealthStatFields();
				updateReportOtherFields();
				updateReportPrefSpec();
		} else {
				//add secondary fields to array so they are forced to hide
				HealthStatFieldArray.push($RecipStiInput, $FreqStiInput, $FreqSpecStiInput, $MethodStiInput, $MethodSpecStiInput, $RecipHivInput, $FreqHivInput, $FreqSpecHivInput, $MethodHivInput, $MethodSpecHivInput, $RecipNoteDisInput, $FreqNoteDisInput, $FreqSpecNoteDisInput, $MethodNoteDisInput, $MethodSpecNoteDisInput, $RecipHealthStatInput, $FreqHealthStatInput, $FreqSpecHealthStatInput, $MethodHealthStatInput, $MethodSpecHealthStatInput, $ReportOtherSpecInput, $RecipOtherInput, $RecipOtherInput, $FreqOtherInput, $FreqSpecOtherInput, $MethodOtherInput, $MethodSpecOtherInput, $ReportPrefSpecInput);
				for (var i = HealthStatFieldArray.length - 1; i >= 0; i--) {edit_helper.showHideWidget(HealthStatFieldArray[i], false)};
				for (var i = HealthStatLabelArray.length - 1; i >= 0; i--) {edit_helper.showHideLabel(HealthStatLabelArray[i], false)};
			}
	}

	$HealthStatInput.change(updateHealthStatFields);
	updateHealthStatFields();


// ---------------------------- //
//  global variables / function //
// ---------------------------- //

var $jobCatInput 			= $(document.getElementById("subtable[ProprietorInformation][jobcat]"));

var updateJobCats = function(){

	var valJC = $jobCatInput.val();

	updateJobCatSpecs(valJC);
	updateDentistHivFields(valJC);
	};

	$jobCatInput.change(updateJobCats);
	updateJobCats();


});