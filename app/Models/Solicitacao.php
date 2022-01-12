<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitacao extends Model
{
    use HasFactory;
    protected $table = 'solicitacoes';

    protected $fillable = ['user_id', 'conta', 'tipo', 'status'];

    public function user()
    {
        return $this->belongsTo('App\Models\User')->withTrashed();
    }
}
