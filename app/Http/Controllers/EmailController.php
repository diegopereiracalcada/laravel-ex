<?php

namespace App\Http\Controllers;

use App\EmailConfig;
use App\Services\EmailService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\MailService;

class EmailController extends Controller
{
    public function sendMail(Request $request)
    {


        $eService = new MailService();

        $data = array(
            "descricao " => "PC sem internet",
            "dt_abertura " => "00/00/00" , 
            "solucao " => "cabo reconectado" );

        $eService->sendMail(
            'testando name', 
            'diegopereiracalcada@gmail.com', 
            'Abertura/Fechamento de chamado', 
            $data);

        return 'foi'; 
    }
}
