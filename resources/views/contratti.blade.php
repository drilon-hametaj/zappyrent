@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2>Appartamenti da pagare</h2>
            @foreach ($contratti as $contratto)
                <div class="row shadow">
                    <div class="col-md-3">
                        <img class="thumb" src="https://image.freepik.com/vettori-gratuito/una-casa-a-due-piani_1308-16176.jpg" alt="Una casa a due piani Vettore gratuito" width="100" height="100">

                    </div>
                    <div class="col-md-6">
                        <b>{{ $contratto->nome }}</b><br>
                        {{ $contratto->descrizione }} <br>
                        <p style="float: right">{{ $contratto->durata }} mesi</p>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ url('pagamenti/'.$contratto->id) }}" class="btn btn-success">Vedi Pagamenti</a>
                    </div>
                </div>
            @endforeach
            <br><hr><br>
            <h2>Appartamenti da ricevere</h2>
            @foreach ($contratti_da_ricevere as $contratto)
                <div class="row shadow">
                    <div class="col-md-3">
                        <img class="thumb" src="https://image.freepik.com/vettori-gratuito/una-casa-a-due-piani_1308-16176.jpg" alt="Una casa a due piani Vettore gratuito" width="100" height="100">

                    </div>
                    <div class="col-md-6">
                        <b>{{ $contratto->nome }}</b><br>
                        {{ $contratto->descrizione }} <br>
                        <p style="float: right">{{ $contratto->durata }} mesi</p>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ url('pagamenti-da-ricevere/'.$contratto->id) }}" class="btn btn-success">Vedi Pagamenti</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>


@endsection
