<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
//use Illuminate\Foundation\Auth\ThrottlesLogins;

use Cartalyst\Sentinel\Checkpoints\NotActivatedException;
//use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use Sentinel;
use Illuminate\Http\Request;
use Activation;
use Redirect;
use Session;
use Illuminate\Support\Facades\Input;
use Mail;
use Carbon\Carbon;
use Mailchimp;
use App\ZipCode;
use DB;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

  // use  ThrottlesLogins;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function showLoginForm()
    {
        return view('auth.login');
    }

    protected function login(Request $request)
    {

        try {

            // Validation
            $validation = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required'
            ]);

            if ($validation->fails()) {
              Session::flash('alert-warning', 'Username or password not match');
                return Redirect::back()->withErrors($validation)->withInput();
            }
            $remember = (Input::get('remember') == 'on') ? true : false;
            if ($user = Sentinel::authenticate($request->all(), $remember)) {
                $permissions = $user->roles()->first()->permissions;

                //log in log

            //insert into activity_log
                /*
    DB::table('activity_log')->insert(
              ['log_name' => 'default'
              ,'description' => ''.$user->first_name.' '.$user->last_name.' is login succesfully'
              ,'subject_id' => ''.$user->sbu_id.''
              ,'subject_type' => 'App\Login'
              ,'causer_id' => ''.$user->id.''
              ,'causer_type' => 'App\User'
              ,'created_at' => 'date('Y-m-d H:i:s')'
              ,'updated_at' => date('Y-m-d H:i:s')
              ]);
              */
              // return $permissions;

              
                return redirect('/dashboard');

            }
            Session::flash('alert-warning', 'Invalid password or this user does not exist');
            return Redirect::back()->withErrors(['global' => 'Invalid password or this user does not exist' ]);

        } catch (NotActivatedException $e) {

            Session::flash('alert-warning', 'This user is not activated');
            return Redirect::back()->withErrors(['global' => 'This user is not activated','activate_contact'=>3]);

        }/*
        catch (ThrottlingException $e) {
            $delay = $e->getDelay();
            return Redirect::back()->withErrors(['global' => 'You are temporary susspended' .' '. $delay .' seconds','activate_contact'=>1]);
        }*/
        Session::flash('alert-warning', 'Login problem please contact the administrator');
        return Redirect::back()->withErrors(['global' => 'Login problem please contact the administrator']);


    }


    protected function logout()
    {
        Sentinel::logout();
        return redirect('/login');
    }
    protected function activate($id){
        $user = Sentinel::findById($id);

        $activation = Activation::create($user);
        $activation = Activation::complete($user, $activation->code);
        Session::flash('message', trans('messages.activation'));
        Session::flash('status', 'success');
        return redirect('login');
    }

}
