<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Input;
use Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Client as Client;
use App\Models\ActivityLog as ActivityLog;

class NewClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        if(\Auth::guest())
        {
            return redirect('auth/login');
        }

        $clients = Client::all();
        return view('clients/index')->with('clients', $clients);
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

        return view('clients/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        /*
        |
        | Validate input data
        |
        */
        $rules = array(
            'id' => 'unique:clients,id',
            'spamOrClient' => 'required',
            'firstName' => 'required',
            'state' => 'required|max:6',
            'birthDate' => 'required|max:5',
            'mobNum' => 'required|max:13',
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            /*return redirect('clients/add')->withErrors([
                'Необходимые данные не введены, либо введены некорректно. Попробуйте еще раз!'
            ]);*/
            return redirect('clients/create')
                    ->withErrors($validator)
                    ->withInput(Input::all());
        }
        else
        {
            /*
            |
            | Create new client
            |
            */
            $newClient = new Client;
            $newClient->id = Input::get('cardID');
            $newClient->spamOrClient = Input::get('spamOrClient');
            $newClient->lastName = Input::get('lastName');
            $newClient->firstName = Input::get('firstName');
            $newClient->surName = Input::get('surName');
            $newClient->nickName = Input::get('nickName');
            $newClient->state = Input::get('state');
            $newClient->birthDate = Input::get('birthDate');
            $newClient->mobNum = Input::get('mobNum');
            $newClient->photo = Input::get('photo');
            $newClient->save();

            /*
            |
            | Putting activity into log
            |
            */
            $activityToLog = new ActivityLog;
            $activityToLog->activity = "New client created! Card №" . $newClient->id . ". Name: " . $newClient->lastName . " " . 
            $newClient->firstName . " " . $newClient->surName;
            $activityToLog->user = \Auth::user()->name;
            $activityToLog->save();

            \Session::flash('messageClientCreated', 'Клиент создан!');
            return redirect('send/single');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        if(\Auth::guest())
        {
            return redirect('auth/login');
        }

        $client = Client::find($id);

        if(!$client)
        {
            return view('clients/show')->withErrors([
                'cardID' => 'Пользователя с данным номером карты не существует!',
                ]);
        }
        else
            return view('clients/show')->with('client', $client);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
