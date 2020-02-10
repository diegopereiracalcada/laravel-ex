<?php

namespace App;

use Illuminate\Support\Facades\Mail;

class MailService {
    public function sendAbertura($to_name, $to_email, $chamado){
        $this->sendMail(
            "emails.abertura", 
            "atendimentochamado@gmail.com", //HARDCODE
            "atendimentochamado@gmail.com", //HARDCODE
            "Abertura de Chamado - ClickTI Informática", 
            $chamado);
    }

    public function sendFechamento($to_name, $to_email, $chamado){
        $this->sendMail(
            "emails.fechamento", 
            "clickticonsultoria@gmail.com", //HARDCODE
            "clickticonsultoria@gmail.com", //HARDCODE
            "Fechamento de Chamado", 
            $chamado);
    }

    private function sendMail($mailView, $to_name, $to_email, $subject, $chamado){
        $data = [ "chamado" => $chamado];

        Mail::send($mailView, $data, function ($message) use ($to_name, $to_email, $subject) {
            $message
                ->from("atendimentochamado@gmail.com", "ClickTI Informática")
                ->to($to_email, $to_name)
                ->subject($subject);
        });
    }
}