<?php

class UsersController extends BaseController {

    public function __construct()
    {
        parent::__construct();
        $this->beforeFilter('allowed:alter_settings');
        $this->addCrumb('Users', '/users');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return View::make('users/index')
            ->with('users', User::all());
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $this->addCrumb('Create', '#');
        return View::make('users/create_edit')
            ->with('roles', Role::getArray())
            ->with('sectors', Sector::orderBy('name')->get())
            ->with('clinics', Clinic::orderBy('facilityname')->get());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        // find out if user already exists but is trashed
        if($user = User::onlyTrashed()->where('email', Input::get('email'))->first()){
            $task = "amend";
        }else{
            $user = new User();
            $task = "save";
        }

        $user->email = Input::get('email');
        $user->first_name = Input::get('first_name');
        $user->last_name = Input::get('last_name');
        $user->role_id = Input::get('role_id');
        $user->sector_ids_ = Input::get('sector_ids_');

        if($task == "save"){
            $user->saveTop();  
        }else{
            $user->amendTop();
            Confide::forgotPassword($user->email);
        }

        if($user->errors()->count())
        {
            return Redirect::back()->withInput()->withErrors($user->errors());
            
        }
        else{
            // send them back to list with message
            return Redirect::to('users')
                ->with('message', 'User Created. An account setup link has been sent.');
        }

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {

        $this->addCrumb('Edit', '#');
        return View::make('users/create_edit')
            ->with('user', User::find($id))
            ->with('roles', Role::getArray())
            ->with('sectors', Sector::orderBy('name')->get())
            ->with('clinics', Clinic::orderBy('facilityname')->get());
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        // save user properties
        $user = User::find($id);
        $user->email = Input::get('email');
        $user->first_name = Input::get('first_name');
        $user->last_name = Input::get('last_name');
        $user->role_id = Input::get('role_id');
        $user->sector_ids_ = Input::get('sector_ids_');
        $user->amendTop();

        if(!$user->errors()->count())
        {
            // send them back to list with message
            return Redirect::to('users')
                ->with('message', 'User Updated.');
        }
        else{
            return Redirect::back()->withInput()->withErrors($user->errors());
        }

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $user = User::destroy($id);

        return Redirect::to('users')->with('message', 'User Deleted');
    }


}