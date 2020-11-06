<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\EmailCobranca;
use App\Nota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ClientesController extends Controller
{

    public function getNomeArquivo($prefixo, $cliente){
        $files = Storage::files();
        
        $fitlered_files = array_filter($files, function($str) use ($cliente, $prefixo){
            return strpos($str, $cliente->shortname) !== false && strpos($str, $prefixo) !== false;
        });
        // dd($fitlered_files);
        return $fitlered_files;
        // return !empty($fitlered_files) ?  $fitlered_files[0] : "";
    }
    
    public function getNomeArquivoBoleto($cliente){
        // printf("\n getNomeArquivoBoleto: " . $cliente->shortname);
        return $this->getNomeArquivo("BOLETO", $cliente);
    }
    
    public function getNomeArquivoNota($cliente){
        // printf("\n getNomeArquivoNota: " . $cliente->shortname);
        return $this->getNomeArquivo("NFSe", $cliente);
    }
    
    public function index()
    {
        $emailsCobranca = [];
        $clientes = Cliente::where('status_cliente', 'ATIVO')
        ->orderBy('shortname')
        ->get();

        foreach ($clientes as $cliente) {
            if($cliente->shortname == 'CAPI-IPANEMA'
                || $cliente->shortname == 'AVULSO')
                continue;
                
            $emailCobranca = new EmailCobranca();
            $emailCobranca->shortname = $cliente->shortname;
            $emailCobranca->emailDestinatario = $cliente->email;
            $emailCobranca->nomeArquivoBoleto = $this->getNomeArquivoBoleto($cliente);
            $emailCobranca->nomeArquivoNota = $this->getNomeArquivoNota($cliente);

            array_push($emailsCobranca, $emailCobranca);
        }


        return $emailsCobranca;
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
