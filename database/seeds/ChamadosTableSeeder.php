<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChamadosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('chamados')->insert([
            'descricao' => 'Pc não está ligando',
            'observacao' => 'Observacao referente ao chamado com informações importantes. Este campo pode conter um texto grande  sem problemas.',
            'status' => 'ABERTO',
            'dt_abertura' => date("Y-m-d H:i:s"),
            'cliente_id' => 1
        ]);
        
        DB::table('chamados')->insert([
            'descricao' => 'Site não entra',
            'observacao' => 'Observacao referente ao chamado com informações importantes. Este campo pode conter um texto grande  sem problemas.',
            'status' => 'FECHADO',
            'dt_abertura' => date("Y-m-d H:i:s"),
            'solucao' => 'Limpado cache do navegador. Foram realizadas tentativas de reinício dos ativos de rede sem sucesso. Usuário não possui outro navegador.',
            'cliente_id' => 2,
        ]);
        
        DB::table('chamados')->insert([
            'descricao' => 'Manutenção preventiva',
            'preventiva' => true,
            'status' => 'ABERTO',
            'dt_abertura' => date("Y-m-d H:i:s"),
            'cliente_id' => 2
        ]);

    }
}
