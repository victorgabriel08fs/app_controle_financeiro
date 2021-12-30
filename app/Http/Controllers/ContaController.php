<?php

namespace App\Http\Controllers;

use App\Models\Conta;
use App\Models\User;
use Illuminate\Http\Request;

class ContaController extends Controller
{
    public function __construct(Conta $conta)
    {
        $this->conta = $conta;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $contas = Conta::where('user_id', $user_id)->get();
        return view('conta.index', ['contas' => $contas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreContaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreContaRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Conta  $conta
     * @return \Illuminate\Http\Response
     */
    public function show(Conta $conta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Conta  $conta
     * @return \Illuminate\Http\Response
     */
    public function edit(Conta $conta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateContaRequest  $request
     * @param  \App\Models\Conta  $conta
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateContaRequest $request, Conta $conta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Conta  $conta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Conta $conta)
    {
        //
    }

    public function deposito(Conta $conta, Request $request)
    {
        $conta->saldo = $conta->saldo + $request->valor;
        $conta->save();
        return redirect()->route('conta.index');
    }
    public function saque(Conta $conta, Request $request)
    {
        if ($conta->saldo >= $request->valor) {
            $conta->saldo = $conta->saldo - $request->valor;
            $conta->save();
        }
        return redirect()->route('conta.index');
    }
    public function transfer(Conta $conta, Request $request)
    {
        $conta1 = $conta;
        $beneficiario = User::where('cpf', $request->cpf)->first();
        if ($conta1->saldo >= $request->valor) {
            foreach ($beneficiario->contas as $conta2) {
                if ($conta2->tipo == $request->tipo && $conta1->id != $conta2->id) {
                    $conta1->saldo = $conta1->saldo - $request->valor;
                    $conta2->saldo = $conta2->saldo + $request->valor;
                    $conta1->save();
                    $conta2->save();
                }
            }
        }
        return redirect()->route('conta.index');
    }
}
