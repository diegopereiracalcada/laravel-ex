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

        for($i = 1; $i <= 6; $i++){
            DB::table('clientes')->insert([
                'name' => 'Cliente' . $i,
                'telefone' => '(21) 99999-9999',
                'endereco' => 'Rua de teste, 1',
                'cep' => '20999-999',
                'natureza' => 'PJ',
                'cpfcnpj' => '19.919.999/0000-99',
                'vencimento' => 5,
                'valor' => 200,
                'email' => 'cliente' . $i . '@dominio.com',
                'shortname' => 'c' . $i,
                'status_cliente' => 'ATIVO'
            ]);

        }
    }
}
