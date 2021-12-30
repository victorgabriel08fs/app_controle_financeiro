<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conta extends Model
{
    use HasFactory;

    protected $fillable = ['conta', 'digito', 'saldo', 'tipo', 'user_id'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function movimentacoes()
    {
        return $this->hasMany('App\Models\Movimentacao');
    }
}
