<?php

namespace adm\Http\Controllers;

use Illuminate\Http\Request;

use adm\Http\Requests;
use adm\Sucursal;
use Illuminate\Support\Facades\Redirect;
use DB;

class SucursalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request)
        {
            $searchText=trim($request->get('searchText'));
            $sucursals=DB::table('sucursals')
            ->where('nombre','LIKE','%'.$searchText.'%')
            ->where('estado','=','Activa')
            ->orderBy('id','desc')
            ->paginate(7);
            return view('menu.sucursal.index',compact('searchText', 'sucursals'));
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('menu.sucursal.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sucursal = Sucursal::create($request->all());
        return Redirect::to('menu/sucursal');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view("menu.sucursal.edit",["sucursal"=>Sucursal::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $sucursal=Sucursal::findOrFail($id);
        $sucursal->nombre=$request->get('nombre');
        $sucursal->direccion=$request->get('direccion');
        $sucursal->telefono=$request->get('telefono');
        $sucursal->update();
        return Redirect::to('menu/sucursal');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sucursal = Sucursal::findOrFail($id);
        $sucursal->estado='Inactiva';
        $sucursal->update();
        return Redirect::to('menu/sucursal');
    }
}
