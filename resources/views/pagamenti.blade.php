@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2>Pagamenti</h2>
            @foreach ($pagamenti as $pagamento)
                <div class="row shadow">
                    <div class="col-md-6">
                        Scadenza: {{ $pagamento->scadenza }}
                    </div>
                    <div class="col-md-3">
                        {{ $pagamento->importo }} €
                    </div>
                    <div class="col-md-3">
                        @if($pagamento->stato == 1)
                        <a href="{{ url('effettua-pagamento/'.$pagamento->id) }}" class="btn btn-warning">Effettua Pagamento</a>
                        @else
                            <p style="background: #2d995b">Pagamento effettuato</p>
                        @endif
                    </div>
                </div><br>
            @endforeach
        </div>
    </div>
</div>


@endsection
