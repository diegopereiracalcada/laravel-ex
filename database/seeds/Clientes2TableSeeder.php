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
        $faker = \Faker\Factory::create();
        
        DB::table('clientes')->insert([
        'name' => 'ALESSANDRA AGRELLO REIS'	,
        'email' => 'arquiteturareis@gmail.com'	,
        'endereco' => 'Rua São Pedro da Aldeia 136 Freguesia Jpa'	,
        'cpfcnpj' => '018.481.317-47'	,
        'cep' => '22750-410'	,
        'valor' => 'R$ 160.00',
            'natureza' => 'PJ',
            'vencimento' => 5,
            'shortname' => 'Bibi Cpo Gde',
            'telefone' => 'XXXXX-XXXX',
            'status_cliente' => 'ATIVO'
        ]);
        
        DB::table('clientes')->insert([
        'name' => 'AP PEZINHO COM DE CALCADOS EIRELI EPP'	,
        'email' => 'admbibibarra@gmail.com'	,
        'endereco' => 'AVENIDA MARACANA 987'	,
        'cpfcnpj' => '21.906.739/0001-37'	,
        'cep' => '20511-000'	,
        'valor' => 'R$ 128.77',
            'natureza' => 'PJ',
            'vencimento' => 5,
            'shortname' => 'Bibi Cpo Gde',
            'telefone' => 'XXXXX-XXXX',
            'status_cliente' => 'ATIVO'
        ]);
        
        DB::table('clientes')->insert([
        'name' => 'BAKR E FARIA ASSESSORIA CONTABIL LTDA'	,
        'email' => 'fabiano.bakr@contarq.com.br'	,
        'endereco' => 'AVENIDA ALMIRANTE BARROSO 6 SALA 1105'	,
        'cpfcnpj' => '13.373.266/0001-21'	,
        'cep' => '20031-000'	,
        'valor' => 'R$ 268.28',
            'natureza' => 'PJ',
            'vencimento' => 5,
            'shortname' => 'Bibi Cpo Gde',
            'telefone' => 'XXXXX-XXXX',
            'status_cliente' => 'ATIVO'
        ]);
        DB::table('clientes')->insert([
        'name' => 'CAPI COMÉRCIO VAR. DE ROUPAS CALÇ. E ACESSÓRIOS LTDA'	,
        'email' => 'valeria.goncalves@sejacapi.com.br'	,
        'endereco' => 'AVENIDA NSA SRA DE COPACABANA, 769 / SL' ,
        'cpfcnpj' => '701	13.019.623/0001-58'	,
        'cep' => '22410-002'	,
        'valor' => 'R$ 790.00',
            'natureza' => 'PJ',
            'vencimento' => 5,
            'shortname' => 'Bibi Cpo Gde',
            'telefone' => 'XXXXX-XXXX',
            'status_cliente' => 'ATIVO'
        ]);
        DB::table('clientes')->insert([
        'name' => 'CASARAO DOS ITENS PET SHOP BAZAR'	,
        'email' => 'casaraodositens@hotmail.com'	,
        'endereco' => 'PRACA CRUZ VERMELHA 38 C CENTRO'	,
        'cpfcnpj' => '07.523.906/0001-30'	,
        'cep' => '20230-130'	,
        'valor' => 'R$ 128.77',
            'natureza' => 'PJ',
            'vencimento' => 5,
            'shortname' => 'Bibi Cpo Gde',
            'telefone' => 'XXXXX-XXXX',
            'status_cliente' => 'ATIVO'
        ]);
        DB::table('clientes')->insert([
        'name' => 'CONFORTO METROPOLITANO CALÇADOS E ACESSORIOS LTDA'	,
        'email' => 'admbibibarra@gmail.com'	,
        'endereco' => 'AVENIDA EMB ABELARDO BUENO 1300 LOJA 1100'	,
        'cpfcnpj' => '30.667.774/0001-31'	,
        'cep' => '22775-040'	,
        'valor' => 'R$ 91.21',
            'natureza' => 'PJ',
            'vencimento' => 5,
            'shortname' => 'Bibi Cpo Gde',
            'telefone' => 'XXXXX-XXXX',
            'status_cliente' => 'ATIVO'
        ]);
        DB::table('clientes')->insert([
        'name' => 'EVELYN MARIA DRUMMOND LOBÃO'	,
        'email' => 'studiodrummond@studiodrummond.com.br'	,
        'endereco' => 'RUA PROFESSOR VALADARES 206 CASA 01'	,
        'cpfcnpj' => '083.201.807-40'	,
        'cep' => '20561-020'	,
        'valor' => 'R$ 128.77',
            'natureza' => 'PJ',
            'vencimento' => 5,
            'shortname' => 'Bibi Cpo Gde',
            'telefone' => 'XXXXX-XXXX',
            'status_cliente' => 'ATIVO'
        ]);
        DB::table('clientes')->insert([
        'name' => 'LANCHONETE PONTINHO LTDA'	,
        'email' => 'gil@globalcafe.com.br'	,
        'endereco' => 'RUA DO CARMO 38 C'	,
        'cpfcnpj' => '33.327.610/0001-53'	,
        'cep' => '20011-020'	,
        'valor' => 'R$ 250.00',
            'natureza' => 'PJ',
            'vencimento' => 5,
            'shortname' => 'Bibi Cpo Gde',
            'telefone' => 'XXXXX-XXXX',
            'status_cliente' => 'ATIVO'
        ]);
        DB::table('clientes')->insert([
        'name' => 'LYON CONSTRUTORA LTDA – EPP'	,
        'email' => 'lyonconstrutora@yahoo.com.br'	,
        'endereco' => 'ESTRADA DOS TRÊS RIOS, Nº 741 - SALA 514'	,
        'cpfcnpj' => '12.601.488/0001-91'	,
        'cep' => '22745-004'	,
        'valor' => 'r$300',
            'natureza' => 'PJ',
            'vencimento' => 5,
            'shortname' => 'Bibi Cpo Gde',
            'telefone' => 'XXXXX-XXXX',
            'status_cliente' => 'ATIVO'
        ]);
        DB::table('clientes')->insert([
        'name' => 'MARIA ALICE PAULA AFFONSO FISIOT DOMIC'	,
        'email' => 'diretoria@qualityfisiorj.com.br'	,
        'endereco' => 'Estrada de Jacarepaguá 7655 sala 423'	,
        'cpfcnpj' => '03.203.701/0001-16'	,
        'cep' => '22753-033'	,
        'valor' => 'R$ 480.00',
            'natureza' => 'PJ',
            'vencimento' => 5,
            'shortname' => 'Bibi Cpo Gde',
            'telefone' => 'XXXXX-XXXX',
            'status_cliente' => 'ATIVO'
        ]);
        DB::table('clientes')->insert([
        'name' => 'MMCONTADORES E CONSULTORES LTDA'	,
        'email' => 'renatamannarino@mmcontadores.com.br'	,
        'endereco' => 'AVENIDA 13 DE MAIO 41 20 ANDAR'	,
        'cpfcnpj' => '01.568.177/0001-51'	,
        'cep' => '20031-007'	,
        'valor' => 'R$ 521.00',
            'natureza' => 'PJ',
            'vencimento' => 5,
            'shortname' => 'Bibi Cpo Gde',
            'telefone' => 'XXXXX-XXXX',
            'status_cliente' => 'ATIVO'
        ]);
        DB::table('clientes')->insert([
        'name' => 'PH PEZINHO COMERCIO DE CALCADOS LTDA EPP'	,
        'email' => 'admbibibarra@gmail.com'	,
        'endereco' => 'AVENIDA DAS AMERICAS 4666 LOJA 120 B'	,
        'cpfcnpj' => '13.712.973/0001-03'	,
        'cep' => '22640-902'	,
        'valor' => 'R$ 134.14',
            'natureza' => 'PJ',
            'vencimento' => 5,
            'shortname' => 'Bibi Cpo Gde',
            'telefone' => 'XXXXX-XXXX',
            'status_cliente' => 'ATIVO'
        ]);
        DB::table('clientes')->insert([
        'name' => 'SOARES PEZINHO COM DE CALCADOS LTDA EPP'	,
        'email' => 'admbibibarra@gmail.com'	,
        'endereco' => 'AVENIDA EMB ABELARDO BUENO 1300 LOJA 1028'	,
        'cpfcnpj' => '24.258.191/0001-54'	,
        'cep' => '22775-040'	,
        'valor' => 'R$ 134.14',
            'natureza' => 'PJ',
            'vencimento' => 5,
            'shortname' => 'Bibi Cpo Gde',
            'telefone' => 'XXXXX-XXXX',
            'status_cliente' => 'ATIVO'
        ]);
        DB::table('clientes')->insert([
        'name' => 'TRES MINEIROS PROD NAT E DIET LTDA'	,
        'email' => 'barrafreeway@mundoverde.com.br'	,
        'endereco' => 'AVENIDA DAS AMERICAS 2000 LJ 27'	,
        'cpfcnpj' => '04.013.212/0001-64'	,
        'cep' => '22640-101'	,
        'valor' => 'R$ 254.32',
            'natureza' => 'PJ',
            'vencimento' => 5,
            'shortname' => 'Bibi Cpo Gde',
            'telefone' => 'XXXXX-XXXX',
            'status_cliente' => 'ATIVO'
        ]);
        

    }
}
