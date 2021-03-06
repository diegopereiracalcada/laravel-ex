<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ClientesTableSeeder::class);
        $this->call(Clientes2TableSeeder::class);
        $this->call(Clientes5TableSeeder::class);
        $this->call(Clientes7TableSeeder::class);
        //$this->call(ChamadosTableSeeder::class);
        $this->call(CategoriasTableSeeder::class);
        $this->call(NotasTableSeeder::class);
    }
}
