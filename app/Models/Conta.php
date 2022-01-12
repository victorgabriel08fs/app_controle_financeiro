<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Conta extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['conta', 'digito', 'saldo', 'tipo', 'user_id', 'deleted_at'];

    public function user()
    {
        return $this->belongsTo('App\Models\User')->withTrashed();
    }

    public function movimentacoes()
    {
        return $this->hasMany('App\Models\Movimentacao');
    }
}
