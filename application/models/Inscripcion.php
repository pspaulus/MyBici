<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Inscripcion extends Model
{
    protected $table = 'INSCRIPCION';
    public $timestamps = false;

    protected $fillable = [
        'EVENTO_id',
        'USUARIO_id'
    ];
}