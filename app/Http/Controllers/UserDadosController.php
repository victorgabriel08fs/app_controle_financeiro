<?php

namespace App\Http\Controllers;

use App\Models\UserDado;
use Illuminate\Http\Request;

class UserDadosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect()->route('acesso-negado');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cadastro.user_dados.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $regras = [
            'telefone' => 'required|numeric|digits_between:10,12',
            'data_nasc' => 'required|date',
            'estado_civil' => 'required|numeric|digits:1|min:0',
            'sexo' => 'required|numeric|digits:1|min:0',
            'user_id' => 'required|exists:users,id',
        ];
        $feedbacks = [
            'required' => 'O campo :attribute é obrigatório',
            'digits_between' => 'Insira um :attribute válido',
            'digits' => 'Insira um :attribute válido',
            'numeric' => 'O campo :attribute só aceita números',
            'exists' => 'Não foi possível encontrar',
            'date' => 'Insira uma data válida'
        ];


        $request->validate($regras, $feedbacks);
        $user_dado = UserDado::create($request->all());
        return redirect()->route('endereco.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect()->route('acesso-negado');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return redirect()->route('acesso-negado');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return redirect()->route('acesso-negado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return redirect()->route('acesso-negado');
    }
}
