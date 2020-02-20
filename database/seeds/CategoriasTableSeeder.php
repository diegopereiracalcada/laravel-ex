<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categorias')->insert([
            'categoria' => 'anydesks'
        ]);
        
        DB::table('categorias')->insert([
            'categoria' => 'backup/nuvem'
        ]);
        
        DB::table('categorias')->insert([
            'categoria' => 'dvr'
        ]);
        
        DB::table('categorias')->insert([
            'categoria' => 'emails'
        ]);
        
        DB::table('categorias')->insert([
            'categoria' => 'internet'
        ]);
            
        DB::table('categorias')->insert([
            'categoria' => 'observações'
        ]);
            
        DB::table('categorias')->insert([
            'categoria' => 'rede'
        ]);
            
        DB::table('categorias')->insert([
            'categoria' => 'servidor'
        ]);
            
        DB::table('categorias')->insert([
            'categoria' => 'senhas'
        ]);
            
        DB::table('categorias')->insert([
            'categoria' => 'sw de Gestão'
        ]);
            
        DB::table('categorias')->insert([
            'categoria' => 'wifi'
        ]);
    }
}
