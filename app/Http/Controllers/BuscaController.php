<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class BuscaController extends Controller
{
    public function search()
    {
        $param = request('palavras');
        $dtAberturaStart = request('dt_abertura_start');
        $dtAberturaEnd = request('dt_abertura_end');
        $dtFechamentoStart = request('dt_fechamento_start');
        $dtFechamentoEnd = request('dt_fechamento_end');
        $status = request('status');

        $param = strtoupper($param);
        $palavras = explode(" ",$param);

        $sql = "SELECT
                    chamados.id,
                    chamados.numerochamado,
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
                    CLIENTES ON chamados.cliente_id = clientes.id
                WHERE
                    true=true ";


        foreach($palavras as $palavra){
            $sql .= " AND (UPPER(descricao) like '%" . $palavra . "%' ";

            $sql .= " OR UPPER(observacao) like '%" . $palavra . "%' ";

            $sql .= " OR UPPER(solucao) like '%" . $palavra . "%' ";

            $sql .= " OR UPPER(clientes.shortname) like '%" . $palavra . "%') ";
            
        }
        
        if($dtAberturaStart){
            $sql .= " AND dt_abertura >= '" . $dtAberturaStart . "' ";
        }
        if($dtAberturaEnd){
            $sql .= " AND dt_abertura <= '" . $dtAberturaEnd . "' ";
        }
        if($dtFechamentoStart){
            $sql .= " AND dt_fechamento >= '" . $dtFechamentoStart . "' ";
        }
        if($dtFechamentoEnd){
            $sql .= " AND dt_abertura <= '" . $dtFechamentoEnd . "' ";
        }
        if($status){
            $sql .= " AND status = '" . strtoupper($status) . "' ";
        }

        $chamados = DB::select($sql);
        
        return $chamados; 

    }


}
