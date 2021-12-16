<?php

namespace App\Http\Controllers;

use App\Models\Registro;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        $movimentacoes = Registro::sum('valor');
        $qnt_movimentacoes = Registro::count('valor');
        $meses = array();
        $nome_meses = ['Jan', 'Fev', 'Mar', 'Abril', 'Maio', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'];

        for ($i = 1; $i <= 12; $i++) {
            $valor_mes = Registro::where('data', 'like', '%-' . $i . '-%')->sum('valor');
            array_push($meses, $valor_mes);
        }
        return view('admin.index', ['movimentacoes' => $movimentacoes, 'qnt_movimentacoes' => $qnt_movimentacoes, 'meses' => $meses, 'nome_meses' => $nome_meses]);
    }
}
