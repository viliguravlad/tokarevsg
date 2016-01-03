<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use Input;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;
use Illuminate\Auth\Guard;
use App\Models\ActivityLog as ActivityLog;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers;

    //protected $redirectAfterLogout = '/auth/login';
    //protected $redirectTo = '/home';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'password' => 'required',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function postLogin(Request $request)
    {
  
        if ($this->auth->attempt($request->only('name', 'password')))
        {
            /*
            |
            | Putting activity into log
            |
            */
            $activityToLog = new ActivityLog;
            $activityToLog->activity = "User logged in! Login: " . \Auth::user()->name;
            $activityToLog->user = \Auth::user()->name;
            $activityToLog->save();
            
            return redirect('home');
        }

        /*
        |
        | Putting activity into log
        |
        */
        $activityToLogFail = new ActivityLog;
        $activityToLogFail->activity = "User not logged in! Login: " . implode(Input::only('name'));
        $activityToLogFail->save();

        return redirect('auth/login')->withErrors([
            'name' => 'Данные, введенные Вами не соответствуют нашим записям. Попробуйте еще раз?',
        ]);
    }
}
