<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Clientes5TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('clientes')->insert([
        'name' => 'WMARTINS ROUPAS E ARTIGOS ESPORTIVOS LTDA'	,
        'email' => 'trackfieldmetropolitano@gmail.com'	,
        'endereco' => 'AVENIDA ADALGISA COLOMBO, 135, LOJ 2079 SUC PISO L2' ,
        'cpfcnpj' => '33.551.258/0001-35'	,
        'cep' => '22775-026'	,
        'valor' => 'R$85,00',
        'natureza' => 'PJ',
        'vencimento' => 5,
        'shortname' => 'WMARTINS',
        'telefone' => '3095-9138',
        'status_cliente' => 'ATIVO'
        ]);
    }
}
