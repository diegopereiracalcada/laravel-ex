<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    public function chamados(){
        return $this->hasMany(Chamado::class);
    }
}
