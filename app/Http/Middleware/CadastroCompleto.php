<?php

namespace App\Http\Middleware;

use App\Models\Endereco;
use App\Models\UserDado;
use Closure;
use Illuminate\Http\Request;

class CadastroCompleto
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            $user_dado = UserDado::find(auth()->user()->user_dados->id);
        } catch (\Throwable $th) {
            return redirect()->route('user_dados.create')->withErrors(['warning' => 'Conclua seu cadastro!']);
        }
        $endereco = Endereco::where('user_dados_id', $user_dado->id)->get()->first();
        if ($endereco) {
            return $next($request);
        } else {
            return redirect()->route('endereco.create')->withErrors(['warning' => 'Conclua seu cadastro!']);
        }
    }
}
