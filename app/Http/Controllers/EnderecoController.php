<?php

namespace App\Http\Controllers;

use App\Models\Endereco;
use App\Models\Objeto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class EnderecoController extends Controller
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
        return view('cadastro.endereco.create');
    }

    public function createCep($cep)
    {
        $response = Http::get('http://viacep.com.br/ws/' . $cep . '/json/');
        $endereco = (json_decode($response));
        if (isset($endereco->erro)) {
            return view('cadastro.endereco.create', ['status' => 0]);
        } else {
            return view('cadastro.endereco.create', ['endereco' => $endereco, 'status' => 1]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Endereco::create($request->all());
        return redirect()->route('home');
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

    public function preencherEndereco(Request $request)
    {
        return redirect()->route('endereco.cep', ['cep' => $request->cep]);
    }
}
