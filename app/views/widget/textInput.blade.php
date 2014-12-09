<?php

// model
// field
// label
// secondary

$name = "subtable[".get_class($model)."][{$field}]";

$attr = isset($attr) ? $attr : array();
$attr['class'] = 'form-control';
$attr['id'] = $name;

$secondary = isset($secondary) && $secondary ? " secondary" : "";
$tertiary = isset($tertiary) && $tertiary ? " tertiary" : "";
$addClass = isset($addClass) ? $addClass : ""; 
$popContent = isset($popContent) ? $popContent: "";

$val = isset($model->{$field}) ?
				$model->{$field} :
				null;

?>

{{ View::make('widget.widgetWrapper', array(
	'for' => $name,
	'label' => $label,
	'input' => Form::text($name, $model->{$field}, $attr),
	'secondary' => $secondary,
	'tertiary' => $tertiary,
	'addClass' => $addClass,
	'popContent' => $popContent
)) }}