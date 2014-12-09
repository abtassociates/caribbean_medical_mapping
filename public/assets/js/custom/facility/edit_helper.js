var edit_helper = (function($){

	var module = {};

	// ------------------------------------------------------------------ //

	module.showWidgetsMultiConditional = function(table, servantFields, defaultVisible, rules){

		var matchFound = module.checkMatchMulti(table, rules);

		var visible = (defaultVisible && !matchFound) || (!defaultVisible && matchFound);

		module.showHideWidgetsMulti(table, servantFields, visible);
	}

	// ------------------------------------------------------------------ //

	// Set the visibility of a set of widgets by table and field list
	module.showHideWidgetsMulti = function(table, fields, visible){
		if(typeof fields == "string"){fields = [fields];}

		for(var i = 0; i<fields.length; i++){
			var $input = module.getInputByTableAndField(table, fields[i]);
			module.showHideWidget($input, visible);
		}
	}

	// ------------------------------------------------------------------ //

	// check whether a particular rule is matched
	module.checkMatch = function(table, field, matchValues){
		var $input = module.getInputByTableAndField(table, field);
		var value = $input.val();
		if(typeof matchValues == "string"){matchValues = [matchValues];}

		//following doesn't work in IE 8
		//var matchFound = (matchValues.indexOf(value) > -1);
		var matchFound = $.inArray(value, matchValues) > -1;

		return matchFound;
	}

	// ------------------------------------------------------------------ //

	// check whether a SET of rules is matched
	module.checkMatchMulti = function(table, rules){

		var match = true;
		for(var i=0; i<rules.length; i++){
			var rule = rules[i];
			var thisMatch = module.checkMatch(table, rule.masterField, rule.matchValues);
			match = match && thisMatch;
		}
		return match;
	}

	// ------------------------------------------------------------------ //

	// Retrieve a jQuery node of a widget by table and field name
	// no worrying about escaping brackets or the '#' character
	module.getInputByTableAndField = function(tablename, fieldname){
		var inputId = "subtable["+tablename+"]["+fieldname+"]";
		var $input = $(document.getElementById(inputId));
		return $input;
	}

	// ------------------------------------------------------------------ //

	// hide an entire widget by its input node
	module.showHideWidget = function($input, visible){
		if(visible){
			$input.closest(".form-group").show();
		}
		else{
			$input.closest(".form-group").hide();
		}
	}

	// hide an entire widget by its outer wrapper for labels
	module.showHideLabel = function($input, visible){
		if(visible){
			$input.closest(".group-wrapper").show();
		}
		else{
			$input.closest(".group-wrapper").hide();
		}
	}

	// ------------------------------------------------------------------ //
	// set both the initial and onChange visibility for servant widgets
	// Iff all rules are met, the widget's visibility is set opposite its default
	//
  // tableName: portion of widget input ids inside first square brackets
  // servantFields: a string (or array of strings) matching the portion of widget input
  //                id inside second set of square brackets
  // defaultVisible: the default state of the servant element(s) (1=visible, 0=hidden)
  // rules: an array of objects each including a masterField and values to match
  //        against. The rules are only collectively met if all masterFields have
  //        a value equal to one of the associated matchValues. Example below
  //				[{masterField: somefield, matchValues: ['a', 'b', 'c']}, {masterField: otherfield, matchValues: ['bah']}]

	module.setVisibilityMultiRule = function(table, servantFields, defaultVisible, rules){

		// create specific function by wrapping the general visibility function
		var specificShowFunction = function(){
			module.showWidgetsMultiConditional(table, servantFields, defaultVisible, rules);
		}

		for(var i=0; i<rules.length; i++){
			var rule = rules[i];
			var $masterInput = module.getInputByTableAndField(table, rule.masterField);
			$masterInput.change(specificShowFunction);
		}

		specificShowFunction();
	}

	// ------------------------------------------------------------------ //
	// special case of set visibility rule for when there is only one masterField

	module.setVisibilityRule = function(tableName, masterField, servantFields, defaultVisible, matchValues){

		module.setVisibilityMultiRule(
			tableName,
			servantFields,
			defaultVisible,
			[{masterField: masterField, matchValues: matchValues}]
		);

	}




	// ------------------------------------------------------------------ //

	// send back the object
	return module;


})(jQuery);
