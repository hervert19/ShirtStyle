<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TiposEnvio extends Model
{
    protected $table = 'tiposenvio';
    protected $primaryKey = 'idtipoenvio';
    public $timestamps = false;

    protected $fillable = [
        'metodo',
        'dias',
        'precio',
    ];
}
