<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormacaoEscolar extends Model
{
    protected $table = "formacoes_escolares";

    public function candidato()
    {
        return $this->belongsTo(Candidato::class, 'candidato_id');
    }
}
