<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    protected $fillable = [
        'nota',
        'categoria_id',
        'cliente_id'
    ];

    public function cliente(){
        return $this->belongsTo(Cliente::class);
    }

    public function categoria(){
        return $this->belongsTo('App\Categoria');
    }
}
