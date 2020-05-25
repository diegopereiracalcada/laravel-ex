<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Nota;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    
    
    public function downloadExcelClientes()
	{
        $data = Cliente::orderBy('id')->get()->toArray();
        
		return Excel::create('Clientes-' . date("Y-m-d_H:i"), function($excel) use ($data) {
			$excel->sheet('clientes', function($sheet) use ($data)
	        {
				$sheet->fromArray($data);
	        });
		})->download("xlsx");
    }

    public function downloadExcelNotas()
	{
        $data = Nota::all()->toArray();
        
		return Excel::create('Notas-' . date("Y-m-d_H:i"), function($excel) use ($data) {
			$excel->sheet('notas', function($sheet) use ($data)
	        {
				$sheet->fromArray($data);
	        });
		})->download("xlsx");
    }

    public function importExcelPreventivas()
	{
			if(Input::hasFile('import_file')){
                $path = Input::file('import_file')->getRealPath();
                $data = Excel::load($path, function($reader) {})->toArray();

                // dd($data);

                

                if(count($data) > 0){
                    foreach ($data as $key => $cliente) {
                        // dd($cliente);
                        $this->updatePreventiva($cliente);
                    }                }
            }
            
        return back(); 
    }
    
    private function updatePreventiva($clienteArray){
        
        $cliente = Cliente::where('shortname', $clienteArray['shortname'])->first();
        // dd($cliente);
        $cliente->preventiva = $clienteArray['preventiva'];
        $cliente->save();
    }
}
