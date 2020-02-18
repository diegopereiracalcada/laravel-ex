<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Nota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Cliente::orderBy('shortname')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->notas = Nota::join('categorias','notas.categoria_id','=','categorias.id')
                                ->where('cliente_id', $id)
                                ->orderBy('categoria')
                                ->orderBy('nota')
                                ->select(['notas.id', 'notas.nota', 'categorias.categoria'])
                                ->get();

        $cliente->categorias = DB::select('select 
                                                distinct(c.categoria) 
                                            from 
                                                categorias c
                                            join 
                                                notas n on c.id = n.categoria_id
                                            where 
                                                n.cliente_id = ?
                                            order by 
                                                c.categoria', [$id]);
        return $cliente;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
