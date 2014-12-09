<?php

class Instance extends Model {


	protected $table = 'instance';
	protected $guarded = array('id');
	protected $logo_directory = "/assets/img/custom_logo";
	public $timestamps = false;

	protected static $rules = [
	    'facility_term' => 'required|lower_case|singular|max:20',
	    'country' => 'required',
	    'main_color' => 'hexcolor',
	    'accent_color' => 'hexcolor',
	    'logo' => 'mimes:jpeg,bmp,png|max:300',
	    'meta_description' => 'required|max:160'
  	];

  	public function getVersion(){
  		exec('git describe', $tag_and_hash_array);
  		$tag_and_hash = $tag_and_hash_array[0];
  		$dash_position = strpos($tag_and_hash , "-");
  		if($dash_position !== false){
  			$tag = substr($tag_and_hash, 0, $dash_position);
  		}else{
  			$tag = $tag_and_hash;
  		}

  		exec('git rev-parse --abbrev-ref HEAD', $branch_array);
  		$branch = $branch_array[0];

  		if(substr($branch, 0, 7) == "release"){
  			$tag = "rc" . substr($branch, 8);
  		}

  		return $tag;
  	}


	public static function get()
	{
		$instance = Instance::firstOrFail();
		return $instance;
	}

	public function getDefaultMapData(){
		$map_data = array(
			"lat" => floatval($this->map_lat),
			"lng" => floatval($this->map_lng),
			"distance_x" => floatval($this->map_distance_x),
			"distance_y" => floatval($this->map_distance_y)
		);
		return $map_data;
	}


	public function update(array $attributes = Array())
	{
		$set_object = $attributes;
		unset($set_object['logo']);
		unset($this->logo);

		// if a general update passes the filters...
		if($response=parent::update($set_object))
		{
			// if we're sending in a new logo...
			if (array_key_exists('logo', $attributes) && $attributes['logo'])
			{
				// save it to file
				$this->replace_logo_file($attributes['logo']);
			}
		}
		return $response;
	}


	private function replace_logo_file($logo)
	{
		// delete anything else in the logo directory
		foreach(scandir($this->get_logo_directory()) as $file){
		  if(is_file($full_path = $this->get_logo_directory()."/".$file))
		  {
		  	// (except dot files)
		  	if($file{0} != ".")
		  	{
		  		unlink($full_path); // delete file
		  	}
		  }
		}

		// add in the new logo
		$logo->move(
	  	$this->get_logo_directory(),
	  	$logo->getClientOriginalName()
	  );
	}


	public function getLogoPath()
	{
		$logo_path = null;
		// see if there's a custom logo uploaded
		foreach(scandir($this->get_logo_directory()) as $file){
		  if(is_file($this->get_logo_directory()."/".$file) && $file{0}!=".")
		  {
		    $logo_path = $this->logo_directory."/".$file;
		  }
		}
		// if no custom logo exists, attach the sample one
		if(!$logo_path)
		{
			$logo_path = "/assets/img/logo_place_holder.png";
		}
		return $logo_path;
	}


	public function getDomain()
	{
		$url = Config::get('local/app.url');
		$url = str_replace("http://", "", $url);
		$url = str_replace("https://", "", $url);
		return $url;
	}


	private function get_logo_directory()
	{
		return public_path().$this->logo_directory;
	}

}