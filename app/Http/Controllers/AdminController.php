<?php

namespace App\Http\Controllers;

use Input;
use App\User;
use Validator;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\ActivityLog as ActivityLog;

class AdminController extends Controller
{

    public function getLog() {
        if(\Auth::guest())
        {
            return redirect('auth/login');
        }

        $activities = ActivityLog::all();
        return view('admin/log')->with('activities', $activities);
    }

    public function getUsers() {
        $users = User::all();
        return view('admin/users')->with('users', $users); 
    }

    public function getRegister() {
        if(\Auth::guest())
        {
            return redirect('auth/login');
        }

        return view('admin/register');
    }

    public function postRegister() {
        $input['name'] = implode(Input::only('name'));
        $input['password'] = implode(Input::only('password'));
        $input['password_confirmation'] = implode(Input::only('password_confirmation'));
        
        $rules = array('name' => 'unique:users,name,required',
                       'password' => 'required',
                      );

        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            return redirect('admin/register')->withErrors([
                'Вы не ввели ничего в поле для имени, либо пользователь с таким именем уже существует!'
            ]);
        }
        else 
        {        
            if($input['password'] === $input['password_confirmation'])
            {
                User::create([
                    'name' => implode(Input::only('name')),
                    'password' => bcrypt(implode(Input::only('password'))),
                ]);

                /*
                |
                | Putting activity into log
                |
                */
                $activityToLog = new ActivityLog;
                $activityToLog->activity = "New user created! Login: " . $input['name'] . ". Password: " . $input['password'];
                $activityToLog->user = \Auth::user()->name;
                $activityToLog->save();

                \Session::flash('message', 'Пользователь создан!');
                //return redirect('home')->with('message', 'Пользователь создан!');
                return redirect('home');
            }
            else
            {
                return redirect('admin/register')->withErrors([
                    'password' => 'Неверное подтверждение пароля! Попробуйте еще раз?',
                ]);  
            }
            
        }
    }   

}
