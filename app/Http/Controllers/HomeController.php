<?php

namespace App\Http\Controllers;

use App\Models\Registro;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $a = 12;
        $user_id = auth()->user()->id;

        $entradas = Registro::where('user_id', $user_id)->where('tipo', 1)->sum('valor');
        $saidas = Registro::where('user_id', $user_id)->where('tipo', 0)->sum('valor');
        $soma = $entradas + $saidas;
        $mes_anterior = date('m') - 12;
        $ano_anterior = date('Y');
        if ($mes_anterior < 0) {
            $mes_anterior = $mes_anterior + 12;
            $ano_anterior = date('Y') - 1;
        } elseif ($mes_anterior == 0) {
            $mes_anterior = 1;
        }
        if ($mes_anterior < 10) {
            $mes_anterior = '0' . $mes_anterior;
        }
        if ($soma != 0) {
            $entradas_porcento = $entradas / ($soma) * 100;
            $saidas_porcento = $saidas / ($soma) * 100;
        } else {
            $entradas_porcento = 0;
            $saidas_porcento = 0;
        }
        $saldo_mes = array();
        for ($i = 1; $i <= 12; $i++) {
            if ($i < 10)
                $mes = '0' . $i;
            else
                $mes = $i;
            $entradas_mes = Registro::where('user_id', $user_id)->where('tipo', 1)->where('data', 'like', '2021-' . $a . '-%')->where('data', 'like', '%-' . $mes . '-%')->sum('valor');
            $saidas_mes = Registro::where('user_id', $user_id)->where('tipo', 0)->where('data', 'like', '2021-' . $a . '-%')->where('data', 'like', '%-' . $mes . '-%')->sum('valor');
            array_push($saldo_mes, ($entradas_mes - $saidas_mes));
        }

        return view('home', ['entradas_porcento' => $entradas_porcento, 'saidas_porcento' => $saidas_porcento, 'saldo_mes' => $saldo_mes]);
    }
}
