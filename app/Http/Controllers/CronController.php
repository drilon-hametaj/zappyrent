<?php

namespace App\Http\Controllers;

use App\Pagamenti;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CronController extends Controller
{
    public function checkPayment(){
        $now = new \DateTime();

        $pagamenti_scaduti = Pagamenti::where('scadenza','<',$now->format('Y-m-d H:i:s'))
                                        ->where('stato',1) //Stato = 1 ancora non pagato
                                        ->get();
        foreach ($pagamenti_scaduti as $k => $v){
            $cliente = DB::table('contratti')
                            ->join('users','users.id','=','contratti.id_user')
                            ->where('contratti.id',$v->id_contratto)
                            ->select('users.id','contratti.id_alloggio') //Supponiamo che nella tabella ci siano anche tutti i dati per effettuare il pagamento e li prenda qui
                            ->first();

            $proprietario = DB::table('contratti')
                                ->join('alloggi','alloggi.id','=','contratti.id_alloggio')
                                ->join('users','users.id','=','alloggi.id_user')
                                ->where('contratti.id',$v->id_contratto)
                                ->select('users.id','contratti.id_alloggio') //Supponiamo che nella tabella ci siano anche tutti i dati per effettuare il pagamento e li prenda qui
                                ->first();

            /*Qui suppongo di avere tutti i dati del cliente e proprietario che mi servono per effettuare il versamento
              verso il proprietario e lo scalare dal conto del cliente, ad esempio con paypal
            */
            $risultato = '';
            //$risultato = paypal::effettuaPagamento("?cliente=$cliente->id&prop=$proprietario->id&importo=$v->importo")->run(); //Qui faccio il pagamento

            if($risultato == true){ //Supponendo che la richiesta api dia true nel caso sia andata a buon fine
                Pagamenti::where('id',$v->id) //Stato = 1 ancora non pagato*/
                    ->update(['stato' => 2]); //Stato = 2 pagato
            }else{
                //Ci sarà un invio di email che comunicherà il motivo per cui non è andato a buon fine l'operazione
            }
        }
    }
}
