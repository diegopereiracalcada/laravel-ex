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

        $ids = \DB::select("select id from clientes");

        foreach($ids as $id){   
            
            $categorias = \DB::select("select id from categorias");

            foreach($categorias as $categoria){ 
                DB::table('notas')->insert([
                    'nota' => '.',
                    'cliente_id' => $id->id,
                    'categoria_id' => $categoria->id
                ]);
            }  
        }
    }
}
