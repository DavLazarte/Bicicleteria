@extends('layouts.admin')
@section('contenido')
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <h3>Generar Reportes Por Mes</h3>
            @if (count($errors)>0)
            <div class="alert alert-danger">
                <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
                </ul>
            </div>
            @endif
    </div>
</div>
{!! Form::open(array('url'=>'reportemes','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}
<div class="row">
    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="mes">Mes</label> 
            <select  class="form-control" name="mes">
                    <option value="0">Elegir Mes</option>
                    <option value="1">Enero</option>
                    <option value="2">Febrero</option>
                    <option value="3">Marzo</option>
                    <option value="4">Abril</option>
                    <option value="5">Mayo</option>
                    <option value="6">Junio</option>
                    <option value="7">Julio</option>
                    <option value="8">Agosto</option>
                    <option value="9">Septiembre</option>
                    <option value="10">Octubre</option>
                    <option value="11">Noviembre</option>
                    <option value="12">Diciembre</option>
            </select>
        </div>
    </div>
    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
        <div class="form-group">
            <label for=" "> </label>
            <button type="submit" class="btn btn-primary form-control">Buscar</button>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover">
                <thead>
                    <th>Id</th>
					<th>Nº Ingreso</th>
					<th>Fecha</th>
					<th>Local</th>
					<th>Efectivo</th>
					<th>Tarjeta</th>
					<th>Subtotal</th>
                </thead>
                @foreach ($totals as $tot)
				<tr>
                    <td>{{ $tot->id}}</td>
                    <td>{{ $tot->idtotal}}</td>
                    <td>{{ $tot->fecha}}</td>
					<td>{{ $tot->negocio.'-'.$tot->nombre}}</td>
					<td>{{ $tot->efectivo}}</td>
					<td>{{ $tot->tarjeta}}</td>
                    <td>{{ $tot->sub_total}}</td>
                    
                </tr>
				@endforeach
			</table>
		</div>
    </div>
</div>
{{Form::close()}}
<div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
    <div class="form-group">
      <a href="{{url('reportem',$mes)}}" target="_blank"><button title="Reporte" class="btn btn-warning"><i class="fa fa-print" aria-hidden="true"></i></button></a>
    </div>
</div>
@endsection