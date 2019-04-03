@extends('layouts.admin')

@section('contenido')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">TABLERO DE TAREAS</div>

                <div class="panel-body">
                        <div class="col-lg-6 col-xs-6">
                                <div class="box box-solid box-success">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Sucursales</h3>
                                    </div>
                                    <div class="box-body">
                                    <a href="{{url('menu/sucursal')}}"><i class="fa fa-home fa-5x" aria-hidden="true"></i></a>
                                    </div>
                                    <div class="box-footer">
                                      <a href="{{url('menu/sucursal/create')}}"> Cargar sucursal <i class="fa fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                        </div>
                        <div class="col-lg-6 col-xs-6">
                        <div class="box box-solid box-success">
                            <div class="box-header with-border">
                                <h3 class="box-title">Ingresos</h3>
                            </div>
                            <div class="box-body">
                            <a href="{{url('menu/recaudacion')}}"><i class="fa fa-money fa-5x" aria-hidden="true"></i></a>
                            </div>
                            <div class="box-footer">
                              <a href="{{url('menu/recaudacion/create')}}"> Cargar Recaudacion <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
@endsection
