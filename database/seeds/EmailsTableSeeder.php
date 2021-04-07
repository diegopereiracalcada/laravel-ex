<?php

use App\Cliente;
use App\Models\Email;
use Illuminate\Database\Seeder;

class EmailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (Cliente::all() as $cliente) {
            Email::create([
                'email' => 'tarapi007@gmail.com',
                'cliente_id' => $cliente->id
            ]);
        }
    }
}
