<?php


$name = "subtable[".get_class($model)."][{$field}]";
$attr['id'] = $name;
$secondary = isset($secondary) && $secondary ? " secondary" : "";
$tertiary = isset($tertiary) && $tertiary ? " tertiary" : "";
$addClass = isset($addClass) ? $addClass: "";
$popContent = isset($popContent) ? $popContent: "";

$val = isset($model->{$field}) ?
				$model->{$field} :
				null;

?>

{{ View::make('widget.widgetWrapper', array(
	'for' => $name,
	'label' => $label,
	'input' => Form::checkbox($name, 1, $val==1, $attr),
	'secondary' => $secondary,
	'tertiary' => $tertiary,
	'addClass' => $addClass,
	'popContent' => $popContent
)) }}