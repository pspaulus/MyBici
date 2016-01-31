<?php
/**
 * Created by PhpStorm.
 * User: Administrador
 * Date: 08/12/2015
 * Time: 13:38
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Estacion extends Model
{
    protected $table = 'PUESTO_ALQUILER';
    public $timestamps = false;

    protected $fillable = [
        'codigo', 'nombre', 'longitud', 'latitud'
    ];
}