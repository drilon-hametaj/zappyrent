<?php

namespace App\Http\Controllers;

use App\Alloggi;
use App\ContrattiModel;
use App\Pagamenti;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlloggiController extends Controller
{
    public function nuovoAlloggio(Request $request){
        /*Prendo i dati passati dal form*/
        $prezzo      = $request['prezzo'];
        $titolo      = $request['titolo'];
        $descrizione = $request['descrizione'];

        /* Salvo il nuovo alloggio */
        $alloggio = new Alloggi();
        $alloggio->prezzo      = $prezzo;
        $alloggio->nome        = $titolo;
        $alloggio->descrizione = $descrizione;
        $alloggio->id_user     = Auth::id();
        $alloggio->save();

        /*Reinderizzo alla home attraverso la rotta in modo tale che ci sia anche il nuovo alloggio appena inserito */
        return redirect()->route('home');
    }


    public function prenotaAlloggio(Request $request){

        $alloggio = Alloggi::where('id',$request['id'])->first();
        /*Creo un nuovo contratto*/
        $contratto                = new ContrattiModel();
        $contratto->id_user       = Auth::id();
        $contratto->id_alloggio   = $alloggio->id;
        $contratto->durata        = 12;
        $contratto->prezzo_finale = 12*$alloggio->prezzo;
        $contratto->save();

        /*Creo i pagamenti del nuovo contratto appena inserito*/
        $this->creaPagamenti($contratto->id,$contratto->durata,$alloggio->prezzo);

        Alloggi::where('id',$request['id'])->update(['stato'=>'prenotato']);

        return redirect()->route('home');
    }

    private function creaPagamenti($id_contratto,$mesi,$prezzo){
        $now = new \DateTime();
        for($i=0;$i<$mesi;$i++){
            $now->modify('+1 month');
            $pagamento = new Pagamenti();
            $pagamento->id_contratto = $id_contratto;
            $pagamento->importo = $prezzo;
            $pagamento->stato = 1; //Stato 1 = Appena inserito, non pagato
            $pagamento->scadenza = $now->format('Y-m-d H:i:s');
            $pagamento->save();

        }
    }
}
