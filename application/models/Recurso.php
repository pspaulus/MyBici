<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Recurso extends Model
{
    protected $table = 'RECURSO';
    public $timestamps = false;

    protected $fillable = [
        'EVENTO_id',
        'BICICLETA_id'
    ];
}