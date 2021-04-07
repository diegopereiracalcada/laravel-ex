<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\EmailConfig;
use App\Services\EmailService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\MailService;
use App\Models\Email;

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

    public function getEmailsByClienteId($id){
        return Cliente::find($id)->emails;
    }
}
