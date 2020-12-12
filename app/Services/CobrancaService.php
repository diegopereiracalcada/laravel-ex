<?php

namespace App\Services;

use App\Cliente;
use App\EmailCobranca;
use Illuminate\Support\Facades\Storage;

class CobrancaService {

    const PREFIXO_BOLETO = "BOLETO";
    const PREFIXO_NOTA = "NFSe";

    public function getNomeArquivo($prefixo, $cliente){
        $files = Storage::files();
        
        $fitlered_files = array_filter($files, function($str) use ($prefixo, $cliente){
            return strpos($str, $prefixo) !== false
                    && strpos($str, $cliente->shortname) !== false;
        });

        return implode($fitlered_files);
    }
    
    public function getNomeArquivoBoleto($cliente){
        return $this->getNomeArquivo(self::PREFIXO_BOLETO, $cliente);
    }
    
    public function getNomeArquivoNota($cliente){
        return $this->getNomeArquivo(self::PREFIXO_NOTA, $cliente);
    }
    
    public function getCobrancasDoMes(){
        $emailsCobranca = [];
        
        $clientes = Cliente::where('status_cliente', 'ATIVO')
                            ->orderBy('shortname')
                            ->get();

        foreach ($clientes as $cliente) {
            if($cliente->shortname == 'CAPI-IPANEMA'
                || $cliente->shortname == 'AVULSO')
                continue;
                
            $emailCobranca = new EmailCobranca();
            $emailCobranca->shortname = $cliente->shortname;
            $emailCobranca->emailDestinatario = $cliente->email;
            $emailCobranca->nomeArquivoBoleto = $this->getNomeArquivoBoleto($cliente);
            $emailCobranca->nomeArquivoNota = $this->getNomeArquivoNota($cliente);

            array_push($emailsCobranca, $emailCobranca);
        }

        return $emailsCobranca;
    }

}