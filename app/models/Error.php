<?php

class Error extends Model {

	protected $table = 'errors';
	protected $guarded = array('id');

  protected static $rules = [
    'facilityname' => 'required',
    'name' => 'required',
    'issue' => 'required',
    'email' => 'email'
  ];

	public function clinic()
  {
    return $this->belongsTo('Clinic');
  }

  public function resolvedBy()
  {
    return $this->belongsTo('User', 'resolved_by', 'id');
  }

  public function alertAdmins(){

    $facility = $this->clinic_id ?
                Clinic::find($this->clinic_id) :
                new Clinic;

    $data = [
      'facility_name' => $this->facilityname,
      'reporter_name' => $this->name,
      'reporter_email' => $this->email,
      'reporter_phone' => $this->phone,
      'issue' => $this->issue,
      'link' => URL::to("facilities/errors/{$this->id}")
    ];

    $subject = $this->clinic_id ?
               "Facility Error Reported: {$this->facilityname}" :
               "Facility Missing Reported";

    foreach(User::all() as $user){
      if($user->canEditFacility($facility)){
        if(Config::get('mail.send_emails')){
          Mail::send('emails.facilityError', $data, function($message) use ($user, $subject) {
            $message->to($user->email)->subject($subject);
          });
        }
      }
    }
  }

  public static function resolve($errors, $user_id){

    if($errors){
      foreach($errors as $error_id => $resolved){

        if($resolved){
          $error = self::find($error_id);
          $error->resolved_on = DB::raw('NOW()');
          $error->resolved_by = $user_id;
          $error->save();

        }
      }
    }

  }

  public static function getUnresolved($facility_id){

    $q = Error::select('*');
    $q->where('clinic_id', '=', $facility_id);
    $q->whereNull('resolved_by');
    $unresolved = $q->get();

    return $unresolved;
  }






}