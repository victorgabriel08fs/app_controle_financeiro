<?php

namespace App\Http\Controllers;

use App\Models\Registro;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        $movimentacoes = Registro::sum('valor');
        return view('admin.index', ['movimentacoes' => $movimentacoes]);
    }
}
