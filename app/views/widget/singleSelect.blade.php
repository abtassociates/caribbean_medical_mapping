<?php

// model
// field
// label
// options

$new_options = array(''=>'');
if(isset($retain_options) && $retain_options){
	foreach($options as $id=>$option){
		$new_options[$id] = $option;
	}
}else{
	foreach($options as $option){
		$new_options[$option] = $option;
	}
}

$name = "subtable[".get_class($model)."][{$field}]";

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
	'input' => Form::select($name, $new_options, $val, array('id' => $name, 'class' => 'form-control')),
	'secondary' => $secondary,
	'tertiary' => $tertiary,
	'addClass' => $addClass,
	'popContent' => $popContent
)) }}