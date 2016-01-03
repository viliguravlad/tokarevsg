<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getIndex()
    {
        if(\Auth::check() && \Auth::user()->name === 'admin')
        {
            return view('admin/main');
        }

        if(\Auth::guest())
        {
            return redirect('auth/login');
        }

        return view('home');
    }
}