<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Premio extends Model
{
    protected $table = 'PREMIO';
    public $timestamps = false;

    protected $fillable = [
        'usuario_primer_lugar',
        'usuario_segundo_lugar',
        'usuario_tercer_lugar',
        'premio_primer_lugar',
        'premio_segundo_lugar',
        'premio_tercer_lugar'
    ];
}