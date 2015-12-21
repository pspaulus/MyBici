<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    protected $table = 'ESTADO';
    public $timestamps = false;

    protected $fillable = [
        'descripcion',
        'objeto'
    ];
}