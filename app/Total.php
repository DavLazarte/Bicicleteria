<?php

namespace adm;

use Illuminate\Database\Eloquent\Model;

class Total extends Model
{
    protected $fillable = ['total_efectivo','total_tarjeta','total_gral','fecha', 'estado'];
}
