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
        'dt_abertura',
        'dt_fechamento',
        'solucao',
        'status',
    ];

    public function cliente(){
        return $this->belongsTo(Cliente::class);
    }
    
}
