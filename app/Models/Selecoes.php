<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Selecoes extends Model
{
    protected $timestamps = false;

    public function vagas()
    {
        return $this->belongsTo(Vagas::class,'vagas_id');
    }

    public function candidato()
    {
        return $this->belongsTo(Candidato::class,'candidato_id');
    }
}
