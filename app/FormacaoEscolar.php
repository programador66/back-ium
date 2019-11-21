<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormacaoEscolar extends Model
{
    protected $table = "formacoes_escolares";
    protected $fillable = ['curso', 'instituicao', 'data_inicio', 'data_conclusao','candidato_id'];

    public function candidato()
    {
        return $this->belongsTo(Candidato::class, 'candidato_id');
    }
}
