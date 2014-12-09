<?php

// given an o
HTML::macro('deepVal', function($object, $props)
{
  if(is_string($props))
  {
      $props = array($props);
  }
  foreach($props as $prop)
  {
      $object = $object->{$prop};
  }
  return $object;
});


// just like normal select helper, but you can pass in a collection instead of
// aarray for options and selected Also it will automatically blank the first option
Form::macro('superSelect', function($name, $collection, $selected=null, $attributes=array())
{
	$options = array(''=>'');

	if(is_object($collection) && get_class($collection)=='Illuminate\Database\Eloquent\Collection'){

		if(
			$collection->isEmpty()){$collection = array();
		}else{
			$obj = $collection->first()->toArray();

			$field = 'id';

			foreach($obj as $key => $val){

				foreach(array('name', 'label', 'title') as $candidate){

					if($field == 'id' && strpos($key, $candidate) !== false){

						$field = $key;

					}
				}
			}

			$collection = $collection->lists($field, 'id');

		}

	}

	$options = $options + $collection;


	if(is_object($selected) && get_class($selected)=='Illuminate\Database\Eloquent\Collection'){

		$selected = $selected->lists('id');

	}

  $attributes = $attributes + array("id" => $name);

	return Form::select($name, $options, $selected, $attributes);

});



HTML::macro('time', function($time_string)
{
    if(!$time_string){return $time_string;}
    else{
        return date('G:i', strtotime($time_string));
    }
});


HTML::macro('date', function($date_string)
{
    if(!$date_string){return $date_string;}
    else{
        return date('Y-m-d', strtotime($date_string));
    }
});

HTML::macro('nl2comma', function($string)
{
    $array = explode("\n", $string);
    $array = array_map('trim', $array);
    $string = implode(", ", $array);
    return $string;
});

HTML::macro('boolToYesNo', function($bool)
{
    $response = "&nbsp;";
    if($bool === "1" || $bool === 1 || $bool === true || strtolower($bool)==="yes"){
        $response = "Yes";
    }
    if($bool === "0" || $bool === 0 || $bool === false || strtolower($bool)==="no"){
        $response = "No";
    }
    return $response;
});

HTML::macro('formatPhone', function($phone){

    $phone = trim($phone);

    if(strlen($phone)==10 && ctype_digit($phone)){
        $phone = substr($phone, 0, 3)."-".substr($phone, 3, 3)."-".substr($phone,6);
    }

    return $phone;
});