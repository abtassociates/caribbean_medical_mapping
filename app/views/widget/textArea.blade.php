<?php

// model
// field
// label

$name = "subtable[".get_class($model)."][{$field}]";

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
	'input' => Form::textarea($name, $model->{$field}, array('id' => $name, 'class' => 'form-control', 'size' => '0x0')),
	'secondary' => $secondary,
	'tertiary' => $tertiary,
	'addClass' => $addClass,
	'popContent' => $popContent
)) }}