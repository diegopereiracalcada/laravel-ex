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

    public function store()
    {
        $chamado = new Chamado();
        $chamado->status = request('status');
        $chamado->descricao = request('descricao');
        $chamado->dt_abertura = date("Y-m-d H:i:s");
        $chamado->cliente_id = request('cliente_id');
        $chamado->save();
        return response('Chamado aberto com sucesso. Id: ' . $chamado->id, 200); 
    }

    public function show($id)
    {
        $chamado = Chamado::findOrFail($id);
        $chamado->cliente_shortname = $chamado->cliente->shortname;
        return $chamado;
    }

    public function update(Request $request, $id)
    {
        $chamado = Chamado::findOrFail($id);
        $chamado->update(request()->all());
        
        return 'updated';
    }

    public function destroy(Chamado $chamado)
    {
        //$chamado->delete();
        return 'not implemented';
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
