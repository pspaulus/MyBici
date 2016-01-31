<?php
/**
 * Created by PhpStorm.
 * User: Administrador
 * Date: 08/12/2015
 * Time: 13:38
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $table = 'PERSONA';
    public $timestamps = false;

    protected $fillable = [
        'nombres', 'apellidos', 'edad', 'genero'
    ];
}