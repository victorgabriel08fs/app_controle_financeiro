<?php

namespace App\Http\Controllers;

use App\Models\Registro;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('acesso-negado');
    }
}
