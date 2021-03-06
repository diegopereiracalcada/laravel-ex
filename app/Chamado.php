<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chamado extends Model
{
    protected $fillable = [
        'id',
        'numerochamado',
        'descricao',
        'observacao',
        'preventiva',
        'isinclusonoitinerario',
        'dt_abertura',
        'dt_ag_execucao',
        'dt_fechamento',
        'solucao',
        'cliente_id',
        'status',
        'enviaremailabertura',
        'enviaremailfechamento',
    ];

    public function cliente(){
        return $this->belongsTo(Cliente::class);
    }
    
}
