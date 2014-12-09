<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClinicTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('clinic', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->date('interviewdate')->nullable()->default(null);
			$table->string('interviewinitial', 100)->nullable()->default(null);
			$table->string('country', 100)->nullable()->default(null);
			$table->string('parishisland', 100)->nullable()->default(null);
			$table->string('facilityname', 100)->nullable()->default(null);
			$table->string('facilityaddress', 100)->nullable()->default(null);
			$table->boolean('consentobtained')->nullable()->default(null);
			$table->string('sector', 100)->nullable()->default(null);
			$table->decimal('lat', 12, 10)->nullable()->default(null);
			$table->decimal('lng', 12, 10)->nullable()->default(null);
			$table->timestamps();
			$table->softDeletes();
		});

		Schema::create('proprietor_information', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->unsignedInteger('clinic_id')->nullable()->default(null);
			$table->foreign('clinic_id')->references('id')->on('clinic')->onDelete('cascade');
			$table->string('fullname', 100)->nullable()->default(null);
			$table->string('title', 100)->nullable()->default(null);
			$table->string('telephone', 100)->nullable()->default(null);
			$table->string('email', 100)->nullable()->default(null);
			$table->string('jobcat', 100)->nullable()->default(null);
			$table->string('jobcatspec', 100)->nullable()->default(null);
			$table->string('jobcatother', 100)->nullable()->default(null);
			$table->string('gender', 100)->nullable()->default(null);
			$table->integer('practice')->nullable()->default(null);
			$table->string('hcppublicpast', 100)->nullable()->default(null);
			$table->string('hcppubliccurrent', 100)->nullable()->default(null);
			$table->integer('publichours')->nullable()->default(null);
			$table->string('professionalassoc', 100)->nullable()->default(null);
			$table->string('assoc', 200)->nullable()->default(null);
		});

		Schema::create('facility_information', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->unsignedInteger('clinic_id')->nullable()->default(null);
			$table->foreign('clinic_id')->references('id')->on('clinic')->onDelete('cascade');
			$table->string('facilitytype', 100)->nullable()->default(null);
			$table->string('facilitytypespec', 100)->nullable()->default(null);
			$table->string('mon', 100)->nullable()->default(null);
			$table->time('monopen')->nullable()->default(null);
			$table->time('monclose')->nullable()->default(null);
			$table->string('tue', 100)->nullable()->default(null);
			$table->time('tueopen')->nullable()->default(null);
			$table->time('tueclose')->nullable()->default(null);
			$table->string('wed', 100)->nullable()->default(null);
			$table->time('wedopen')->nullable()->default(null);
			$table->time('wedclose')->nullable()->default(null);
			$table->string('thur', 100)->nullable()->default(null);
			$table->time('thuropen')->nullable()->default(null);
			$table->time('thurclose')->nullable()->default(null);
			$table->string('fri', 100)->nullable()->default(null);
			$table->time('friopen')->nullable()->default(null);
			$table->time('friclose')->nullable()->default(null);
			$table->string('sat', 100)->nullable()->default(null);
			$table->time('satopen')->nullable()->default(null);
			$table->time('satclose')->nullable()->default(null);
			$table->string('sun', 100)->nullable()->default(null);
			$table->time('sunopen')->nullable()->default(null);
			$table->time('sunclose')->nullable()->default(null);
			$table->string('hournotes', 100)->nullable()->default(null);
		});

		Schema::create('staffing_and_equipment', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->unsignedInteger('clinic_id')->nullable()->default(null);
			$table->foreign('clinic_id')->references('id')->on('clinic')->onDelete('cascade');
			$table->integer('empphys')->nullable()->default(null);
			$table->integer('empphysassist')->nullable()->default(null);
			$table->integer('empphysspec')->nullable()->default(null);
			$table->string('empphysspectypes', 100)->nullable()->default(null);
			$table->integer('empnurse')->nullable()->default(null);
			$table->integer('empnursassist')->nullable()->default(null);
			$table->integer('emppharm')->nullable()->default(null);
			$table->integer('emppharmtech')->nullable()->default(null);
			$table->integer('emplabtech')->nullable()->default(null);
			$table->integer('empdentist')->nullable()->default(null);
			$table->integer('empdentassist')->nullable()->default(null);
			$table->integer('emptech')->nullable()->default(null);
			$table->integer('empadmin')->nullable()->default(null);
			$table->integer('empnonadmin')->nullable()->default(null);
			$table->integer('empout')->nullable()->default(null);
			$table->integer('empvolun')->nullable()->default(null);
			$table->integer('empphyspart')->nullable()->default(null);
			$table->integer('empphysassistpart')->nullable()->default(null);
			$table->integer('empphysspecpart')->nullable()->default(null);
			$table->string('empphysspectypespart', 100)->nullable()->default(null);
			$table->integer('empnursepart')->nullable()->default(null);
			$table->integer('empnursassistpart')->nullable()->default(null);
			$table->integer('emppharmpart')->nullable()->default(null);
			$table->integer('emppharmtechpart')->nullable()->default(null);
			$table->integer('emplabtechpart')->nullable()->default(null);
			$table->integer('empdentistpart')->nullable()->default(null);
			$table->integer('empdentassistpart')->nullable()->default(null);
			$table->integer('emptechpart')->nullable()->default(null);
			$table->integer('empadminpart')->nullable()->default(null);
			$table->integer('empnonadminpart')->nullable()->default(null);
			$table->integer('empoutpart')->nullable()->default(null);
			$table->integer('empvolunpart')->nullable()->default(null);
			$table->string('empnotes', 100)->nullable()->default(null);
			$table->integer('facilityexam')->nullable()->default(null);
			$table->integer('facilityop')->nullable()->default(null);
			$table->integer('facilityin')->nullable()->default(null);
			$table->boolean('eqherecent')->nullable()->default(null);
			$table->boolean('eqfunccent')->nullable()->default(null);
			$table->boolean('eqpubcent')->nullable()->default(null);
			$table->boolean('eqheretherm')->nullable()->default(null);
			$table->boolean('eqfunctherm')->nullable()->default(null);
			$table->boolean('eqpubtherm')->nullable()->default(null);
			$table->boolean('eqherestab')->nullable()->default(null);
			$table->boolean('eqfuncstab')->nullable()->default(null);
			$table->boolean('eqpubstab')->nullable()->default(null);
			$table->boolean('eqheretemp')->nullable()->default(null);
			$table->boolean('eqfunctemp')->nullable()->default(null);
			$table->boolean('eqpubtemp')->nullable()->default(null);
			$table->boolean('eqheredead')->nullable()->default(null);
			$table->boolean('eqfuncdead')->nullable()->default(null);
			$table->boolean('eqpubdead')->nullable()->default(null);
			$table->boolean('eqherexfilm')->nullable()->default(null);
			$table->boolean('eqfuncxfilm')->nullable()->default(null);
			$table->boolean('eqpubxfilm')->nullable()->default(null);
			$table->boolean('eqherexdig')->nullable()->default(null);
			$table->boolean('eqfuncxdig')->nullable()->default(null);
			$table->boolean('eqpubxdig')->nullable()->default(null);
			$table->boolean('eqherect')->nullable()->default(null);
			$table->boolean('eqfuncct')->nullable()->default(null);
			$table->boolean('eqpubct')->nullable()->default(null);
			$table->boolean('eqheremri')->nullable()->default(null);
			$table->boolean('eqfuncmri')->nullable()->default(null);
			$table->boolean('eqpubmri')->nullable()->default(null);
			$table->boolean('eqhereecg')->nullable()->default(null);
			$table->boolean('eqfuncecg')->nullable()->default(null);
			$table->boolean('eqpubecg')->nullable()->default(null);
			$table->boolean('eqhereaed')->nullable()->default(null);
			$table->boolean('eqfuncaed')->nullable()->default(null);
			$table->boolean('eqpubaed')->nullable()->default(null);
			$table->boolean('eqheredef')->nullable()->default(null);
			$table->boolean('eqfuncdef')->nullable()->default(null);
			$table->boolean('eqpubdef')->nullable()->default(null);
			$table->boolean('eqhereult')->nullable()->default(null);
			$table->boolean('eqfuncult')->nullable()->default(null);
			$table->boolean('eqpubult')->nullable()->default(null);
			$table->boolean('eqheredia')->nullable()->default(null);
			$table->boolean('eqfuncdia')->nullable()->default(null);
			$table->boolean('eqpubdia')->nullable()->default(null);
			$table->boolean('eqherecd4')->nullable()->default(null);
			$table->boolean('eqfunccd4')->nullable()->default(null);
			$table->boolean('eqpubcd4')->nullable()->default(null);
			$table->boolean('eqherepcr')->nullable()->default(null);
			$table->boolean('eqfuncpcr')->nullable()->default(null);
			$table->boolean('eqpubpcr')->nullable()->default(null);
			$table->boolean('eqhereanes')->nullable()->default(null);
			$table->boolean('eqfuncanes')->nullable()->default(null);
			$table->boolean('eqpubanes')->nullable()->default(null);
			$table->boolean('eqherehema')->nullable()->default(null);
			$table->boolean('eqfunchema')->nullable()->default(null);
			$table->boolean('eqpubhema')->nullable()->default(null);
			$table->boolean('eqhererapid')->nullable()->default(null);
			$table->boolean('eqfuncrapid')->nullable()->default(null);
			$table->boolean('eqpubrapid')->nullable()->default(null);
			$table->boolean('eqhereuri')->nullable()->default(null);
			$table->boolean('eqfuncuri')->nullable()->default(null);
			$table->boolean('eqpuburi')->nullable()->default(null);
			$table->boolean('eqhereglu')->nullable()->default(null);
			$table->boolean('eqfuncglu')->nullable()->default(null);
			$table->boolean('eqpubglu')->nullable()->default(null);
			$table->boolean('facinternet')->nullable()->default(null);
			$table->boolean('faccomp')->nullable()->default(null);
			$table->boolean('faccompbill')->nullable()->default(null);
			$table->boolean('faccompemr')->nullable()->default(null);
			$table->boolean('faccompregist')->nullable()->default(null);
			$table->boolean('faccompresearch')->nullable()->default(null);
			$table->boolean('faccompother')->nullable()->default(null);
			$table->string('faccompotherspec', 100)->nullable()->default(null);
		});

		Schema::create('service_availability_and_utilization', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->unsignedInteger('clinic_id')->nullable()->default(null);
			$table->foreign('clinic_id')->references('id')->on('clinic')->onDelete('cascade');
			$table->string('outpatient', 100)->nullable()->default(null);
			$table->boolean('inpatient')->nullable()->default(null);
			$table->string('inpatientadmin', 100)->nullable()->default(null);
			$table->boolean('pedcare')->nullable()->default(null);
			$table->boolean('rep')->nullable()->default(null);
			$table->boolean('ante')->nullable()->default(null);
			$table->boolean('labor')->nullable()->default(null);
			$table->boolean('hyper')->nullable()->default(null);
			$table->boolean('diab')->nullable()->default(null);
			$table->boolean('cancer')->nullable()->default(null);
			$table->string('cancerspec', 100)->nullable()->default(null);
			$table->boolean('cancertreat')->nullable()->default(null);
			$table->boolean('drug')->nullable()->default(null);
			$table->boolean('stidiag')->nullable()->default(null);
			$table->boolean('stitreat')->nullable()->default(null);
			$table->boolean('hct')->nullable()->default(null);
			$table->boolean('hivtest')->nullable()->default(null);
			$table->boolean('social')->nullable()->default(null);
			$table->boolean('comm')->nullable()->default(null);
			$table->boolean('hivout')->nullable()->default(null);
			$table->boolean('hivoutcsw')->nullable()->default(null);
			$table->boolean('hivoutmsm')->nullable()->default(null);
			$table->boolean('hivoutyouth')->nullable()->default(null);
			$table->boolean('hivoutprisoners')->nullable()->default(null);
			$table->string('hivoutother', 100)->nullable()->default(null);
			$table->boolean('condom')->nullable()->default(null);
			$table->boolean('nutri')->nullable()->default(null);
			$table->boolean('surgerylocal')->nullable()->default(null);
			$table->boolean('surgerygen')->nullable()->default(null);
			$table->boolean('oral')->nullable()->default(null);
			$table->boolean('specialty')->nullable()->default(null);
			$table->string('specialtyspec', 100)->nullable()->default(null);
			$table->boolean('request')->nullable()->default(null);
			$table->string('requestspec', 100)->nullable()->default(null);
			$table->boolean('specialtyvisit')->nullable()->default(null);
			$table->string('specialtyvisitspec', 100)->nullable()->default(null);
			$table->boolean('refer')->nullable()->default(null);
			$table->string('referfacility', 100)->nullable()->default(null);
			$table->string('referhow', 100)->nullable()->default(null);
			$table->string('referhowspec', 100)->nullable()->default(null);
			$table->boolean('referto')->nullable()->default(null);
			$table->string('refertohow', 100)->nullable()->default(null);
			$table->string('refertohowspec', 100)->nullable()->default(null);
		});

		Schema::create('hiv_aids_services', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->unsignedInteger('clinic_id')->nullable()->default(null);
			$table->foreign('clinic_id')->references('id')->on('clinic')->onDelete('cascade');
			$table->boolean('hcttrain')->nullable()->default(null);
			$table->string('hcttraintime', 100)->nullable()->default(null);
			$table->boolean('dentsignthrush')->nullable()->default(null);
			$table->boolean('dentsignhairy')->nullable()->default(null);
			$table->boolean('dentsignulcer')->nullable()->default(null);
			$table->boolean('dentsignperio')->nullable()->default(null);
			$table->boolean('dentsignkaposi')->nullable()->default(null);
			$table->boolean('actionsample')->nullable()->default(null);
			$table->boolean('actiontreat')->nullable()->default(null);
			$table->boolean('actionrefer')->nullable()->default(null);
			$table->string('actionreferwhere', 100)->nullable()->default(null);
			$table->boolean('actionother')->nullable()->default(null);
			$table->string('actionotherspec', 100)->nullable()->default(null);
			$table->boolean('hc')->nullable()->default(null);
			$table->integer('hcclients')->nullable()->default(null);
			$table->boolean('testing')->nullable()->default(null);
			$table->string('hivrefer', 100)->nullable()->default(null);
			$table->string('hivreferspec', 100)->nullable()->default(null);
			$table->integer('hivtestvisits')->nullable()->default(null);
			$table->boolean('rapidtest')->nullable()->default(null);
			$table->string('rapidtestspec', 100)->nullable()->default(null);
			$table->boolean('westernblot')->nullable()->default(null);
			$table->boolean('elisa')->nullable()->default(null);
			$table->boolean('blooddraw')->nullable()->default(null);
			$table->boolean('hivtreat')->nullable()->default(null);
			$table->integer('hivtreatvisits')->nullable()->default(null);
			$table->boolean('pmtct')->nullable()->default(null);
			$table->boolean('candidavail')->nullable()->default(null);
			$table->boolean('candidtest')->nullable()->default(null);
			$table->boolean('candidsample')->nullable()->default(null);
			$table->boolean('cytoavail')->nullable()->default(null);
			$table->boolean('cytotest')->nullable()->default(null);
			$table->boolean('cytosample')->nullable()->default(null);
			$table->boolean('herpesavail')->nullable()->default(null);
			$table->boolean('herpestest')->nullable()->default(null);
			$table->boolean('herpessample')->nullable()->default(null);
			$table->boolean('mycoavail')->nullable()->default(null);
			$table->boolean('mycotest')->nullable()->default(null);
			$table->boolean('mycosample')->nullable()->default(null);
			$table->boolean('pneumoavail')->nullable()->default(null);
			$table->boolean('pneumotest')->nullable()->default(null);
			$table->boolean('pneumosample')->nullable()->default(null);
			$table->boolean('toxavail')->nullable()->default(null);
			$table->boolean('toxtest')->nullable()->default(null);
			$table->boolean('toxsample')->nullable()->default(null);
			$table->boolean('tuberavail')->nullable()->default(null);
			$table->boolean('tubertest')->nullable()->default(null);
			$table->boolean('tubersample')->nullable()->default(null);
			$table->boolean('oitreat')->nullable()->default(null);
			$table->integer('oitreatvisits')->nullable()->default(null);
		});

		Schema::create('laboratory_and_pharmacy_services', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->unsignedInteger('clinic_id')->nullable()->default(null);
			$table->foreign('clinic_id')->references('id')->on('clinic')->onDelete('cascade');
			$table->integer('sample')->nullable()->default(null);
			$table->integer('analyzed')->nullable()->default(null);
			$table->boolean('coluri')->nullable()->default(null);
			$table->boolean('analuri')->nullable()->default(null);
			$table->boolean('colcbc')->nullable()->default(null);
			$table->boolean('analcbc')->nullable()->default(null);
			$table->boolean('colhbaic')->nullable()->default(null);
			$table->boolean('analhbaic')->nullable()->default(null);
			$table->boolean('colpcr')->nullable()->default(null);
			$table->boolean('analpcr')->nullable()->default(null);
			$table->boolean('colcd4')->nullable()->default(null);
			$table->boolean('analcd4')->nullable()->default(null);
			$table->boolean('collft')->nullable()->default(null);
			$table->boolean('anallft')->nullable()->default(null);
			$table->boolean('colsyph')->nullable()->default(null);
			$table->boolean('analsyph')->nullable()->default(null);
			$table->boolean('colgono')->nullable()->default(null);
			$table->boolean('analgono')->nullable()->default(null);
			$table->boolean('coldengue')->nullable()->default(null);
			$table->boolean('analdengue')->nullable()->default(null);
			$table->boolean('coltb')->nullable()->default(null);
			$table->boolean('analtb')->nullable()->default(null);
			$table->boolean('coltoxo')->nullable()->default(null);
			$table->boolean('analtoxo')->nullable()->default(null);
			$table->boolean('colcancer')->nullable()->default(null);
			$table->boolean('analcancer')->nullable()->default(null);
			$table->string('cancerspec', 100)->nullable()->default(null);
			$table->string('reagentstock', 100)->nullable()->default(null);
			$table->boolean('stockout')->nullable()->default(null);
			$table->string('reagentsout', 100)->nullable()->default(null);
			$table->string('diagout', 100)->nullable()->default(null);
			$table->boolean('prescription')->nullable()->default(null);
			$table->integer('prescriptionvisits')->nullable()->default(null);
			$table->boolean('availamox')->nullable()->default(null);
			$table->boolean('stockamox')->nullable()->default(null);
			$table->boolean('availmetro')->nullable()->default(null);
			$table->boolean('stockmetro')->nullable()->default(null);
			$table->boolean('availsalbu')->nullable()->default(null);
			$table->boolean('stocksalbu')->nullable()->default(null);
			$table->boolean('availgilb')->nullable()->default(null);
			$table->boolean('stockgilb')->nullable()->default(null);
			$table->boolean('availateno')->nullable()->default(null);
			$table->boolean('stockateno')->nullable()->default(null);
			$table->boolean('availsimva')->nullable()->default(null);
			$table->boolean('stocksimva')->nullable()->default(null);
			$table->boolean('availcap')->nullable()->default(null);
			$table->boolean('stockcap')->nullable()->default(null);
			$table->boolean('availome')->nullable()->default(null);
			$table->boolean('stockome')->nullable()->default(null);
			$table->boolean('availdic')->nullable()->default(null);
			$table->boolean('stockdic')->nullable()->default(null);
			$table->boolean('availpara')->nullable()->default(null);
			$table->boolean('stockpara')->nullable()->default(null);
			$table->boolean('availcotri')->nullable()->default(null);
			$table->boolean('stockcotri')->nullable()->default(null);
			$table->boolean('availpeni')->nullable()->default(null);
			$table->boolean('stockpeni')->nullable()->default(null);
			$table->boolean('availcipro')->nullable()->default(null);
			$table->boolean('stockcipro')->nullable()->default(null);
			$table->boolean('arv')->nullable()->default(null);
			$table->boolean('availazt')->nullable()->default(null);
			$table->boolean('stockazt')->nullable()->default(null);
			$table->boolean('avail3tc')->nullable()->default(null);
			$table->boolean('stock3tc')->nullable()->default(null);
			$table->boolean('availtdf')->nullable()->default(null);
			$table->boolean('stocktdf')->nullable()->default(null);
			$table->boolean('availftc')->nullable()->default(null);
			$table->boolean('stockftc')->nullable()->default(null);
			$table->boolean('availefv')->nullable()->default(null);
			$table->boolean('stockefv')->nullable()->default(null);
			$table->boolean('availatv')->nullable()->default(null);
			$table->boolean('stockatv')->nullable()->default(null);
			$table->boolean('availlpv')->nullable()->default(null);
			$table->boolean('stocklpv')->nullable()->default(null);
			$table->boolean('fill')->nullable()->default(null);
			$table->string('fillspecify', 100)->nullable()->default(null);
		});

		Schema::create('payment_for_health_services', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->unsignedInteger('clinic_id')->nullable()->default(null);
			$table->foreign('clinic_id')->references('id')->on('clinic')->onDelete('cascade');
			$table->boolean('fee')->nullable()->default(null);
			$table->boolean('sliding')->nullable()->default(null);
			$table->boolean('inkind')->nullable()->default(null);
			$table->boolean('install')->nullable()->default(null);
			$table->boolean('insurance')->nullable()->default(null);
			$table->boolean('other')->nullable()->default(null);
			$table->string('otherspec', 100)->nullable()->default(null);
			$table->boolean('other2')->nullable()->default(null);
			$table->string('other2spec', 100)->nullable()->default(null);
			$table->integer('privateperc')->nullable()->default(null);
		});

		Schema::create('health_records_and_reporting', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->unsignedInteger('clinic_id')->nullable()->default(null);
			$table->foreign('clinic_id')->references('id')->on('clinic')->onDelete('cascade');
			$table->boolean('healthstat')->nullable()->default(null);
			$table->boolean('reportsti')->nullable()->default(null);
			$table->string('recipsti', 100)->nullable()->default(null);
			$table->string('freqsti', 100)->nullable()->default(null);
			$table->string('freqspecsti', 100)->nullable()->default(null);
			$table->string('methodsti', 100)->nullable()->default(null);
			$table->string('methodspecsti', 100)->nullable()->default(null);
			$table->boolean('reporthiv')->nullable()->default(null);
			$table->string('reciphiv', 100)->nullable()->default(null);
			$table->string('freqhiv', 100)->nullable()->default(null);
			$table->string('freqspechiv', 100)->nullable()->default(null);
			$table->string('methodhiv', 100)->nullable()->default(null);
			$table->string('methodspechiv', 100)->nullable()->default(null);
			$table->string('reportnotedis', 100)->nullable()->default(null);
			$table->boolean('recipnotedis')->nullable()->default(null);
			$table->string('freqnotedis', 100)->nullable()->default(null);
			$table->string('freqspecnotedis', 100)->nullable()->default(null);
			$table->string('methodnotedis', 100)->nullable()->default(null);
			$table->string('methodspecnotedis', 100)->nullable()->default(null);
			$table->boolean('reporthealthstat')->nullable()->default(null);
			$table->string('reciphealthstat', 100)->nullable()->default(null);
			$table->string('freqhealthstat', 100)->nullable()->default(null);
			$table->string('freqspechealthstat', 100)->nullable()->default(null);
			$table->string('methodhealthstat', 100)->nullable()->default(null);
			$table->string('methodspechealthstat', 100)->nullable()->default(null);
			$table->boolean('reportother')->nullable()->default(null);
			$table->string('reportotherspec', 100)->nullable()->default(null);
			$table->string('recipother', 100)->nullable()->default(null);
			$table->string('freqother', 100)->nullable()->default(null);
			$table->string('freqspecother', 100)->nullable()->default(null);
			$table->string('methodother', 100)->nullable()->default(null);
			$table->string('methodspecother', 100)->nullable()->default(null);
			$table->string('reportpref', 100)->nullable()->default(null);
			$table->string('reportprefotherspec', 100)->nullable()->default(null);
			$table->boolean('mhealth')->nullable()->default(null);
			$table->string('additional_comments', 100)->nullable()->default(null);
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('proprietor_information');
		Schema::drop('facility_information');
		Schema::drop('staffing_and_equipment');
		Schema::drop('service_availability_and_utilization');
		Schema::drop('hiv_aids_services');
		Schema::drop('laboratory_and_pharmacy_services');
		Schema::drop('payment_for_health_services');
		Schema::drop('health_records_and_reporting');
		Schema::drop('clinic');
	}

}
