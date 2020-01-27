<?php

namespace App\Http\Controllers;

use App\Chamado;
use App\Cliente;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
                                'observacao',
                                'isinclusonoitinerario',
                                'preventiva',
                                'dt_abertura',
                                'dt_ag_execucao',
                                'dt_fechamento',
                                'solucao'
                            )->where('status', $request->input('status'))
                            ->join('clientes','clientes.id','=','chamados.cliente_id')
                            ->orderBy('dt_abertura', 'asc')
                            ->get() ;
        }
        return Chamado::select(
                            'chamados.id',
                            'clientes.shortname as cliente_shortname',
                            'status',
                            'descricao',
                            'observacao',
                            'preventiva',
                            'isinclusonoitinerario',
                            'dt_abertura',
                            'dt_ag_execucao',
                            'dt_fechamento',
                            'solucao'
                        )->join('clientes','clientes.id','=','chamados.cliente_id')
                        ->orderBy('dt_abertura', 'asc')
                        ->get();
    }

    public function itinerario(){
        return Chamado::select(
                            'chamados.id',
                            'clientes.shortname as cliente_shortname',
                            'status',
                            'descricao',
                            'observacao',
                            'isinclusonoitinerario',
                            'preventiva',
                            'dt_abertura',
                            'dt_ag_execucao',
                            'dt_fechamento',
                            'solucao'
                        )->where('status', 'ABERTO')
                        ->where('isinclusonoitinerario', 'true')
                        ->join('clientes','clientes.id','=','chamados.cliente_id')
                        ->orderBy('dt_abertura', 'asc')
                        ->get() ;
    }

    public function fechados(){
        return Chamado::where('status', 'FECHADO')
                        ->with('cliente')
                        ->orderBy('dt_fechamento', 'desc')
                        ->get() ;
    }

    public function store()
    {
        $chamado = new Chamado();
        $chamado->status = request('status');
        $chamado->descricao = request('descricao');
        $chamado->dt_abertura = date("Y-m-d H:i:s");
        $chamado->cliente_id = request('cliente_id');
        $chamado->isinclusonoitinerario = request('isinclusonoitinerario');

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
        $statusAnterior = $chamado->status;
        $statusNovo = request('status');

        $chamado->update(request()->all());

        if($statusAnterior == 'ABERTO' && $statusNovo == 'FECHADO'){
            DB::table('chamados')
                ->where('id', $id)
                ->update(['dt_fechamento' => Carbon::now()]);
        }
        
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
            'isinclusonoitinerario' => 'required',
            'observacao' => 'nullable',
            'preventiva' => 'nullable',
            'dt_abertura' => 'nullable',
            'dt_fechamento' => 'nullable',
            'solucao' => 'nullable',
            'status' => 'nullable',
        ]);
    }
}
