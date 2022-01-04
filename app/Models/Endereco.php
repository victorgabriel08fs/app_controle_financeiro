<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    use HasFactory;

    protected $fillable = ['user_dados_id', 'rua', 'numero', 'bairro', 'cidade', 'estado', 'cep'];

    public function user_dados()
    {
        return $this->belongsTo('App\Models\UserDado');
    }
}
