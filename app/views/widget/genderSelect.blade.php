<?php

// model
// field
// label

$options = array(
	"Male" => "Male",
	"Female" => "Female"
);

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
	'input' => Form::select($name, $options, $model->{$field}, array('class' => 'form-control', 'id' => $name)),
	'secondary' => $secondary,
	'tertiary' => $tertiary
)) }}
