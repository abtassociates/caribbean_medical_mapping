<?php $addClass = isset($addClass) ? $addClass : ""; 
$popContent = isset($popContent) ? $popContent: ""; ?>

<div class="form-group">
  <label for="{{ $for }}" class="col-sm-3 control-label {{ $addClass }} {{ $secondary }} {{ $tertiary }}" data-toggle="popover" data-placement="right" data-content="{{ $popContent }}">{{ $label }}</label>
  <div class="col-sm-9">
    {{ $input }}
  </div>
</div>