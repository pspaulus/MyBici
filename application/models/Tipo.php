<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipo extends Model
{
    protected $table = 'TIPO';
    public $timestamps = false;

    protected $fillable = [
        'descripcion',
        'objeto'
    ];
}