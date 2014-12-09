<?php

// model
// field
// label
// options

$new_options = array(''=>'');
foreach($options as $option){
	$new_options[$option] = $option;
}

$name = "subtable[".get_class($model)."][{$field}]";

$secondary = isset($secondary) && $secondary ? " secondary" : "";
$tertiary = isset($tertiary) && $tertiary ? " tertiary" : "";

$val = isset($model->{$field}) ?
				$model->{$field} :
				null;

?>

{{ View::make('widget.widgetWrapper', array(
	'for' => $name,
	'label' => $label,
	'input' => Form::select($name, $new_options, $model->{$field}, array('id' => $name, 'class' => 'form-control', 'multiple' => 'multiple')),
	'secondary' => $secondary,
	'tertiary' => $tertiary
)) }}