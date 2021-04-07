<?php

namespace App;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class MailService {

    public function getActualMonth(){
        return date('m');
    }
    
    public function getActualYear(){
        return date('Y');
    }

    public function sendAbertura($to_name, $to_email, $chamado){
        $this->sendChamadoMail(
            "emails.abertura", 
            "atendimentochamado@gmail.com", //HARDCODE
            "atendimentochamado@gmail.com", //HARDCODE
            "Abertura de Chamado #" . $chamado->numerochamado . " - ClickTI Informática", 
            $chamado);
    }

    public function sendFechamento($to_name, $to_email, $chamado){
        $this->sendChamadoMail(
            "emails.fechamento", 
            "clickticonsultoria@gmail.com", //HARDCODE
            "clickticonsultoria@gmail.com", //HARDCODE
            "Fechamento de Chamado #" . $chamado->numerochamado . " - ClickTI Informática", 
            $chamado);
    }

    private function sendChamadoMail($mailView, $to_name, $to_email, $subject, $chamado){
        $cliente = Cliente::find( $chamado->cliente_id);
        $data = [ "chamado" => $chamado, "cliente" => $cliente];

        Mail::send($mailView, $data, function ($message) use ($to_name, $to_email, $subject) {
            $message
                ->from("atendimentochamado@gmail.com", "ClickTI Informática")
                ->to($to_email, $to_name)
                ->subject($subject);
        });
    }

    public function sendCobranca(EmailCobranca $emailCobranca, $isSimulacao){
        if(empty($emailCobranca->nomeArquivoNota) || empty($emailCobranca->nomeArquivoBoleto) )
            return;
            
        Mail::send('emails.cobranca', [], function ($message) use ($emailCobranca, $isSimulacao) {
            $message
                ->from("clickticonsultoria@gmail.com", "ClickTI Informática")
                ->subject("BOLETO "  . $emailCobranca->shortname . " ABR" . "/" . "2021" . " CLICKTI INFORMÁTICA");

            if($isSimulacao){
                $message->to("tarapi007@gmail.com", "tarapi007@gmail.com");
            } else {
                //$message->to($emailCobranca->emailDestinatario, $emailCobranca->emailDestinatario)
                  //      ->bcc("clickticonsultoria@gmail.com", "clickticonsultoria@gmail.com");
            }
                

            if(!empty($emailCobranca->nomeArquivoBoleto)){
                $message->attach(
                        storage_path('app/'.$emailCobranca->nomeArquivoBoleto), 
                        [
                            'as' => $emailCobranca->nomeArquivoBoleto,
                            'mime' => 'application/pdf'
                        ]
                );
            }
            
            if(!empty($emailCobranca->nomeArquivoNota)){
                $message->attach(
                        storage_path('app/'.$emailCobranca->nomeArquivoNota), 
                        [
                            'as' => $emailCobranca->nomeArquivoNota,
                            'mime' => 'application/pdf'
                        ]
                );
            }
        });
    }
}