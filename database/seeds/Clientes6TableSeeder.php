<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Clientes6TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('clientes')->insert([
        'name' => 'HERINGER & MATOS AUDITORIA CONSULTORIA E PERICIA CONTABIL LTDA'	,
        'email' => 'dp@heringerematos.com.br '	,
        'endereco' => 'RUA RODRIGO SILVA 8 SL 502' ,
        'cpfcnpj' => '32.902.650/0001-19'	,
        'cep' => '20011-040'	,
        'valor' => 'R$350,00',
        'natureza' => 'PJ',
        'vencimento' => 20,
        'shortname' => 'HERINGER',
        'telefone' => '3529-4361',
        'status_cliente' => 'ATIVO'
        ]);
    }
}
