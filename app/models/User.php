<?php

use Zizaco\Confide\ConfideUser;
use Zizaco\Confide\Confide;
use Zizaco\Confide\ConfideEloquentRepository;
use Zizaco\Entrust\HasRole;
use Robbo\Presenter\PresentableInterface;
use Carbon\Carbon;

class User extends ConfideUser implements PresentableInterface {
    use HasRole;

    protected $softDelete = true;

    public static $rules = array(
        'first_name' => 'required',
        'last_name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'min:8|confirmed',
        'password_confirmation' => 'min:8'
    );

    protected $updateRules = array(
        'first_name' => 'required',
        'last_name' => 'required',
        'email' => 'required|email',
        'password' => 'min:8|confirmed',
        'password_confirmation' => 'min:8'
    );

    protected $sector_ids = null;

    public function isValid($rules){

        $rules = $rules + array('sector_ids_' => 'required_if:role_id,2');

        $validation = Validator::make($this->toArray(), $rules);

        if($validation->fails())
        {
            $this->errors()->merge($validation->messages());
        }

        return !$validation->fails();
    }

    public function getAllowedSectorsList()
    {
        // if general permission
        if($this->can('edit_all_facilities'))
        {
            $list = Sector::getList();
        }
        else
        {
            $list = $this->sectors
                    ->sortBy(function($sector){return $sector->name;})
                    ->lists('name', 'id');
        }

        return $list;

    }

    public function saveTop( array $rules = array(), array $customMessages = array(), array $options = array(), \Closure $beforeSave = null, \Closure $afterSave = null )
    {

        if($this->isValid(static::$rules))
        {
            // remove role_id
            $role_id = $this->role_id;
            unset($this->role_id);

            // remove sector ids
            $sector_ids_ = $this->sector_ids_ ?
                           $this->sector_ids_ :
                           array();

            unset($this->sector_ids_);

            parent::save();

            if(!$this->errors()->count())
            {
                // save role change
                $this->saveRoles(array($role_id));

                // add on any related sectors
                $this->sectors()->sync($sector_ids_);
            }
        }

    }

    public function amendTop( array $rules = array(), array $customMessages = array(), array $options = array(), \Closure $beforeSave = null, \Closure $afterSave = null )
    {
        $response = null;
        if($this->isValid($this->updateRules))
        {
            // remove role_id
            $role_id = $this->role_id;
            unset($this->role_id);

            // remove sector ids
            $sector_ids_ = $this->sector_ids_;
            unset($this->sector_ids_);

            $this->restore();
            $response = parent::amend($this->updateRules);

            if(!$this->errors()->count())
            {
                if($role_id){
                    // save role change
                    $this->saveRoles(array($role_id));
                }

                if($sector_ids_){
                    // add on any related clinics
                    $this->sectors()->sync($sector_ids_);
                }
            }
        }
        return $response;
    }


    public function getSectorIds()
    {
        if(is_null($this->sector_ids))
        {
            $this->sector_ids = $this->sectors->lists('id');
        }
        return $this->sector_ids;
    }

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

    public function getPresenter()
    {
        return new UserPresenter($this);
    }

    public function sectors()
    {
        return $this->belongsToMany('Sector');
    }

    public function fullName()
    {
        $full_name = $this->first_name." ".$this->last_name;
        return $full_name;
    }

    /**
     * Get user by email
     * @param $email
     * @return mixed
     */
    public function getUserByEmail( $email )
    {
        return $this->where('email', '=', $email)->first();
    }


    public function canEditFacility($facility)
    {
        return $this->checkFactilityPermission($facility, 'edit_all_facilities');
    }


    public function canDeleteFacility($facility)
    {
        return $this->checkFactilityPermission($facility, 'delete_all_facilities');
    }


    private function checkFactilityPermission($facility, $permission)
    {
        // first of all, if they have general permission...
        if($this->can($permission))
        {
            return true;
        }

        // if they are attached to that sector
        if(in_array($facility->sector_id, $this->getSectorIds()))
        {
            return true;
        }

        // otherwise deny them
        return false;
    }

    /**
     * Get the date the user was created.
     *
     * @return string
     */
    public function joined()
    {
        return String::date(Carbon::createFromFormat('Y-n-j G:i:s', $this->created_at));
    }

    /**
     * Save roles inputted from multiselect
     * @param $inputRoles
     */
    public function saveRoles($inputRoles)
    {
        if(! empty($inputRoles)) {
            $this->roles()->sync($inputRoles);
        } else {
            $this->roles()->detach();
        }
    }


    /**
     * Returns user's current role ids only.
     * @return array|bool
     */
    public function currentRoleIds()
    {
        $roles = $this->roles;
        $roleIds = false;
        if( !empty( $roles ) ) {
            $roleIds = array();
            foreach( $roles as &$role )
            {
                $roleIds[] = $role->id;
            }
        }
        return $roleIds;
    }

    public function getRoleId()
    {
        $role_ids = $this->currentRoleIds();

        $id = count($role_ids) ? $role_ids[0] : null;

        return $id;
    }

    public function currentRoleList()
    {
        $role_ids = $this->currentRoleIds();

        $array = array();

        foreach($role_ids as $id){
            $role = Role::find($id);
            $array[] = $role['name'];
        }

        $list = implode(", ", $array);

        return $list;
    }

    /**
     * Redirect after auth.
     * If ifValid is set to true it will redirect a logged in user.
     * @param $redirect
     * @param bool $ifValid
     * @return mixed
     */
    public static function checkAuthAndRedirect($redirect, $ifValid=false)
    {
        // Get the user information
        $user = Auth::user();
        $redirectTo = false;

        if(empty($user->id) && ! $ifValid) // Not logged in redirect, set session.
        {
            Session::put('loginRedirect', $redirect);
            $redirectTo = Redirect::to('user/login');
        }
        elseif(!empty($user->id) && $ifValid) // Valid user, we want to redirect.
        {
            $redirectTo = Redirect::to($redirect);
        }

        return array($user, $redirectTo);
    }

    public function currentUser()
    {
        return (new Confide(new ConfideEloquentRepository()))->user();
    }



}
