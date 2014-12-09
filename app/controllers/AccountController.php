<?php

class AccountController extends BaseController {

    /**
     * User Model
     * @var User
     */
    protected $user;

    /**
     * Inject the models.
     * @param User $user
     */
    public function __construct(User $user)
    {
        parent::__construct();
        $this->user = $user;
    }

    /**
     * Users settings page
     *
     * @return View
     */
    public function getIndex()
    {
        $user = Auth::user();
        return View::make('account/index')
                ->with('user', $user);
    }

    /**
     * Stores new user
     *
     */
    public function postIndex()
    {
        $user = Auth::user();

        $user->first_name = Input::get( 'first_name' );
        $user->last_name = Input::get( 'last_name' );
        $user->email = Input::get( 'email' );

        $password = Input::get( 'password' );
        $password_confirmation = Input::get( 'password_confirmation' );


        if(!empty($password)) {
            if($password === $password_confirmation) {
                $user->password = $password;
                // The password confirmation will be removed from model
                // before saving. This field will be used in Ardent's
                // auto validation.
                $user->password_confirmation = $password_confirmation;
            } else {
                // Redirect to the new user page
                return Redirect::to('account')->withErrors([['Passwords do not match']]);
            }
        } else {
            unset($user->password);
            unset($user->password_confirmation);
        }

        if(!empty($password) && $password === $password_confirmation) {
            $user->password = $password;
            $user->password_confirmation = $password_confirmation;
        }

        if($user->amend())
        {
            return Redirect::to('account')->with( 'message', 'Save successful' );
        }

        return Redirect::back()
                ->withInput(Input::except('password','password_confirmation'))
                ->withErrors($user->errors()->all());
    }



    /**
     * Displays the login form
     *
     */
    public function getLogin()
    {
        $user = Auth::user();
        if(!empty($user->id)){
            return Redirect::to('/');
        }

        return View::make('account/login');
    }

    /**
     * Attempt to do login
     *
     */
    public function postLogin()
    {
        $input = array(
            'email'    => Input::get( 'email' ),
            'password' => Input::get( 'password' ),
            'remember' => Input::get( 'remember' ),
        );

        // If you wish to only allow login from confirmed users, call logAttempt
        // with the second parameter as true.
        // Check that the user is confirmed.
        if ( Confide::logAttempt( $input, true ) )
        {
            $r = Session::get('loginRedirect');
            if (!empty($r))
            {
                Session::forget('loginRedirect');
                return Redirect::to($r);
            }
            return Redirect::to('/');
        }
        else
        {
            // Check if there was too many login attempts
            if ( Confide::isThrottled( $input ) ) {
                $err_msg = Lang::get('confide::confide.alerts.too_many_attempts');
            } elseif ( $this->user->checkUserExists( $input ) && ! $this->user->isConfirmed( $input ) ) {
                $err_msg = Lang::get('confide::confide.alerts.not_confirmed');
            } else {
                $err_msg = Lang::get('confide::confide.alerts.wrong_credentials');
            }

            return Redirect::to('/login')
                ->withInput(Input::except('password'))
                ->with( 'error', $err_msg );
        }
    }


    /**
     * Displays the forgot password form
     *
     */
    public function getForgot()
    {
        return View::make('account/forgot');
    }

    /**
     * Attempt to reset password with given email
     *
     */
    public function postForgot()
    {
        if( Confide::forgotPassword( Input::get( 'email' ), Instance::get() ) )
        {
            return Redirect::to('account/login')
                ->with( 'notice', Lang::get('confide::confide.alerts.password_forgot') );
        }
        else
        {
            return Redirect::to('account/forgot')
                ->withInput()
                ->with( 'error', Lang::get('confide::confide.alerts.wrong_password_forgot') );
        }
    }

    public function getConfirm( $confirmation_code )
    {
        if($user = User::where('confirmation_code', '=', $confirmation_code)->get()->first())
        {
            return View::make('account/confirm')
                ->with('token', $confirmation_code);
        }

        else{
            Session::put( 'error', 'This link is out of date' );
            return View::make('account/confirm')
                ->with('token', $confirmation_code);
        }

    }


    public function postConfirm( $confirmation_code )
    {

        if ( Confide::confirm( $confirmation_code ) )
        {
            // update password
            $user = User::where('confirmation_code', '=', $confirmation_code)->get()->first();
            $user->password = Input::get('password');
            $user->password_confirmation = Input::get('password_confirmation');
            $user->amend();

            if($user->amend())
            {
                $user->confirmation_code = "";
                $user->amend();
                return Redirect::to('login')
                    ->with( 'notice', 'Account confirmation successful. Please log in.' );
            }

            else
            {
                return Redirect::back()
                    ->with( 'error', 'Passwords must be at least 8 characters and match confirmation.' );
            }
        }
        else
        {
            return Redirect::back()
                ->with( 'error', 'This link is out of date' );
        }
    }

    /**
     * Shows the change password form with the given token
     *
     */
    public function getReset( $token )
    {

        return View::make('account/reset')
            ->with('token',$token);
    }


    /**
     * Attempt change password of the user
     *
     */
    public function postReset($token)
    {
        $input = array(
            'token'=>$token,
            'password'=>Input::get( 'password' ),
            'password_confirmation'=>Input::get( 'password_confirmation' ),
        );

        // By passing an array with the token, password and confirmation
        if( Confide::resetPassword( $input ) )
        {
            return Redirect::to('login')
            ->with( 'notice', Lang::get('confide::confide.alerts.password_reset') );
        }
        else
        {
            return Redirect::to('reset/'.$input['token'])
                ->withInput()
                ->with( 'error', Lang::get('confide::confide.alerts.wrong_password_reset') );
        }
    }

    /**
     * Log the user out of the application.
     *
     */
    public function logout()
    {
        Confide::logout();

        return Redirect::to('/');
    }
}