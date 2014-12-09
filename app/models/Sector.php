<?php

class Sector extends \Eloquent {
	
	protected $guarded = array('id');
	public $timestamps = false;

  public function users()
  {
      return $this->belongsToMany('User');
  }

  public static function getList($include_blank = true)
  {

  	$list = self::orderBy('name')->get()->lists('name', 'id');

  	if($include_blank)
  	{
  		$list = [""=>""] + $list;
  	}

  	return $list;

  }
}