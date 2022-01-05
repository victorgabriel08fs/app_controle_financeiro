<?php

namespace App\Http\Controllers;

use App\Models\Conta;
use App\Models\Movimentacao;
use App\Models\Objeto;
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
        $contas = Conta::where('user_id', $user_id)->orderBy('tipo')->get();
        return view('conta.index', ['contas' => $contas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($user_id)
    {
        $contaDig = array();
        $contaDig[0] = '';
        $contaDig[1] = '';
        for ($i = 0; $i < 5; $i++) {
            $contaDig[0] = $contaDig[0] . strval(rand(0, 9));
        }
        for ($i = 0; $i < 2; $i++) {
            $contaDig[1] = $contaDig[1] . strval(rand(0, 9));
        }
        $contas = Conta::where('conta', $contaDig[0])->where('digito', $contaDig[1])->get();
        if (empty($contas->first())) {
            $objeto = new Objeto();
            $objeto->conta = $contaDig[0];
            $objeto->digito = $contaDig[1];
            $objeto->user_id = $user_id;
            return view('admin.conta.create', ['objeto' => $objeto]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreContaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Conta  $conta
     * @return \Illuminate\Http\Response
     */
    public function show(Conta $conta)
    {
        return redirect()->route('acesso-negado');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Conta  $conta
     * @return \Illuminate\Http\Response
     */
    public function edit(Conta $conta)
    {
        return redirect()->route('acesso-negado');
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
        return redirect()->route('acesso-negado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Conta  $conta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Conta $conta)
    {
        if (auth()->user()->is_admin)
            $conta->delete();
        return redirect()->route('admin.contas');
    }

    public function revive($conta_id)
    {
        $conta_to_revive = (object)conta::withTrashed()->find($conta_id)->getAttributes();
        $conta = new conta();
        foreach ($conta_to_revive as $key => $value) {
            $conta->$key = $value;
        }
        $conta->restore();
        return redirect()->route('admin.contas');
    }

    public function deposito(Conta $conta, Request $request)
    {
        $conta->saldo = $conta->saldo + $request->valor;
        $conta->save();
        $movimentacao = new Movimentacao();
        $movimentacao->registro($conta->id, $conta->id, $request->valor, 0, 'Depósito', auth()->user()->id);
        return redirect()->route('conta.index');
    }
    public function saque(Conta $conta, Request $request)
    {
        if ($conta->saldo >= $request->valor) {
            $conta->saldo = $conta->saldo - $request->valor;
            $conta->save();
            $movimentacao = new Movimentacao();
            $movimentacao->registro($conta->id, $conta->id, $request->valor, 1, 'Saque', auth()->user()->id);
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
                    $movimentacao = new Movimentacao();
                    $movimentacao->registro($conta1->id, $conta2->id, $request->valor, 1, 'Transferência', auth()->user()->id);
                    $movimentacao->registro($conta2->id, $conta1->id, $request->valor, 0, 'Transferência', $conta2->user->id);
                }
            }
        }
        return redirect()->route('conta.index');
    }
}
