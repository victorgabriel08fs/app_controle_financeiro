<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registro extends Model
{
    use HasFactory;

    protected $fillable = ['tipo', 'valor', 'descricao', 'data', 'user_id'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function registro($tipo, $valor, $descricao, $user_id)
    {
        Registro::create(['tipo' => $tipo, 'valor' => $valor, 'descricao' => $descricao, 'user_id' => $user_id, 'data' => date('Y-m-d')]);
    }
}
