<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        DB::table('clientes')->insert([
            'name' => 'PINHEIRO PEZINHO COM. DE CALCADOS EIRELI',
            'telefone' => '(21) 98801-7769',
            'endereco' => 'ESTRADA DO MONTEIRO 1200 LOJA 103F',
            'cep' => '23045-830',
            'natureza' => 'PJ',
            'cpfcnpj' => '25.312.516/0001-00',
            'vencimento' => 5,
            'valor' => 'R$ 91.21',
            'email' => 'neif@oi.com.br',
            'shortname' => 'Bibi Cpo Gde',
            'status_cliente' => 'ATIVO'
        ]);

    }
}
