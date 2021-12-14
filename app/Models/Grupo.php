<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    use HasFactory;
    protected $table = 'grupo';

    public function membro()
    {
        return $this->hasMany(GrupoMembro::class, 'grupo', 'id');
    }

    public function requisitante()
    {
        return $this->belongsTo(User::class, 'requisitante', 'id');
    }

    public function lista()
    {
        return $this->hasMany(Lista::class, 'grupo', 'id');
    }
}
