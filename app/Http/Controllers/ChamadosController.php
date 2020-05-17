<?php

namespace App\Http\Controllers;

use App\Chamado;
use App\Cliente;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\MailService;
use Illuminate\Support\Facades\Input;
use Maatwebsite\Excel\Facades\Excel;

class ChamadosController extends Controller
{
    
    public function index(Request $request)
    {
        return Chamado::with('cliente')->orderBy('dt_abertura', 'asc')->get();
        // return Chamado::select(
        //                     'chamados.id',
        //                     'clientes.shortname as cliente_shortname',
        //                     'status',
        //                     'descricao',
        //                     'observacao',
        //                     'preventiva',
        //                     'isinclusonoitinerario',
        //                     'dt_abertura',
        //                     'dt_ag_execucao',
        //                     'dt_fechamento',
        //                     'solucao'
        //                 )->join('clientes','clientes.id','=','chamados.cliente_id')
        //                 ->orderBy('dt_abertura', 'asc')
        //                 ->get();
    }

    public function itinerario(){
        $qtde = Chamado::where('status', 'ABERTO')
                        ->where('isinclusonoitinerario', 'true')
                        ->count();

        $listaDeChamados = Chamado::select(
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

        return array([
            'qtdeChamados' => $qtde,
            'chamados' => $listaDeChamados
        ]);
    }

    public function abertos(Request $request){
        $orderBy = 'dt_abertura';
        $orderOrientation = 'ASC';

        switch($request->input('orderBy')){
            case('DTABERTURA_ASC'):
                $orderBy = 'dt_abertura';
                $orderOrientation = 'asc';
                break;
            case('DTABERTURA_DESC'):
                $orderBy = 'dt_abertura';
                $orderOrientation = 'desc';
                break;
            default:
                $orderBy = 'dt_abertura';
                $orderOrientation = 'asc';
        }

        $qtde = Chamado::where('status', 'ABERTO')
                        ->count();
        $listaDeChamados = Chamado::where('status', 'ABERTO')
                                    ->with('cliente')
                                    ->orderBy($orderBy, $orderOrientation)
                                    ->get();

        return array([
            'qtdeChamados' => $qtde,
            'chamados' => $listaDeChamados
        ]);
    }

    public function fechados(Request $request){
        $orderBy = 'dt_abertura';
        $orderOrientation = 'ASC';

        switch($request->input('orderBy')){
            case('DTFECHAMENTO_ASC'):
                $orderBy = 'dt_fechamento';
                $orderOrientation = 'asc';
                break;
            case('DTFECHAMENTO_DESC'):
                $orderBy = 'dt_fechamento';
                $orderOrientation = 'desc';
                break;
            case('DTABERTURA_ASC'):
                $orderBy = 'dt_abertura';
                $orderOrientation = 'asc';
                break;
            case('DTABERTURA_DESC'):
                $orderBy = 'dt_abertura';
                $orderOrientation = 'desc';
                break;
            default:
                $orderBy = 'dt_abertura';
                $orderOrientation = 'asc';
        }

        $qtde = Chamado::where('status', 'FECHADO')
                            ->count();
        $listaDeChamados = Chamado::where('status', 'FECHADO')
                                    ->with('cliente')
                                    ->orderBy($orderBy, $orderOrientation)
                                    ->get() ;

        return array([
                    'qtdeChamados' => $qtde,
                    'chamados' => $listaDeChamados
        ]);
    }

    public function store()
    {
        $chamado = new Chamado(request()->all());
        $chamado->cliente_id = request('cliente_id');
        $chamado->dt_abertura = date("Y-m-d H:i:s");
        
        $persistedChamado = Chamado::create($chamado->toArray());

        $cliente = Cliente::find($chamado->cliente_id);

        if($chamado->enviaremailabertura){
            (new MailService())->sendAbertura($cliente->email, $cliente->email, $persistedChamado);
        }

        return response('Chamado aberto com sucesso. Id: ' . $persistedChamado->id, 200); 
    }

    public function show($id)
    {
        $chamado = Chamado::with('cliente')->findOrFail($id);
        $chamado->cliente_shortname = $chamado->cliente->shortname;
        
        return $chamado;
    }

    public function statusCliente(){
        $listaDeChamados = Chamado::where('clientes.shortname', 'MMCONTADORES')
                                    ->join('clientes', 'clientes.id', '=', 'chamados.cliente_id')
                                    ->get();

        return array([
            'chamados' => $listaDeChamados
        ]);
    }

    public function update(Request $request, $id)
    {
        $chamado = Chamado::findOrFail($id);
        $statusAnterior = $chamado->status;
        $statusNovo = request('status');

        $chamado->update(request()->all());

        $cliente = Cliente::find($chamado->cliente_id);
        $chamado->cliente_shortname = $cliente->shortname;

        if($statusAnterior == 'ABERTO' && $statusNovo == 'FECHADO'){
            DB::table('chamados')
                ->where('id', $id)
                ->update(['dt_fechamento' => Carbon::now()]);

            if(request('enviaremailfechamento')){
                (new MailService())->sendFechamento($cliente->email,$cliente->email, $chamado);
            }
        }
 
        return $chamado;
    }

    public function destroy(Chamado $chamado)
    {
        //$chamado->delete();
        return 'not implemented';
    }

    public function downloadExcel()
	{
        $data = Chamado::get()->toArray();
        
		return Excel::create('Chamados', function($excel) use ($data) {
			$excel->sheet('planilha1', function($sheet) use ($data)
	        {
				$sheet->fromArray($data);
	        });
		})->download("xlsx");
    }

    public function importExcel()
	{
			if(Input::hasFile('import_file')){
                $path = Input::file('import_file')->getRealPath();
                $data = Excel::load($path, function($reader) {})->toArray();

                if(count($data) > 0){
                    DB::table('chamados')->insert($data);
                }
            }
            
        return back();
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
