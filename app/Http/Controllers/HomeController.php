<?php

namespace App\Http\Controllers;

use App\Alloggi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $lista_alloggi = Alloggi::where('id_user','!=',Auth::id())->where('stato','libero')->get();
        return view('home',[
                'alloggi' => $lista_alloggi
            ]
        );
    }
}
