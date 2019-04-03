<?php

namespace adm;

use Illuminate\Database\Eloquent\Model;

class Incidente extends Model
{
   protected $table='incidentes';

   protected $primaryKey='id';

   protected $fillable=[
   		'tipo',
   		'descripcion',
   		'impacto',
   		'area',
   		'tecnico'
   	];

   protected $guarded =[

    ];
}
