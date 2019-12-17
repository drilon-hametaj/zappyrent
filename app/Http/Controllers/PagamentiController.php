<?php

namespace App\Http\Controllers;

use App\Pagamenti;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        $pagamento = Pagamenti::where('id',$request['id'])->first();
        $cliente = DB::table('contratti')
            ->join('users','users.id','=','contratti.id_user')
            ->where('contratti.id',$pagamento->id_contratto)
            ->select('users.id','contratti.id_alloggio') //Supponiamo che nella tabella ci siano anche tutti i dati per effettuare il pagamento e li prenda qui
            ->first();

        $proprietario = DB::table('contratti')
            ->join('alloggi','alloggi.id','=','contratti.id_alloggio')
            ->join('users','users.id','=','alloggi.id_user')
            ->where('contratti.id',$pagamento->id_contratto)
            ->select('users.id','contratti.id_alloggio') //Supponiamo che nella tabella ci siano anche tutti i dati per effettuare il pagamento e li prenda qui
            ->first();

        /*Qui suppongo di avere tutti i dati del cliente e proprietario che mi servono per effettuare il versamento
          verso il proprietario e lo scalare dal conto del cliente, ad esempio con paypal
        */
        $risultato = '';
        //$risultato = paypal::effettuaPagamento("?cliente=$cliente->id&prop=$proprietario->id&importo=$v->importo")->run(); //Qui faccio il pagamento

        if($risultato == true){ //Supponendo che la richiesta api dia true nel caso sia andata a buon fine
            Pagamenti::where('id',$pagamento->id) //Stato = 1 ancora non pagato*/
                ->update(['stato' => 2]); //Stato = 2 pagato
        }else{
            //Ci sarà un invio di email che comunicherà il motivo per cui non è andato a buon fine l'operazione
        }
        return redirect()->back();
    }
}
