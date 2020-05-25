<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Nota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientesController extends Controller
{

    public function index()
    {
        return Cliente::orderBy('shortname')->get();
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

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

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }
    
    public function updatePreventiva(Request $request, $id)
    {
        $cliente = Cliente::find($id);
        $cliente->preventivapadrao = $request->input('preventivapadrao');
        $cliente->save();
    }

    public function destroy($id)
    {
        //
    }
}
