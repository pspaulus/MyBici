<?php
/**
 * Created by PhpStorm.
 * User: Ps_Pa
 * Date: 16/12/2015
 * Time: 0:00
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Estacionamiento extends Model
{
    protected $table = 'ESTACIONAMIENTO';
    public $timestamps = false;

    protected $fillable = [
        'codigo', 'PUESTO_ALQUILER_id', 'BICICLETA_id', 'ESTADO_id'
    ];
}