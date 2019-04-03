<?php

namespace adm\Http\Controllers;

use Illuminate\Http\Request;

use adm\Http\Requests;
use adm\Incidente;
use Illuminate\Support\Facades\Redirect;
use adm\Http\Requests\IncidenteFormRequest;
use DB;


class IncidenteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        if ($request)
        {
            $query=trim($request->get('searchText'));
            $incidentes=DB::table('incidentes')
            ->where('tipo','LIKE','%'.$query.'%')
            ->orderBy('id','desc')
            ->paginate(7);
            return view('menu.incidente.index',["incidentes"=>$incidentes,"searchText"=>$query]);
        }
    }
    public function create()
    {
        return view("menu.incidente.create");
    }
    public function store (IncidenteFormRequest $request)
    {
        $incidente=new Incidente;
        $incidente->tipo=$request->get('tipo');
        $incidente->descripcion=$request->get('descripcion');
        $incidente->impacto=$request->get('impacto');
        $incidente->area=$request->get('area');
        $incidente->tecnico=$request->get('tecnico');     
        $incidente->save();
        return Redirect::to('menu/incidente');

    }
}
