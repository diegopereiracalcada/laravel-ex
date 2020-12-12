<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmailCobranca extends Model
{
    protected $fillable = [
        'id',
        'emailDestinatario',
        'nomeArquivoBoleto',
        'nomeArquivoNota',
    ];
}
