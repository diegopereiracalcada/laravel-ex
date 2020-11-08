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
        $this->sendMail(
            "emails.abertura", 
            "atendimentochamado@gmail.com", //HARDCODE
            "atendimentochamado@gmail.com", //HARDCODE
            "Abertura de Chamado #" . $chamado->numerochamado . " - ClickTI Informática", 
            $chamado);
    }

    public function sendFechamento($to_name, $to_email, $chamado){
        $this->sendMail(
            "emails.fechamento", 
            "clickticonsultoria@gmail.com", //HARDCODE
            "clickticonsultoria@gmail.com", //HARDCODE
            "Fechamento de Chamado #" . $chamado->numerochamado . " - ClickTI Informática", 
            $chamado);
    }

    private function sendMail($mailView, $to_name, $to_email, $subject, $chamado){
        $cliente = Cliente::find( $chamado->cliente_id);
        $data = [ "chamado" => $chamado, "cliente" => $cliente];

        Mail::send($mailView, $data, function ($message) use ($to_name, $to_email, $subject) {
            $message
                ->from("atendimentochamado@gmail.com", "ClickTI Informática")
                ->to($to_email, $to_name)
                ->subject($subject);
        });
    }

    public function sendCobranca(EmailCobranca $emailCobranca){
        if(empty($emailCobranca->nomeArquivoNota) && empty($emailCobranca->nomeArquivoBoleto) )
            return;
            
        Mail::send('emails.cobranca', [], function ($message) use ($emailCobranca) {
            $message
                ->from("atendimentochamado@gmail.com", "ClickTI Informática")
                // ->to($emailCobranca->emailDestinatario, $emailCobranca->emailDestinatario)
                ->to("clickticonsultoria@gmail.com", "clickticonsultoria@gmail.com")
                ->subject("BOLETO " . $emailCobranca->emailDestinatario . " " . $this->getActualMonth() . "/" . $this->getActualYear() . " CLICKTI INFORMÁTICA");

            if(!empty($emailCobranca->nomeArquivoBoleto)){
                $message->attach(
                        public_path($emailCobranca->nomeArquivoBoleto), 
                        [
                            'as' => $emailCobranca->nomeArquivoBoleto,
                            'mime' => 'application/pdf'
                        ]
                );
            }
            
            if(!empty($emailCobranca->nomeArquivoNota)){
                $message->attach(
                        public_path($emailCobranca->nomeArquivoNota), 
                        [
                            'as' => $emailCobranca->nomeArquivoNota,
                            'mime' => 'application/pdf'
                        ]
                );
            }
        });
    }
}