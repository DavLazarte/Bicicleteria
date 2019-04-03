<?php

namespace adm;

use Illuminate\Database\Eloquent\Model;

class DetalleTotal extends Model
{
    protected $fillable = ['idtotal','negocio', 'efectivo','tarjeta', 'sub_total'];
}
