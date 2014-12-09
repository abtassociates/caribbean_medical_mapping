<?php

// model
// field
// label
// secondary

$name = "subtable[".get_class($model)."][{$field}]";

$attr = isset($attr) ? $attr : array();
$attr['class'] = 'form-control time';
$attr['id'] = $name;

$secondary = isset($secondary) && $secondary ? " secondary" : "";
$tertiary = isset($tertiary) && $tertiary ? " tertiary" : "";

$val = isset($model->{$field}) ?
				$model->{$field} :
				null;

$options = ["" => ""];
for($h = 0; $h<24; $h++){
	for($m = 0; $m < 60; $m+=15){
		$mt = $m<10 ? "0{$m}" : $m;
		$ht = $h<10 ? "0{$h}" : $h;
		$options["{$ht}:{$mt}:00"] = "{$ht}:{$mt}";
	}
}

?>

{{ View::make('widget.widgetWrapper', array(
	'for' => $name,
	'label' => $label,
	'input' => Form::select($name, $options, $model->{$field}, $attr),
	'secondary' => $secondary,
	'tertiary' => $tertiary
)) }}