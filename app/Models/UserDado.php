<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDado extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'telefone', 'data_nasc', 'estado_civil','sexo'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function endereco()
    {
        return $this->hasOne('App\Models\Endereco','user_dados_id');
    }
}
