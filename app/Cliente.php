<?php

namespace App;

use App\Models\Email;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    public function chamados(){
        return $this->hasMany(Chamado::class);
    }

    public function emails(){
        return $this->hasMany(Email::class);
    }

    public function notas(){
        return $this->hasMany(Nota::class);
    }


}
