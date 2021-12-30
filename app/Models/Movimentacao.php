<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movimentacao extends Model
{
    use HasFactory;
    protected $table = 'movimentacoes';

    protected $fillable = ['conta_id', 'conta_id_2', 'valor', 'tipo'];

    public function conta()
    {
        return $this->belongsTo('App\Models\Conta');
    }
}
