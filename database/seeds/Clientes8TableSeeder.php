<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Clientes8TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('clientes')->insert([
            'name' => 'NEIF PEZINHO COMERCIO DE CALCADOS LTDA'	,
            'email' => 'jorge.neif64@gmail.com '	,
            'endereco' => 'AVENIDA DOM HELDER CAMARA 5332 PISO L2 LOJA SNS 3401' ,
            'cpfcnpj' => '36.441.398/0001-49'	,
            'cep' => '20771004'	,
            'valor' => 'R$85,00',
            'natureza' => 'PJ',
            'vencimento' => 10,
            'shortname' => 'BIBI NORTE SHOPPING',
            'telefone' => '2289-0336',
            'status_cliente' => 'ATIVO'
        ]);
        
        DB::table('clientes')->insert([
            'name' => 'CLIENTE AVULSO'	,
            'email' => 'atendimentochamado@gmail.com '	,
            'endereco' => '-' ,
            'cpfcnpj' => '-'	,
            'cep' => '-'	,
            'valor' => 'R$180 p/ 3h',
            'natureza' => '-',
            'vencimento' => 0,
            'shortname' => 'AVULSO',
            'telefone' => '-',
            'status_cliente' => 'ATIVO'
        ]);
    }
}
