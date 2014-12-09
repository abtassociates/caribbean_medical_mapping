<?php

$id = isset($id) ? $id : "";

$secondary = isset($secondary) && $secondary ? " secondary" : "";
$tertiary = isset($tertiary) && $tertiary ? " tertiary" : "";
$addClass = isset($addClass) ? $addClass : ""; 
$popContent = isset($popContent) ? $popContent: "";
?>


<div class="form-group">
  @if($text != '')
   <label class="col-sm-12 control-label control-title {{ $secondary }} {{ $tertiary }}"><strong> {{ $label }} </strong></label>
  <div class="col-sm-12">
    <span id="{{ $id }}"> {{ $text }} </span>
  </div>
  @elseif($popContent != '')
  	<label class="col-sm-12 control-label control-title {{ $secondary }} {{ $tertiary }}"><span id="{{ $id }}" class="{{ $addClass }}" data-toggle="popover" data-placement="right" data-content="{{ $popContent }}"><strong> {{ $label }} <i class="icon-info-sign"></i></strong></span></label>
  @else
    <label class="col-sm-12 control-label control-title {{ $secondary }} {{ $tertiary }}"><span id="{{ $id }}"><strong> {{ $label }} </strong></span></label>
  @endif
</div>