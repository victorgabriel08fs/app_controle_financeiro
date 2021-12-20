<?php

namespace App\Http\Controllers;

use App\Models\Registro;
use App\Models\Objeto;

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
            $entradas_mes = Registro::where('user_id', $user_id)->where('tipo', 1)->where('data', 'like', '%-' . $mes . '-%')->sum('valor');
            $saidas_mes = Registro::where('user_id', $user_id)->where('tipo', 0)->where('data', 'like', '%-' . $mes . '-%')->sum('valor');
            array_push($saldo_mes, ($entradas_mes - $saidas_mes));
        }

        $objeto = new Objeto();
        $objeto->entradas_porcento = $entradas_porcento;
        $objeto->saidas_porcento = $saidas_porcento;
        $objeto->saldo_mes = $saldo_mes;
        return view('home', ['objeto' => $objeto]);
    }

    public function ano($ano)
    {
        $user_id = auth()->user()->id;

        $entradas = Registro::where('user_id', $user_id)->where('tipo', 1)->where('data', 'like', $ano . '-%')->sum('valor');
        $saidas = Registro::where('user_id', $user_id)->where('tipo', 0)->where('data', 'like', $ano . '-%')->sum('valor');
        $soma = $entradas + $saidas;
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
            $entradas_mes = Registro::where('user_id', $user_id)->where('tipo', 1)->where('data', 'like', $ano . '-' . $mes . '-%')->sum('valor');
            $saidas_mes = Registro::where('user_id', $user_id)->where('tipo', 0)->where('data', 'like', $ano . '-' . $mes . '-%')->sum('valor');
            array_push($saldo_mes, ($entradas_mes - $saidas_mes));
        }

        $objeto = new Objeto();
        $objeto->entradas_porcento = $entradas_porcento;
        $objeto->saidas_porcento = $saidas_porcento;
        $objeto->saldo_mes = $saldo_mes;
        $objeto->ano = $ano;
        return view('home', ['objeto' => $objeto]);
    }
}
