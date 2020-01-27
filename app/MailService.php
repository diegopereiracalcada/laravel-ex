<?php

namespace App;

use Illuminate\Support\Facades\Mail;

class MailService {
    public function sendAbertura($to_name, $to_email, $chamado){
        $chamado = [];
        
        $this->sendMail(
            "emails.abertura", 
            "tarapi007@gmail.com", //HARDCODE
            "tarapi007@gmail.com", //HARDCODE
            "Encerramento de Chamado", 
            $chamado);
    }

    public function sendFechamento($to_name, $to_email, $chamado){
        return $this->sendMail(
            "emails.fechamento", 
            $to_email,
            $to_email, 
            "Encerramento de Chamado", 
            $chamado);
    }

    private function sendMail($mailView, $to_name, $to_email, $subject, $chamado){

        //return $data;
        $data = [ "id" => $chamado->id, "solucao" => $chamado->solucao];

        Mail::send($mailView, $data, function ($message) use ($to_name, $to_email, $subject) {
            $message
                ->from("atendimentochamado@gmail.com", "ClickTI Informática")
                ->to($to_email, $to_name)
                ->subject($subject);
        });
    }
}