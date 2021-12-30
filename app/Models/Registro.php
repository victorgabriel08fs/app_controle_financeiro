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

    public $regras = [
        'tipo' => 'required|boolean',
        'valor' => 'required',
        'descricao' => 'required',
        'data' => 'required|date',
        'user_id' => 'exists:users,id',
    ];
    public $feedbacks = [
        'required' => 'O campo :attribute é um campo obrigatório.',
        'tipo.boolean' => 'Este campo deve ser entrada ou saída.',
        'date' => 'O campo :attribute deve ser uma data',
    ];

    public function registro($tipo, $valor, $descricao, $user_id)
    {
        Registro::create(['tipo' => $tipo, 'valor' => $valor, 'descricao' => $descricao, 'user_id' => $user_id, 'data' => date('d/m/Y')]);
    }
}
