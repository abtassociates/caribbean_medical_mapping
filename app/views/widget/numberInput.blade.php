<?php

// model
// field
// label


$name = "subtable[".get_class($model)."][{$field}]";

$attr = isset($attr) ? $attr : array();
$attr['class'] = 'form-control number';
$attr['id'] = $name;

$secondary = isset($secondary) && $secondary ? " secondary" : "";
$tertiary = isset($tertiary) && $tertiary ? " tertiary" : "";

$val = isset($model->{$field}) ?
				$model->{$field} :
				null;

$options = array(""=>"")+range(0, 100);

?>

{{ View::make('widget.widgetWrapper', array(
	'for' => $name,
	'label' => $label,
	'input' => Form::text($name, $model->{$field}, $attr),
	'secondary' => $secondary,
	'tertiary' => $tertiary
)) }}