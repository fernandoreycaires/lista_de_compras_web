<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrupoMembro extends Model
{
    use HasFactory;

    protected $table = 'grupo_membros';

    public function grupo()
    {
        return $this->belongsTo(Grupo::class, 'grupo', 'id');
    }

}
