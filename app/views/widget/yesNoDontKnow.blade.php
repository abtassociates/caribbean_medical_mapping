<?php

// model
// field
// label
// options

$options = array(
	1 => "Yes",
	0 => "No",
	"" => "Don't Know"
);

$val = isset($model->{$field}) ?
				$model->{$field} :
				null;

if($val===0 || $val==="0" || strtolower($val)==="no"){$val = 0;}
if($val===1 || $val==="1" || strtolower($val)==="yes"){$val = 1;}

$name = "subtable[".get_class($model)."][{$field}]";

$secondary = isset($secondary) && $secondary ? " secondary" : "";
$tertiary = isset($tertiary) && $tertiary ? " tertiary" : "";

?>

{{ View::make('widget.widgetWrapper', array(
	'for' => $name,
	'label' => $label,
	'input' => Form::select($name, $options, $val, array('id' => $name, 'class' => 'form-control')),
	'secondary' => $secondary,
	'tertiary' => $tertiary
)) }}