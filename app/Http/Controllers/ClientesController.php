<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\MailService;
use App\Nota;
use App\Services\CobrancaService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ClientesController extends Controller
{

    public function cobranca()
    {
        $emailsCobranca = (new CobrancaService())->getCobrancasDoMes();
        
        return view('cobranca', compact('emailsCobranca'));
    }

    public function enviarEmails(){
        // dd("Enviando emails...");
        // (new MailService())->sendFechamento("", "", "000");
        Mail::send("emails.cobranca", [], function ($message) {
            $message
                ->from("clickticonsultoria@gmail.com", "ClickTI Informática")
                ->to("clickticonsultoria@gmail.com", "Teste cobranca")
                ->subject("Assunto de teste  - cobranca");
        });
        return "Email enviado";
    }

    public function index()
    {
        return $clientes = Cliente::where('status_cliente', 'ATIVO')
            ->orderBy('shortname')
            ->get();
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
