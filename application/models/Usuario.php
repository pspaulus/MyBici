<?php
/**
 * Created by PhpStorm.
 * User: Administrador
 * Date: 08/12/2015
 * Time: 13:38
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'USUARIO';
    public $timestamps = false;
}