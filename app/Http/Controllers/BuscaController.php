<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class BuscaController extends Controller
{
    public function search()
    {
        $param = request('palavras');
        $palavrasBuscadas = explode("_",$param);

        if(!isset($param)){
            return "sem palavras na request";
        }

        $param = strtoupper($param);
        $palavras = explode(" ",$param);
        $isFirstWhere = true;

        $sql = "SELECT
                    chamados.id,
                    clientes.shortname as cliente_shortname,
                    chamados.status,
                    chamados.descricao,
                    chamados.observacao,
                    chamados.isinclusonoitinerario,
                    chamados.preventiva,
                    chamados.dt_abertura,
                    chamados.dt_ag_execucao,
                    chamados.dt_fechamento,
                    chamados.solucao
                FROM
                    chamados 
                JOIN
                    CLIENTES ON chamados.cliente_id = clientes.id";

        foreach($palavras as $palavra){
            if($isFirstWhere){
                $sql = $sql . " WHERE UPPER(descricao) like '%" . $palavra . "%' ";
                $isFirstWhere = false;
            } else {
                $sql = $sql . " OR UPPER(descricao) like '%" . $palavra . "%' ";
            }
        }

        //return $sql;

        // print('$sql = ');
        // print($sql);
        // print('$palavra = ');
        // print($palavra);
        
        $chamados = DB::select($sql);
        
        return $chamados; 

        // foreach ($servicos as $key => $servico) {
        //     $servico->enderecos = Endereco::where('servico_id', $servico->id)->get();
        //     $servico->telefones = Telefone::where('servico_id', $servico->id)->get();
        //     $servico->emails = Email::where('servico_id', $servico->id)->get();
        // }

        // $setores = Setor::all();

        //view('busca.index', compact('servicos', 'palavras', 'palavrasBuscadas', 'setores')) ;
        return "ok"; 
    }

    // private function adicionaWhere($palavra){
    //     $this->$sql = $this->$sql . "AND titulo = " . $palavra;
    // }

}
