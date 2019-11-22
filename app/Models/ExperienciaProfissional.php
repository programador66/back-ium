<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExperienciaProfissional extends Model
{
    protected $table = "experiencias_profissionais";
    protected $fillable = ['cargo', 'empresa', 'data_inicio', 'data_saida','candidato_id'];

    public function candidato()
    {
        return $this->belongsTo(Candidato::class, 'candidato_id');
    }
}
