@extends('layouts.admin')
@section('contenido')
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <h3>Generar Reportes de Totales</h3>
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
{!! Form::open(array('url'=>'reportes','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}
<div class="row">
{{-- <input type="text" class="form-control" name="zona" placeholder="Ingresar la Zona" value="{{$zona}}"> --}}
    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12"> 
        <div class="form-group">
            <label for="local">Local </label>
            <select name="nego" id="cliente" class="form-control selectpicker" data-live-search="true" title="Elegir Local">
                @foreach($local as $loc)
                  <option value="{{$loc->id}}">{{$loc->nombre}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
           <label for="fecha">Fecha</label> 
        <input type="date" class="form-control" name="fecha" value="{{$fecha}}">
        </div>
    </div>
    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="mes">Mes</label> 
            <select  class="form-control" name="mes">
                    <option value="0">Elegir Mes</option>
                    <option value="Enero">Enero</option>
                    <option value="Febrero">Febrero</option>
                    <option value="Marzo">Marzo</option>
                    <option value="Abril">Abril</option>
                    <option value="Mayo">Mayo</option>
                    <option value="Junio">Junio</option>
                    <option value="Julio">Julio</option>
                    <option value="Agosto">Agosto</option>
                    <option value="Septiembre">Septiembre</option>
                    <option value="Octubre">Octubre</option>
                    <option value="Noviembre">Noviembre</option>
                    <option value="Diciembre">Diciembre</option>
            </select>
        </div>
    </div>
    {{-- <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
             <label for="credito">Credito</label> 
        <input type="text" class="form-control" name="credito" value="0">
        </div>
    </div> --}}
    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
        <div class="form-group">
            <span class="input-group-btn">
                <button type="submit" class="btn btn-primary form-control">Buscar</button>
            </span>
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
      <a href="{{url('reportelocal',[$nego,$fecha])}}" target="_blank"><button title="Reporte" class="btn btn-warning"><i class="fa fa-print" aria-hidden="true"></i></button></a>
    </div>
</div>
@endsection