<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function vagas()
    {
        return $this->hasMany(Vagas::class, 'empresa_id', 'id');
    }
}
