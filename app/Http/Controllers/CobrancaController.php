<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\MailService;
use App\Nota;
use App\Services\CobrancaService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class CobrancaController extends Controller
{
    

    public function listarCobrancas()
    {
        $emailsCobranca = (new CobrancaService())->getCobrancasDoMes();
        
        return view('cobranca', compact('emailsCobranca'));
    }


    public function simularEnvio(){
        $this->enviarEmails(false);
    }
    
    public function enviarCobrancas(){
        $this->enviarEmails(true);
    }
    
    public function enviarEmails($isSimulacao){

        $cobrancaService = new CobrancaService();
        $mailService = new MailService();

        $emailsCobranca = $cobrancaService->getCobrancasDoMes();

        foreach ($emailsCobranca as $emailCobranca) {

            if(empty($emailCobranca->nomeArquivoBoleto) || empty($emailCobranca->nomeArquivoNota)){
                Log::alert('Cliente ' . $emailCobranca->shortname . ' NÃO está completo');
                Log::debug($emailCobranca);
            } else {
                Log::info('Cliente ' . $emailCobranca->shortname . ' => enviando cobrança...');
                $mailService->sendCobranca($emailCobranca, $isSimulacao);

            }

            
        }

        return "Emails enviados";
    }

}
