<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lista extends Model
{
    use HasFactory;

    protected $table = 'listas';

    public function requisitante()
    {
        return $this->belongsTo(User::class, 'requisitante', 'id');
    }

    public function grupo()
    {
        return $this->belongsTo(Grupo::class, 'grupo', 'id');
    }

    public function itens()
    {
        return $this->hasMany(ListaItem::class, 'lista', 'id');
    }

}
