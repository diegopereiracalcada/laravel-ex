<?php

namespace App\Http\Controllers;

use App\Chamado;
use App\Cliente;
use Illuminate\Http\Request;

class ChamadosController extends Controller
{
    public function index(Request $request)
    {
        if($request->has('status')){
            return Chamado::select(
                                'chamados.id',
                                'clientes.shortname as cliente_shortname',
                                'status',
                                'descricao',
                                'isInclusoNoItinerario',
                                'preventiva',
                                'dt_abertura',
                                'dt_ag_execucao',
                                'dt_fechamento',
                                'solucao'
                            )->where('status', $request->input('status'))
                            ->join('clientes','clientes.id','=','chamados.cliente_id')
                            ->get() ;
        }
        return Chamado::select(
                            'chamados.id',
                            'clientes.shortname as cliente_shortname',
                            'status',
                            'descricao',
                            'preventiva',
                            'isInclusoNoItinerario',
                            'dt_abertura',
                            'dt_ag_execucao',
                            'dt_fechamento',
                            'solucao'
                        )->join('clientes','clientes.id','=','chamados.cliente_id')
                        ->get();
    }

    public function itinerario(){
        return Chamado::select(
                            'chamados.id',
                            'clientes.shortname as cliente_shortname',
                            'status',
                            'descricao',
                            'isInclusoNoItinerario',
                            'preventiva',
                            'dt_abertura',
                            'dt_ag_execucao',
                            'dt_fechamento',
                            'solucao'
                        )->where('status', 'ABERTO')
                        ->where('isInclusoNoItinerario', 'true')
                        ->join('clientes','clientes.id','=','chamados.cliente_id')
                        ->get() ;
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
        //dd(request()->all());
        $chamado = Chamado::findOrFail($id);
        $chamado->update(request()->all());
        
        $chamado->cliente_shortname = Cliente::find($chamado->cliente_id)->shortname;
        return $chamado;
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
            'isInclusoNoItinerario' => 'required',
            'observacao' => 'nullable',
            'preventiva' => 'nullable',
            'dt_abertura' => 'nullable',
            'dt_fechamento' => 'nullable',
            'solucao' => 'nullable',
            'status' => 'nullable',
        ]);
    }
}
