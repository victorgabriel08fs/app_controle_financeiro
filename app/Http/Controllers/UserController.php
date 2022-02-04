<?php

namespace App\Http\Controllers;

use App\Models\Objeto;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $users = User::withTrashed()->paginate(10);
        $objeto = new Objeto();
        $objeto->users = $users;
        return view('admin.user.index', ['objeto' => $objeto]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect()->route('acesso-negado');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRegistroRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return redirect()->route('acesso-negado');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Registro  $registro
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return redirect()->route('acesso-negado');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Registro  $registro
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.user.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRegistroRequest  $request
     * @param  \App\Models\Registro  $registro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user->update($request->all());
        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Registro  $registro
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if (auth()->user()->id != $user->id) {
            if ($user->contas) {
                foreach ($user->contas as $conta)
                    $conta->delete();
            }
            $user->delete();
            return redirect()->route('user.index')->withErrors(['success' => 'Usuário desativado!']);
        }
        return redirect()->route('user.index')->withErrors(['error' => 'Falha!']);
    }

    public function revive($user_id)
    {
        $user = User::withTrashed()->find($user_id);

        $user->restore();
        if ($user->contas) {
            foreach ($user->contas as $conta)
                $conta->restore();
                return redirect()->route('user.index')->withErrors(['success' => 'Usuário reativado!']);
        }
        return redirect()->route('user.index')->withErrors(['error' => 'Falha!']);
    }
}
