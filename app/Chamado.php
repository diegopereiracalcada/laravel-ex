<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chamado extends Model
{
    protected $fillable = [
        'id',
        'descricao',
        'observacao',
        'preventiva',
        'isInclusoNoItinerario',
        'dt_abertura',
        'dt_ag_execucao',
        'dt_fechamento',
        'solucao',
        'status',
    ];

    public function cliente(){
        return $this->belongsTo(Cliente::class);
    }
    
}
