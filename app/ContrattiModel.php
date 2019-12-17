<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContrattiModel extends Model
{
    protected $table = 'contratti';

    protected $fillable = [
        'id',
        'id_user',
        'id_alloggio',
        'durata',
        'prezzo_finale'
    ];
}
