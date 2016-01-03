<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Input;
use App\User;
use Validator;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\ActivityLog as ActivityLog;

class NewAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('admin/main');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        if(\Auth::guest())
        {
            return redirect('auth/login');
        }

        return view('admin/createUser');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $rules = array('name' => 'unique:users,name,required',
                       'password' => 'required',
                      );

        $validator = Validator::make(\Input::all(), $rules);

        if ($validator->fails()) {
            return redirect('admin/create')->withErrors([
                'Вы не ввели ничего в поле для имени, либо пользователь с таким именем уже существует!'
            ]);
        }
        else 
        {        
            if(Input::get('password') === Input::get('password_confirmation'))
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
                $activityToLog->activity = "New user created! Login: " . Input::get('name') . ". Password: " . Input::get('password');
                $activityToLog->user = \Auth::user()->name;
                $activityToLog->save();

                \Session::flash('message', 'Пользователь создан!');
                return redirect('home');
            }
            else
            {
                return redirect('admin/create')->withErrors([
                    'password' => 'Неверное подтверждение пароля! Попробуйте еще раз?',
                ]);  
            }
            
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        if(\Auth::guest())
        {
            return redirect('auth/login');
        }

        User::find($id)->delete();

        Session::flash('message', 'Successfully deleted user!');
        return redirect('admin/users');
    }

    public function users() {
        if(\Auth::guest())
        {
            return redirect('auth/login');
        }

        $users = User::all();
        return view('admin/users')->with('users', $users);
    }

    public function log() {
        if(\Auth::guest())
        {
            return redirect('auth/login');
        }

        $activities = ActivityLog::orderBy('id', 'desc')->get();
        return view('admin/log')->with('activities', $activities);
    }
}
