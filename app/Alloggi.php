<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alloggi extends Model
{
    protected $table = 'alloggi';

    protected $fillable = [
        'id',
        'nome',
        'descrizione',
        'prezzo',
        'id_user',
        'stato'
    ];
}
