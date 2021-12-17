<?php

namespace App\Http\Controllers;

use App\Models\Objeto;
use App\Models\Registro;
use Illuminate\Http\Request;

class RegistroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(Registro $registro)
    {
        $this->registro = $registro;
    }

    public function index()
    {
        $user_id = auth()->user()->id;
        $registros = Registro::with('user')->where('user_id', $user_id)->orderBy('data', 'desc')->paginate(10);
        $entradas = Registro::where('user_id', $user_id)->where('tipo', 1)->sum('valor');
        $saidas = Registro::where('user_id', $user_id)->where('tipo', 0)->sum('valor');
        $saldo = $entradas - $saidas;
        $saldo = number_format($saldo, 2);

        $objeto = new Objeto();
        $objeto->registros = $registros;
        $objeto->saldo = $saldo;
        return view('registro.index', ['objeto' => $objeto]);
    }

    public function sort($ordenacao)
    {
        $user_id = auth()->user()->id;
        $registros = Registro::with('user')->where('user_id', $user_id)->orderBy($ordenacao, 'desc')->paginate(10);
        $entradas = Registro::where('user_id', $user_id)->where('tipo', 1)->sum('valor');
        $saidas = Registro::where('user_id', $user_id)->where('tipo', 0)->sum('valor');
        $saldo = $entradas - $saidas;
        $saldo = number_format($saldo, 2);

        $objeto = new Objeto();
        $objeto->registros = $registros;
        $objeto->saldo = $saldo;
        return view('registro.index', ['objeto' => $objeto]);
    }

    public function ano($ano)
    {
        $user_id = auth()->user()->id;
        $registros = Registro::with('user')->where('user_id', $user_id)->where('data', 'like', $ano . '-%')->paginate(10);
        $entradas = Registro::where('user_id', $user_id)->where('data', 'like', $ano . '-%')->where('tipo', 1)->sum('valor');
        $saidas = Registro::where('user_id', $user_id)->where('data', 'like', $ano . '-%')->where('tipo', 0)->sum('valor');
        $saldo = $entradas - $saidas;
        $saldo = number_format($saldo, 2);

        $objeto = new Objeto();
        $objeto->registros = $registros;
        $objeto->saldo = $saldo;
        return view('registro.index', ['objeto' => $objeto]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('registro.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRegistroRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->registro->regras, $this->registro->feedbacks);

        Registro::create($request->all());
        return redirect()->route('registro.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Registro  $registro
     * @return \Illuminate\Http\Response
     */
    public function show(Registro $registro)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Registro  $registro
     * @return \Illuminate\Http\Response
     */
    public function edit(Registro $registro)
    {
        return view('registro.edit', ['registro' => $registro]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRegistroRequest  $request
     * @param  \App\Models\Registro  $registro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Registro $registro)
    {
        $request->validate($this->registro->regras, $this->registro->feedbacks);

        $registro->update($request->all());

        return redirect()->route('registro.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Registro  $registro
     * @return \Illuminate\Http\Response
     */
    public function destroy(Registro $registro)
    {
        $registro->delete();

        return redirect()->route('registro.index');
    }
}
