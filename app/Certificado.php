<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Certificado extends Model
{
    protected $timestamps = false;

    public function candidato()
    {
        return $this->belongsTo(Candidato::class, 'candidato_id');
    }
}
