<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certificado extends Model
{
    public $timestamps = false;
    protected $fillable = ['emissor', 'descricao', 'data','candidato_id'];

    public function candidato()
    {
        return $this->belongsTo(Candidato::class, 'candidato_id');
    }
}
