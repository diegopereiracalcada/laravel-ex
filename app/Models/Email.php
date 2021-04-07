<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Cliente;

class Email extends Model
{
    protected $fillable = [
        'email',
        'cliente_id'
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
}
