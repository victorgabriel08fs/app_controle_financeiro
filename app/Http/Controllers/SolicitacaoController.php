<?php

namespace App\Http\Controllers;

use App\Models\Solicitacao;
use App\Models\User;
use Illuminate\Http\Request;

class SolicitacaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $solicitacoes = Solicitacao::orderBy('status')->paginate(10);
        return view('admin.solicitacao.index', ['solicitacoes' => $solicitacoes]);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $solicitacoes = Solicitacao::where('user_id', auth()->user()->id)->where('status', 0)->get();
        $criacao = 0;
        $reset = 0;
        foreach ($solicitacoes as $solicitacao) {
            if ($solicitacao->tipo == 1 && $solicitacao->status == 0) {
                $criacao++;
            }
            if ($solicitacao->tipo == 3 && $solicitacao->status == 0) {
                $reset++;
            }
        }
        if (($criacao < 2 && $request->tipo == 1) || ($reset < 1 && $request->tipo == 3)) {
            Solicitacao::create($request->all());
            return redirect()->route('conta.index')->withErrors(['success' => 'Solicitação enviada!']);
        }
        return redirect()->route('conta.index')->withErrors(['error' => 'Falha!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Solicitacao $solicitacao)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Solicitacao $solicitacao)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Solicitacao $solicitacao)
    {
        $solicitacao->status = $request->status;
        $solicitacao->admin_id = auth()->user()->id;
        $solicitacao->save();

        return redirect()->route('solicitacao.index')->withErrors(['success' => 'Solicitação concluída!']);
    }

    public function resetPassword(Request $request)
    {
        $user = User::where('cpf', $request->cpf)->get()->first();
        if ($user) {
            Solicitacao::create([
                'tipo' => '3',
                'user_id' => $user->id
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Solicitacao $solicitacao)
    {
        //
    }
}
