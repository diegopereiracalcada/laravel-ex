<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NotasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('notas')->insert([
            'nota' => 'Nota de exemplo de nuvem 1',
            'cliente_id' => 2,
            'categoria_id' => 1,
        ]);
        
        DB::table('notas')->insert([
            'nota' => 'Nota de exemplo de anbydesk 1',
            'cliente_id' => 2,
            'categoria_id' => 2,
        ]);
    }
}
