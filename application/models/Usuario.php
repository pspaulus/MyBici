<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'USUARIO';
    public $timestamps = false;

    protected $fillable = [
        'nombre', 'contrasena', 'ESTADO_id'
    ];
}