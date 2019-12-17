<?php

namespace App\Http\Controllers;

use App\Pagamenti;
use Illuminate\Http\Request;

class PagamentiController extends Controller
{
    public function vediPagamenti(Request $request){
        $lista_pagamenti = Pagamenti::where('id_contratto',$request['id'])->get();

        return view('pagamenti',[
            'pagamenti' => $lista_pagamenti
        ]);
    }

    public function vediPagamentiDaRicevere(Request $request){
        $lista_pagamenti = Pagamenti::where('id_contratto',$request['id'])->get();

        return view('pagamenti-ricevere',[
            'pagamenti' => $lista_pagamenti
        ]);
    }

    public function effettuaPagamento(Request $request){
        Pagamenti::where('id',$request['id'])->update(['stato' => 2]);

        return redirect()->back();
    }
}
