<?php

namespace App\Http\Controllers;

use App\Chamado;
use Illuminate\Http\Request;

class ChamadosController extends Controller
{
    public function index(Request $request)
    {
        if($request->has('status')){
            return Chamado::where('status', $request->input('status'))->get() ;
        }
        return Chamado::all();
    }

    public function store(Chamado $chamado)
    {
        $chamado->save();
        return 'stored'; 
    }

    public function show(Chamado $chamado)
    {
        $chamado->cliente_shortname = $chamado->cliente->shortname;
        return $chamado;
    }

    public function update(Request $request, Chamado $chamado)
    {
        $chamado->update(request()->all());
        
        return 'updated';
    }

    public function destroy(Chamado $chamado)
    {
        $chamado->delete();
        return 'destroied';
    }

    public function validateChamado(){
        return request()->validate([
            'id' => 'required',
            'descricao' => 'required',
            'observacao' => 'nullable',
            'preventiva' => 'nullable',
            'dt_abertura' => 'nullable',
            'dt_fechamento' => 'nullable',
            'solucao' => 'nullable',
            'status' => 'nullable',
        ]);
    }
}
