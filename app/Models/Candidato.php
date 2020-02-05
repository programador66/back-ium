<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Candidato extends Model
{
    protected $primaryKey = "id";
    protected $fillable = [
        'cpf',
        'endereco',
        'user_id',
        'telefone',
        'sexo'
    ];

    public $timestamps = false;

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function formacaoEscolar()
    {
       return $this->hasMany(FormacaoEscolar::class, 'candidato_id','id');
    }

    public function experienciaProfissional()
    {
        return $this->hasMany(ExperienciaProfissional::class, 'candidato_id', 'id');
    }

    public function certificados()
    {
        return $this->hasMany(Certificado::class, 'candidato_id', 'id');
    }

    public function selecao()
    {
        return $this->hasMany(Selecoes::class);
    }
}
