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

    public function registro($conta_id, $conta_id_2, $valor, $tipo)
    {
        Movimentacao::create(['conta_id' => $conta_id, 'conta_id_2' => $conta_id_2, 'valor' => $valor, 'tipo' => $tipo]);
        $registro = new Registro();
        if ($tipo == 0)
            $tipo = 1;
        else
            $tipo = 0;
        $registro->registro($tipo, $valor, $descricao, $user_id);
    }
}
