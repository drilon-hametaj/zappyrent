<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ContrattiModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Contratti extends Controller
{

    public function getListaContratti(Request $request){
        $lista_contratti_da_pagare = DB::table('contratti')
                                    ->leftJoin('alloggi','alloggi.id','=','contratti.id_alloggio')
                                    ->where('contratti.id_user',Auth::id())
                                    ->select('contratti.id','contratti.durata','alloggi.nome','alloggi.descrizione')
                                    ->get();

        $lista_contratti_da_ricevere = DB::table('contratti')
                                        ->leftJoin('alloggi','alloggi.id','=','contratti.id_alloggio')
                                        ->where('alloggi.id_user',Auth::id())
                                        ->select('contratti.id','contratti.durata','alloggi.nome','alloggi.descrizione')
                                        ->get();

        return view('contratti',[
            'contratti'             => $lista_contratti_da_pagare,
            'contratti_da_ricevere' => $lista_contratti_da_ricevere
                ]
        );
    }
}
