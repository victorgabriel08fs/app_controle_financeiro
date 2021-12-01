<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registro extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'tipo', 'valor', 'descricao', 'data', 'user_id'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public $regras = [
        '' => '',
        '' => '',
        '' => '',
    ];
    public $feedbacks = [
        '' => '',
        '' => '',
        '' => '',
    ];
}
