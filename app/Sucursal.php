<?php

namespace adm;

use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    protected $fillable = ['nombre','direccion','telefono','estado'];
}
