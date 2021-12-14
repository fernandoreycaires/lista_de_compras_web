<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListaItem extends Model
{
    use HasFactory;

    protected $table = 'listas_itens';

    public function lista()
    {
        return $this->belongsTo(Lista::class, 'lista', 'id');
    }

}
