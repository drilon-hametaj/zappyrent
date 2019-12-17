@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#aggiungiAlloggio">
            Aggiungi Alloggio
        </button>
    </div>
    <hr>
    <div class="row justify-content-center shadow">
        @foreach ($alloggi as $alloggio)
            <div class="col-md-3">
                <img class="thumb" src="https://image.freepik.com/vettori-gratuito/una-casa-a-due-piani_1308-16176.jpg" alt="Una casa a due piani Vettore gratuito" width="100" height="100">

            </div>
            <div class="col-md-6">
                <b>{{ $alloggio->nome }}</b><br>
                {{ $alloggio->descrizione }} <br>
                <p style="float: right">{{ $alloggio->prezzo }} €</p>

            </div>
            <div class="col-md-3">
                <a href="{{ url('prenota/'.$alloggio->id) }}" class="btn btn-success">Prenota</a>
            </div>
        @endforeach
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="aggiungiAlloggio" tabindex="-1" role="dialog" aria-labelledby="aggiungiAlloggio" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nuovo Alloggio</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('nuovo-alloggio') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="titolo">Titolo</label>
                        <input type="text" class="form-control" name="titolo" id="titoloNuovoAlloggio" placeholder="Bilocale 50 mq">
                    </div>
                    <div class="form-group">
                        <label for="titolo">Descrizione</label>
                        <textarea class="form-control" name="descrizione" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="titolo">Prezzo <small>(Inserisci il prezzo mensile)</small></label>
                        <input type="number" class="form-control" name="prezzo" placeholder="500">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Chiudi</button>
                        <button type="submit" class="btn btn-primary">Inserisci</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection
