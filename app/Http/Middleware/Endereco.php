<?php

namespace App\Http\Middleware;

use App\Models\Endereco as ModelsEndereco;
use App\Models\UserDado;
use Closure;
use Illuminate\Http\Request;

class Endereco
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
        $user_dado = UserDado::find(auth()->user()->user_dados->id);
        $endereco = ModelsEndereco::where('user_dados_id', $user_dado->id)->get()->first();
        if ($endereco) {
            return $next($request);
        } else {
            return redirect()->route('endereco.create');
        }
    }
}
