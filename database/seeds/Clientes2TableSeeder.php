<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Clientes2TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('clientes')->insert([
        'name' => 'CAPI COMÉRCIO VAR. DE ROUPAS CALÇ. E ACESSÓRIOS LTDA'	,
        'email' => 'valeria.goncalves@sejacapi.com.br'	,
        'endereco' => 'AVENIDA NSA SRA DE COPACABANA, 769 / SL 701' ,
        'cpfcnpj' => '13.019.623/0002-39'	,
        'cep' => 'XXXXX-XXX'	,
        'valor' => '-',
        'natureza' => 'PJ',
        'vencimento' => 0,
        'shortname' => 'CAPI-IPANEMA',
        'telefone' => '2227-2395',
        'status_cliente' => 'ATIVO'
        ]);
        
        DB::table('clientes')->insert([
        'name' => 'CAPI COMÉRCIO VAR. DE ROUPAS CALÇ. E ACESSÓRIOS LTDA'	,
        'email' => 'valeria.goncalves@sejacapi.com.br'	,
        'endereco' => 'AVENIDA NSA SRA DE COPACABANA, 769 / SL 701' ,
        'cpfcnpj' => 'XX.XXX.XXX/XXXX-XX'	,
        'cep' => 'XXXXX-XXX'	,
        'valor' => '-',
        'natureza' => 'PJ',
        'vencimento' => 0,
        'shortname' => 'CAPI-RIOSUL',
        'telefone' => '2543-6971',
        'status_cliente' => 'ATIVO'
        ]);

    }
}
