<?php

namespace App\Http\Controllers;

use App\Models\Conta;
use App\Http\Requests\StoreContaRequest;
use App\Http\Requests\UpdateContaRequest;
use Illuminate\Http\Request;

class ContaController extends Controller
{
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
        return redirect()->route('conta.index', ['op'=>0,'status' => 1]);
    }
    public function saque(Conta $conta, Request $request)
    {
        if ($conta->saldo >= $request->valor) {
            $conta->saldo = $conta->saldo - $request->valor;
            $conta->save();
            return redirect()->route('conta.index', ['op'=>1,'status' => 0]);
        } else {
            return redirect()->route('conta.index', ['op'=>1,'status' => 1]);
        }
    }
}
