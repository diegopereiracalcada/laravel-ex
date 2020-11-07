<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\MailService;
use App\Nota;
use App\Services\CobrancaService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class CobrancaController extends Controller
{
    

    public function cobranca()
    {
        $emailsCobranca = (new CobrancaService())->getCobrancasDoMes();
        
        return view('cobranca', compact('emailsCobranca'));
    }

    public function enviarEmails(){


        $cobrancaService = new CobrancaService();
        $mailService = new MailService();
        $emailsCobranca = $cobrancaService->getCobrancasDoMes();

        foreach ($emailsCobranca as $emailCobranca) {
            $mailService->sendCobranca($emailCobranca);
        }

        return "Email enviado";
    }

}
