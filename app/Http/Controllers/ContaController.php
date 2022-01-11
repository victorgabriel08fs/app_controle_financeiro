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
    public function cpf(Request $request)
    {
        $contador = 0;
        $user = User::where('cpf', $request->cpf)->get()->first();
        $userContas = Conta::where('user_id', $user->id)->get();
        foreach ($userContas as $conta) {
            $tipo = $conta->tipo;
            $contador++;
        }
        if ($contador < 2) {
            if (isset($tipo))
                return redirect()->route('conta.create', ['user' => $user, 'tipo' => !$tipo]);
            else
                return redirect()->route('conta.create', ['user' => $user, 'tipo' => null]);
        } else {
            $message = 0;
            return redirect()->route('admin.contas', ['message' => $message]);
        }
    }

    public function create(User $user, $tipo = null)
    {
        $contaDig = array();
        $contaDig['conta'] = '';
        $contaDig['digito'] = '';
        for ($i = 0; $i < 5; $i++) {
            $contaDig['conta'] = $contaDig['conta'] . strval(rand(0, 9));
        }
        for ($i = 0; $i < 2; $i++) {
            $contaDig['digito'] = $contaDig['digito'] . strval(rand(0, 9));
        }
        $contas = Conta::where('conta', $contaDig['conta'])->where('digito', $contaDig['digito'])->get();
        if (empty($contas->first())) {
            $objeto = new Objeto();
            $objeto->conta = $contaDig['conta'];
            $objeto->digito = $contaDig['digito'];
            $objeto->user_id = $user->id;
            if (isset($tipo)) {
                $objeto->tipo = $tipo;
            }
            return view('admin.conta.create', ['objeto' => $objeto]);
        }
        return redirect()->route('admin.contas');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreContaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $regras = [
            'conta' => 'required|numeric|digits:5',
            'digito' => 'required|numeric|digits:2',
            'user_id' => 'required|exists:users,id',
            'tipo' => 'required|boolean'
        ];
        $feedbacks = [
            'required'=>'O campo :attribute é obrigatório',
            'numeric'=>'O campo :attribute só aceita números',
            'exists'=>'Não foi possível encontrar',
            'tipo'=>'Tipo não identificado',
        ];


        $userContas = Conta::where('user_id', $request->user_id)->get();
        $corrente = 0;
        $poupanca = 0;
        foreach ($userContas as $conta) {
            if ($conta->tipo == 0)
                $poupanca++;
            elseif ($conta->tipo == 1)
                $corrente++;
        }
        if (($poupanca == 0 && $request->tipo == 0) || ($corrente == 0 && $request->tipo == 1)) {
            $request->validate($regras, $feedbacks);
            Conta::create($request->all());
            $message = 2;
        } else {
            $message = 1;
        }
        return redirect()->route('admin.contas', ['message' => $message]);
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
        $conta->saldo = bcadd($conta->saldo, $request->valor);
        $conta->save();
        $movimentacao = new Movimentacao();
        $movimentacao->registro($conta->id, $conta->id, $request->valor, 0, 'Depósito', auth()->user()->id);
        return redirect()->route('conta.index');
    }
    public function saque(Conta $conta, Request $request)
    {
        if ($conta->saldo >= $request->valor) {
            $conta->saldo = bcsub($conta->saldo, $request->valor);
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
                    $conta1->saldo = bcsub($conta1->saldo, $request->valor);
                    $conta2->saldo = bcadd($conta2->saldo, $request->valor);
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
