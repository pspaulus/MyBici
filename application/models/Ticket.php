<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $table = 'TICKET';
    public $timestamps = false;

    protected $fillable = [
        'TIPO_id',
        'USUARIO_id',
        'BICICLETA_id',
        'origen_puesto_alquiler',
        'origen_estacionamiento',
        'destino_puesto_alquiler',
        'destino_estacionamiento',
        'fecha',
        'hora_creacion',
        'hora_retiro',
        'hora_entrega',
        'duracion',
        'ESTADO_id'
    ];
}