<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExperienciaProfissional extends Model
{
    protected $table = "experiencias_profissionais";

    public function candidato()
    {
        return $this->belongsTo(Candidato::class, 'candidato_id');
    }
}
