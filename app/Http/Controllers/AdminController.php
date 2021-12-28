<?php

namespace App\Http\Controllers;

use App\Models\Registro;
use App\Models\Objeto;

class AdminController extends Controller
{

    public function index()
    {

        $movimentacoes = Registro::sum('valor');
        $qnt_movimentacoes = Registro::count('valor');
        $meses = array();
        $nome_meses = ['Jan', 'Fev', 'Mar', 'Abril', 'Maio', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'];

        $entradas = Registro::where('tipo', 1)->sum('valor');
        $saidas = Registro::where('tipo', 0)->sum('valor');

        if ($entradas > 0 && $saidas > 0) {
            $entradas_porcento = $entradas / ($entradas + $saidas) * 100;
            $saidas_porcento = $saidas / ($entradas + $saidas) * 100;
        } else {
            $entradas_porcento = 0;
            $saidas_porcento = 0;
        }

        $relacao = array();
        array_push($relacao, $entradas_porcento);
        array_push($relacao, $saidas_porcento);
        for ($i = 1; $i <= 12; $i++) {
            $valor_mes = Registro::where('data', 'like', '%-' . $i . '-%')->sum('valor');
            array_push($meses, $valor_mes);
        }
        $objeto = new Objeto();
        $objeto->movimentacoes = $movimentacoes;
        $objeto->qnt_movimentacoes = $qnt_movimentacoes;
        $objeto->meses = $meses;
        $objeto->nome_meses = $nome_meses;
        $objeto->relacao = $relacao;

        return view('admin.index', ['objeto' => $objeto]);
    }
}
