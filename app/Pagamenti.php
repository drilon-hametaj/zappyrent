<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pagamenti extends Model
{
    protected $table = 'pagamenti';

    protected $fillable = [
        'id',
        'id_contratto',
        'importo',
        'stato',
        'scadenza'
    ];
}
